<?php

declare(strict_types=1);

namespace App\Actions\Rag;

use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\ScoredChunkDTO;
use App\Enums\Rag\EmbeddingModelEnum;

final class RetrieveRelevantContextAction
{
    public function __construct(
        private readonly EmbeddingProviderInterface $embeddingProvider,
        private readonly VectorStoreInterface $vectorStore,
    ) {}

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

        $queryVector = $this->embeddingProvider->embed($cleanQuery, EmbeddingModelEnum::TextEmbedding3Small);
        if (empty($queryVector)) {
            return [];
        }

        $chunks = $this->vectorStore->query($queryVector, $topK);

        return array_values(array_filter($chunks, fn (ScoredChunkDTO $chunk) => $chunk->score >= $minScore));
    }
}
