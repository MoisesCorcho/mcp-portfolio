<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rag;

use App\Actions\Rag\ContextualizeQueryAction;
use App\Actions\Rag\RecordRagInteractionAction;
use App\Actions\Rag\RetrieveRelevantContextAction;
use App\Contracts\Rag\LlmProviderInterface;
use App\DTOs\Rag\ChatMessageDTO;
use App\DTOs\Rag\ChatPromptDTO;
use App\DTOs\Rag\RagInteractionLogDTO;
use App\DTOs\Rag\ScoredChunkDTO;
use App\Enums\Rag\LlmModelEnum;
use App\Enums\Rag\MessageRoleEnum;
use App\Enums\Rag\RagBlockedReasonEnum;
use App\Enums\Rag\RagLogStatusEnum;
use App\Http\Controllers\Controller;
use App\Services\Rag\RagCacheService;
use App\Services\Rag\SystemPromptService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ChatController extends Controller
{
    public function __construct(
        private readonly RetrieveRelevantContextAction $retrieveContext,
        private readonly LlmProviderInterface $llmProvider,
        private readonly SystemPromptService $systemPromptService,
        private readonly RagCacheService $cacheService,
        private readonly RecordRagInteractionAction $recordLog,
        private readonly ContextualizeQueryAction $contextualizeQuery,
    ) {}

    public function stream(Request $request): StreamedResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'history' => ['nullable', 'array', 'max:10'],
            'history.*.role' => ['required_with:history', 'string', 'in:user,assistant'],
            'history.*.content' => ['required_with:history', 'string', 'max:2000'],
            'locale' => ['nullable', 'string', 'in:es,en'],
        ]);

        $startedAt = microtime(true);
        $userMessage = (string) $validated['message'];
        /** @var array<int, array{role: string, content: string}> $history */
        $history = $validated['history'] ?? [];
        $locale = $this->resolveLocale($request, $userMessage);
        $sessionHash = $this->resolveSessionHash($request);
        $isFirstTurn = $history === [];

        if ($isFirstTurn) {
            $cached = $this->cacheService->getCachedResponse($userMessage, $locale);
            if ($cached !== null) {
                return $this->streamStaticResponse(
                    sources: $cached['sources'],
                    answer: $cached['answer'],
                    onComplete: function () use ($sessionHash, $userMessage, $cached, $startedAt): void {
                        ($this->recordLog)(new RagInteractionLogDTO(
                            sessionHash: $sessionHash,
                            question: $userMessage,
                            answer: $cached['answer'],
                            chunksCount: count($cached['sources']),
                            topScore: $this->extractTopScoreFromSources($cached['sources']),
                            sources: $cached['sources'],
                            cacheHit: true,
                            blockedReason: null,
                            latencyMs: $this->elapsedMs($startedAt),
                            status: RagLogStatusEnum::Completed,
                        ));
                    },
                );
            }
        }

        $searchQuery = $isFirstTurn
            ? $userMessage
            : ($this->contextualizeQuery)($userMessage, $history);

        $contextChunks = ($this->retrieveContext)(
            userQuery: $searchQuery,
            topK: 6,
            minScore: 0.27,
            fetchK: 12,
            maxPerDocument: 2,
        );
        $sources = $this->formatSources($contextChunks);
        $topScore = $this->extractTopScoreFromChunks($contextChunks);

        if ($isFirstTurn && $contextChunks === []) {
            $fallbackAnswer = (string) __('home.rag_out_of_scope_fallback', [], $locale);

            return $this->streamStaticResponse(
                sources: [],
                answer: $fallbackAnswer,
                onComplete: function () use ($sessionHash, $userMessage, $fallbackAnswer, $startedAt): void {
                    ($this->recordLog)(new RagInteractionLogDTO(
                        sessionHash: $sessionHash,
                        question: $userMessage,
                        answer: $fallbackAnswer,
                        chunksCount: 0,
                        topScore: null,
                        sources: [],
                        cacheHit: false,
                        blockedReason: RagBlockedReasonEnum::EmptyContext,
                        latencyMs: $this->elapsedMs($startedAt),
                        status: RagLogStatusEnum::Blocked,
                    ));
                },
            );
        }

        $prompt = $this->buildPrompt($userMessage, $history, $contextChunks);

        return new StreamedResponse(function () use (
            $prompt,
            $sources,
            $isFirstTurn,
            $userMessage,
            $locale,
            $sessionHash,
            $topScore,
            $startedAt
        ): void {
            $this->emitSseEvent('context', ['sources' => $sources]);
            $fullContent = '';

            try {
                $fullContent = $this->llmProvider->streamChat($prompt, function (string $token): void {
                    $this->emitSseEvent('token', ['token' => $token]);
                });

                if ($isFirstTurn && trim($fullContent) !== '') {
                    $this->cacheService->putCachedResponse($userMessage, $locale, $sources, $fullContent);
                }

                $this->emitSseEvent('done', ['done' => true]);

                ($this->recordLog)(new RagInteractionLogDTO(
                    sessionHash: $sessionHash,
                    question: $userMessage,
                    answer: $fullContent,
                    chunksCount: count($sources),
                    topScore: $topScore,
                    sources: $sources,
                    cacheHit: false,
                    blockedReason: null,
                    latencyMs: $this->elapsedMs($startedAt),
                    status: RagLogStatusEnum::Completed,
                ));
            } catch (\Throwable $e) {
                $this->emitSseEvent('error', ['error' => $e->getMessage()]);

                ($this->recordLog)(new RagInteractionLogDTO(
                    sessionHash: $sessionHash,
                    question: $userMessage,
                    answer: $fullContent !== '' ? $fullContent : null,
                    chunksCount: count($sources),
                    topScore: $topScore,
                    sources: $sources,
                    cacheHit: false,
                    blockedReason: null,
                    latencyMs: $this->elapsedMs($startedAt),
                    status: RagLogStatusEnum::Error,
                ));
            }
        }, 200, $this->sseHeaders());
    }

    /**
     * @param  array<int, array<string, mixed>>  $sources
     */
    private function streamStaticResponse(array $sources, string $answer, callable $onComplete): StreamedResponse
    {
        return new StreamedResponse(function () use ($sources, $answer, $onComplete): void {
            $this->emitSseEvent('context', ['sources' => $sources]);
            $this->emitSseEvent('token', ['token' => $answer]);
            $this->emitSseEvent('done', ['done' => true]);
            $onComplete();
        }, 200, $this->sseHeaders());
    }

    /**
     * @param  array<int, array{role: string, content: string}>  $history
     * @param  array<int, ScoredChunkDTO>  $contextChunks
     */
    private function buildPrompt(string $userMessage, array $history, array $contextChunks): ChatPromptDTO
    {
        $messages = [
            new ChatMessageDTO(MessageRoleEnum::System, $this->systemPromptService->getSystemPrompt()),
        ];

        if ($contextChunks === [] && $history !== []) {
            $messages[] = new ChatMessageDTO(
                MessageRoleEnum::System,
                'No new knowledge base documents were retrieved for this follow-up turn. Do NOT invent or assume any technologies, databases, frameworks, or projects not explicitly grounded in verified retrieved context, and do NOT claim Moisés lacks a skill merely because no new chunk was retrieved. If you lack verified evidence to answer, state that transparently.'
            );
        }

        foreach ($history as $item) {
            $role = $item['role'] === 'assistant' ? MessageRoleEnum::Assistant : MessageRoleEnum::User;
            $messages[] = new ChatMessageDTO($role, (string) $item['content']);
        }

        $messages[] = new ChatMessageDTO(MessageRoleEnum::User, $userMessage);

        return new ChatPromptDTO(
            messages: $messages,
            contextChunks: $contextChunks,
            model: LlmModelEnum::Gpt4oMini,
            temperature: 0.2,
            maxTokens: 600,
        );
    }

    /**
     * @param  array<int, ScoredChunkDTO>  $contextChunks
     * @return array<int, array<string, mixed>>
     */
    private function formatSources(array $contextChunks): array
    {
        return array_map(static fn (ScoredChunkDTO $chunk): array => [
            'id' => $chunk->id,
            'title' => $chunk->metadata['document_title'] ?? $chunk->id,
            'section' => $chunk->metadata['section'] ?? '',
            'score' => round($chunk->score, 3),
        ], $contextChunks);
    }

    /**
     * @param  array<int, ScoredChunkDTO>  $contextChunks
     */
    private function extractTopScoreFromChunks(array $contextChunks): ?float
    {
        if ($contextChunks === []) {
            return null;
        }

        return round(max(array_map(static fn (ScoredChunkDTO $chunk): float => $chunk->score, $contextChunks)), 4);
    }

    /**
     * @param  array<int, array<string, mixed>>  $sources
     */
    private function extractTopScoreFromSources(array $sources): ?float
    {
        if ($sources === []) {
            return null;
        }

        $scores = array_filter(array_map(
            static fn (array $source): ?float => isset($source['score']) ? (float) $source['score'] : null,
            $sources
        ), static fn (?float $score): bool => $score !== null);

        return $scores !== [] ? max($scores) : null;
    }

    private function resolveLocale(Request $request, string $userMessage): string
    {
        $requested = $request->input('locale');
        if (is_string($requested) && in_array($requested, ['es', 'en'], true)) {
            return $requested;
        }

        if (preg_match('/[¿¡áéíóúñÁÉÍÓÚÑ]|\b(el|la|los|las|un|una|unos|unas|de|del|en|con|por|para|que|qué|como|cómo|cual|cuál|cuales|cuáles|dame|dime|tienes|tiene|sabe|sabes|puedes|puede|sobre|hola|proyecto|proyectos|receta|codigo|código|prueba|hacer|lista|listame|tecnologia|tecnologias|pasatiempos|peliculas)\b/iu', $userMessage) === 1) {
            return 'es';
        }

        $appLocale = app()->getLocale();

        return in_array($appLocale, ['es', 'en'], true) ? $appLocale : 'en';
    }

    private function resolveSessionHash(Request $request): string
    {
        $fingerprint = ($request->ip() ?? 'unknown').'|'.($request->userAgent() ?? 'unknown').'|'.(string) config('app.key');

        return hash('sha256', $fingerprint);
    }

    private function elapsedMs(float $startedAt): int
    {
        return (int) round((microtime(true) - $startedAt) * 1000);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function emitSseEvent(string $event, array $payload): void
    {
        echo "event: {$event}\n";
        echo 'data: '.json_encode($payload, JSON_UNESCAPED_UNICODE)."\n\n";
        if (function_exists('ob_flush') && ob_get_level() > 0) {
            @ob_flush();
        }
        flush();
    }

    /**
     * @return array<string, string>
     */
    private function sseHeaders(): array
    {
        return [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache, no-transform',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ];
    }
}
