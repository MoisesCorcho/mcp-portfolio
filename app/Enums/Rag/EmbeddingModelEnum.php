<?php

declare(strict_types=1);

namespace App\Enums\Rag;

enum EmbeddingModelEnum: string
{
    case TextEmbedding3Small = 'text-embedding-3-small';
    case TextEmbedding3Large = 'text-embedding-3-large';

    public function dimension(): int
    {
        return match ($this) {
            self::TextEmbedding3Small => 1536,
            self::TextEmbedding3Large => 3072,
        };
    }
}
