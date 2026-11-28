<?php

declare(strict_types=1);

namespace App\DTOs\Rag;

use App\Enums\Rag\RagBlockedReasonEnum;
use App\Enums\Rag\RagLogStatusEnum;

final readonly class RagInteractionLogDTO
{
    /**
     * @param  array<int, array<string, mixed>>  $sources
     */
    public function __construct(
        public string $sessionHash,
        public string $question,
        public ?string $answer,
        public int $chunksCount,
        public ?float $topScore,
        public array $sources,
        public bool $cacheHit,
        public ?RagBlockedReasonEnum $blockedReason,
        public int $latencyMs,
        public RagLogStatusEnum $status,
    ) {}
}
