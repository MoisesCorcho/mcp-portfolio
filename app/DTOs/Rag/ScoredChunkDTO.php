<?php

declare(strict_types=1);

namespace App\DTOs\Rag;

final readonly class ScoredChunkDTO
{
    /**
     * @param array<string, mixed> $metadata
     */
    public function __construct(
        public string $id,
        public float $score,
        public string $content,
        public array $metadata = [],
    ) {}
}
