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
     * Retrieve relevant chunks for a user query.
     *
     * @return array<int, ScoredChunkDTO>
     */
    public function __invoke(string $userQuery, int $topK = 4, float $minScore = 0.30): array
    {
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

        $chunks = $this->vectorStore->query($queryVector, $topK);

        return array_values(array_filter($chunks, fn (ScoredChunkDTO $chunk) => $chunk->score >= $minScore));
    }
}
