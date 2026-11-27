<?php

declare(strict_types=1);

namespace App\DTOs\Rag;

final readonly class DocumentChunkDTO
{
    /**
     * @param  array<string, mixed>  $metadata
     */
    public function __construct(
        public string $id,
        public string $documentId,
        public string $content,
        public array $metadata = [],
    ) {}
}
