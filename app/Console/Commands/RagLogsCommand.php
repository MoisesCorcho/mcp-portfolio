<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\Rag\RagLogStatusEnum;
use App\Models\RagLog;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

final class RagLogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rag:logs
        {--limit=20 : Maximum number of recent interactions to display}
        {--status= : Filter by status (completed, blocked, error)}
        {--blocked : Show only blocked interactions}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inspect recent Moisés AI RAG Q&A interaction logs from the database';

    public function handle(): int
    {
        $limit = max(1, (int) $this->option('limit'));
        $statusOption = $this->option('status');
        $blockedOnly = (bool) $this->option('blocked');

        $query = RagLog::query()->latest('id');

        if ($blockedOnly) {
            $query->where('status', RagLogStatusEnum::Blocked->value);
        } elseif (is_string($statusOption) && $statusOption !== '') {
            $status = RagLogStatusEnum::tryFrom($statusOption);
            if ($status === null) {
                $this->error("Invalid status '{$statusOption}'. Allowed: completed, blocked, error.");

                return Command::FAILURE;
            }
            $query->where('status', $status->value);
        }

        $logs = $query->limit($limit)->get();

        if ($logs->isEmpty()) {
            $this->info('No RAG interaction logs found.');

            return Command::SUCCESS;
        }

        $rows = $logs->map(static function (RagLog $log): array {
            return [
                $log->id,
                $log->created_at?->format('Y-m-d H:i:s') ?? '-',
                $log->status->value,
                $log->cache_hit ? 'HIT' : 'MISS',
                $log->chunks_count,
                $log->top_score !== null ? number_format($log->top_score, 3) : '-',
                "{$log->latency_ms}ms",
                $log->blocked_reason?->value ?? '-',
                Str::limit($log->question, 60),
            ];
        })->all();

        $this->table(
            ['ID', 'Timestamp', 'Status', 'Cache', 'Chunks', 'Top Score', 'Latency', 'Blocked', 'Question'],
            $rows
        );

        return Command::SUCCESS;
    }
}
