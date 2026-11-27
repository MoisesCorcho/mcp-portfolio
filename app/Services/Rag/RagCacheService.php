<?php

declare(strict_types=1);

namespace App\Services\Rag;

use App\Enums\Rag\EmbeddingModelEnum;
use Illuminate\Support\Facades\Cache;

final class RagCacheService
{
    private const VERSION_KEY = 'rag:kb_version';

    private const TTL_SECONDS = 86400;

    public function normalizeQuery(string $query): string
    {
        $collapsed = preg_replace('/\s+/u', ' ', trim($query)) ?? trim($query);
        $trimmedPunctuation = trim($collapsed, " \t\n\r\0\x0B¿¡?!");

        return mb_strtolower($trimmedPunctuation !== '' ? $trimmedPunctuation : $collapsed, 'UTF-8');
    }

    public function getKnowledgeBaseVersion(): int
    {
        return (int) Cache::rememberForever(self::VERSION_KEY, static fn (): int => 1);
    }

    public function bumpKnowledgeBaseVersion(): int
    {
        $next = $this->getKnowledgeBaseVersion() + 1;
        Cache::forever(self::VERSION_KEY, $next);

        return $next;
    }

    /**
     * @return array<int, float>|null
     */
    public function getCachedEmbedding(string $query, EmbeddingModelEnum $model): ?array
    {
        $cached = Cache::get($this->embeddingKey($query, $model));

        return is_array($cached) ? $cached : null;
    }

    /**
     * @param  array<int, float>  $vector
     */
    public function putCachedEmbedding(string $query, EmbeddingModelEnum $model, array $vector): void
    {
        if ($vector === []) {
            return;
        }

        Cache::put($this->embeddingKey($query, $model), $vector, now()->addSeconds(self::TTL_SECONDS));
    }

    /**
     * @return array{sources: array<int, array<string, mixed>>, answer: string}|null
     */
    public function getCachedResponse(string $query, string $locale): ?array
    {
        $cached = Cache::get($this->responseKey($query, $locale));

        if (! is_array($cached) || ! isset($cached['answer']) || ! is_string($cached['answer'])) {
            return null;
        }

        return [
            'sources' => is_array($cached['sources'] ?? null) ? $cached['sources'] : [],
            'answer' => $cached['answer'],
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $sources
     */
    public function putCachedResponse(string $query, string $locale, array $sources, string $answer): void
    {
        if (trim($answer) === '') {
            return;
        }

        Cache::put($this->responseKey($query, $locale), [
            'sources' => $sources,
            'answer' => $answer,
        ], now()->addSeconds(self::TTL_SECONDS));
    }

    private function embeddingKey(string $query, EmbeddingModelEnum $model): string
    {
        $hash = hash('sha256', $model->value.'|'.$this->normalizeQuery($query));

        return "rag:emb:v{$this->getKnowledgeBaseVersion()}:{$hash}";
    }

    private function responseKey(string $query, string $locale): string
    {
        $hash = hash('sha256', $locale.'|'.$this->normalizeQuery($query));

        return "rag:resp:v{$this->getKnowledgeBaseVersion()}:{$hash}";
    }
}
