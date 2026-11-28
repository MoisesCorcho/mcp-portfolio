<?php

declare(strict_types=1);

namespace App\Actions\Rag;

use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\ScoredChunkDTO;
use App\Enums\Rag\EmbeddingModelEnum;
use App\Services\Rag\RagCacheService;

final class RetrieveRelevantContextAction
{
    private readonly RagCacheService $cacheService;

    public function __construct(
        private readonly EmbeddingProviderInterface $embeddingProvider,
        private readonly VectorStoreInterface $vectorStore,
        ?RagCacheService $cacheService = null,
    ) {
        $this->cacheService = $cacheService ?? new RagCacheService;
    }

    /**
     * Retrieve relevant chunks for a user query with optional document-level diversification.
     *
     * @return array<int, ScoredChunkDTO>
     */
    public function __invoke(
        string $userQuery,
        int $topK = 4,
        float $minScore = 0.30,
        int $fetchK = 0,
        ?int $maxPerDocument = null,
    ): array {
        $cleanQuery = trim($userQuery);
        if (empty($cleanQuery)) {
            return [];
        }

        $model = EmbeddingModelEnum::TextEmbedding3Small;
        $queryVector = $this->cacheService->getCachedEmbedding($cleanQuery, $model);

        if ($queryVector === null) {
            $queryVector = $this->embeddingProvider->embed($cleanQuery, $model);
            if (empty($queryVector)) {
                return [];
            }
            $this->cacheService->putCachedEmbedding($cleanQuery, $model, $queryVector);
        }

        $queryLimit = $fetchK > 0 ? $fetchK : $topK;
        $chunks = $this->vectorStore->query($queryVector, $queryLimit);

        $filtered = array_values(array_filter($chunks, static fn (ScoredChunkDTO $chunk): bool => $chunk->score >= $minScore));
        usort($filtered, static fn (ScoredChunkDTO $a, ScoredChunkDTO $b): int => $b->score <=> $a->score);

        if ($maxPerDocument === null || $maxPerDocument <= 0) {
            return array_slice($filtered, 0, $topK);
        }

        $selected = [];
        $docCounts = [];

        foreach ($filtered as $chunk) {
            $docId = (string) ($chunk->metadata['document_id'] ?? explode('-chunk', $chunk->id)[0]);
            $count = $docCounts[$docId] ?? 0;

            if ($count >= $maxPerDocument) {
                continue;
            }

            $selected[] = $chunk;
            $docCounts[$docId] = $count + 1;

            if (count($selected) >= $topK) {
                break;
            }
        }

        return $selected;
    }
}
