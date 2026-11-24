<?php

declare(strict_types=1);

namespace App\Contracts\Rag;

use App\Enums\Rag\EmbeddingModelEnum;

interface EmbeddingProviderInterface
{
    /**
     * Generate an embedding vector for a single text.
     *
     * @return array<int, float>
     */
    public function embed(string $text, EmbeddingModelEnum $model = EmbeddingModelEnum::TextEmbedding3Small): array;

    /**
     * Generate embedding vectors for a batch of texts.
     *
     * @param array<int, string> $texts
     * @return array<int, array<int, float>>
     */
    public function embedBatch(array $texts, EmbeddingModelEnum $model = EmbeddingModelEnum::TextEmbedding3Small): array;
}
