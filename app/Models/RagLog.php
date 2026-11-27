<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Rag\RagBlockedReasonEnum;
use App\Enums\Rag\RagLogStatusEnum;
use Illuminate\Database\Eloquent\Model;

final class RagLog extends Model
{
    protected $fillable = [
        'session_hash',
        'question',
        'answer',
        'chunks_count',
        'top_score',
        'sources',
        'cache_hit',
        'blocked_reason',
        'latency_ms',
        'status',
    ];

    protected $casts = [
        'chunks_count' => 'integer',
        'top_score' => 'float',
        'sources' => 'array',
        'cache_hit' => 'boolean',
        'blocked_reason' => RagBlockedReasonEnum::class,
        'latency_ms' => 'integer',
        'status' => RagLogStatusEnum::class,
    ];
}
