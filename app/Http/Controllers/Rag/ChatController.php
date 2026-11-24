<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rag;

use App\Actions\Rag\RetrieveRelevantContextAction;
use App\Contracts\Rag\LlmProviderInterface;
use App\DTOs\Rag\ChatMessageDTO;
use App\DTOs\Rag\ChatPromptDTO;
use App\Enums\Rag\LlmModelEnum;
use App\Enums\Rag\MessageRoleEnum;
use App\Http\Controllers\Controller;
use App\Services\Rag\SystemPromptService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class ChatController extends Controller
{
    public function __construct(
        private readonly RetrieveRelevantContextAction $retrieveContext,
        private readonly LlmProviderInterface $llmProvider,
        private readonly SystemPromptService $systemPromptService,
    ) {}

    public function stream(Request $request): StreamedResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'history' => ['nullable', 'array', 'max:10'],
            'history.*.role' => ['required_with:history', 'string', 'in:user,assistant'],
            'history.*.content' => ['required_with:history', 'string', 'max:2000'],
        ]);

        $userMessage = (string) $validated['message'];
        $history = $validated['history'] ?? [];

        $contextChunks = ($this->retrieveContext)($userMessage, topK: 4);

        $messages = [];
        $messages[] = new ChatMessageDTO(MessageRoleEnum::System, $this->systemPromptService->getSystemPrompt());

        foreach ($history as $item) {
            $role = $item['role'] === 'assistant' ? MessageRoleEnum::Assistant : MessageRoleEnum::User;
            $messages[] = new ChatMessageDTO($role, (string) $item['content']);
        }

        $messages[] = new ChatMessageDTO(MessageRoleEnum::User, $userMessage);

        $prompt = new ChatPromptDTO(
            messages: $messages,
            contextChunks: $contextChunks,
            model: LlmModelEnum::Gpt4oMini,
            temperature: 0.2
        );

        return new StreamedResponse(function () use ($prompt, $contextChunks) {
            $sources = array_map(function ($chunk) {
                return [
                    'id' => $chunk->id,
                    'title' => $chunk->metadata['document_title'] ?? $chunk->id,
                    'section' => $chunk->metadata['section'] ?? '',
                    'score' => round($chunk->score, 3),
                ];
            }, $contextChunks);

            echo "event: context\n";
            echo 'data: ' . json_encode(['sources' => $sources], JSON_UNESCAPED_UNICODE) . "\n\n";
            if (function_exists('ob_flush') && ob_get_level() > 0) {
                @ob_flush();
            }
            flush();

            try {
                $this->llmProvider->streamChat($prompt, function (string $token): void {
                    echo "event: token\n";
                    echo 'data: ' . json_encode(['token' => $token], JSON_UNESCAPED_UNICODE) . "\n\n";
                    if (function_exists('ob_flush') && ob_get_level() > 0) {
                        @ob_flush();
                    }
                    flush();
                });

                echo "event: done\n";
                echo 'data: ' . json_encode(['done' => true], JSON_UNESCAPED_UNICODE) . "\n\n";
                if (function_exists('ob_flush') && ob_get_level() > 0) {
                    @ob_flush();
                }
                flush();
            } catch (\Throwable $e) {
                echo "event: error\n";
                echo 'data: ' . json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE) . "\n\n";
                if (function_exists('ob_flush') && ob_get_level() > 0) {
                    @ob_flush();
                }
                flush();
            }
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache, no-transform',
            'Connection' => 'keep-alive',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}
