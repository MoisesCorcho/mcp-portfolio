<?php

declare(strict_types=1);

namespace App\DTOs\Rag;

final readonly class VectorRecordDTO
{
    /**
     * @param array<int, float> $values
     * @param array<string, mixed> $metadata
     */
    public function __construct(
        public string $id,
        public array $values,
        public array $metadata = [],
    ) {}
}
