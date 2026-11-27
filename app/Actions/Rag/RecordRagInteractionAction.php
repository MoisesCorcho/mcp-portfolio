<?php

declare(strict_types=1);

namespace App\Actions\Rag;

use App\DTOs\Rag\RagInteractionLogDTO;
use App\Models\RagLog;
use Illuminate\Support\Facades\Log;

final class RecordRagInteractionAction
{
    /**
     * Persist a RAG interaction record without interrupting the user response.
     */
    public function __invoke(RagInteractionLogDTO $dto): void
    {
        try {
            RagLog::query()->create([
                'session_hash' => $dto->sessionHash,
                'question' => $dto->question,
                'answer' => $dto->answer,
                'chunks_count' => $dto->chunksCount,
                'top_score' => $dto->topScore,
                'sources' => $dto->sources,
                'cache_hit' => $dto->cacheHit,
                'blocked_reason' => $dto->blockedReason?->value,
                'latency_ms' => max(0, $dto->latencyMs),
                'status' => $dto->status->value,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to persist RAG interaction log.', [
                'error' => $e->getMessage(),
                'status' => $dto->status->value,
            ]);
        }
    }
}
