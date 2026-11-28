<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Rag\RetrieveRelevantContextAction;
use App\DTOs\Rag\ScoredChunkDTO;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

final class RagEvaluateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rag:evaluate {--top-k=4 : Number of top results to retrieve}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Evaluate RAG retrieval accuracy against the Golden Dataset benchmark';

    public function handle(RetrieveRelevantContextAction $retrieveContext): int
    {
        $benchmarkPath = base_path('tests/Fixtures/Rag/golden_dataset.json');
        if (! File::exists($benchmarkPath)) {
            $this->error("Golden dataset not found at {$benchmarkPath}");

            return Command::FAILURE;
        }

        $items = json_decode(File::get($benchmarkPath), true) ?: [];
        if (empty($items)) {
            $this->error('Golden dataset is empty.');

            return Command::FAILURE;
        }

        $topK = (int) $this->option('top-k');
        $this->info('Evaluating RAG Pipeline against Golden Dataset ('.count($items)." test cases, Top-K: {$topK})...\n");

        $rows = [];
        $hits = 0;
        $totalScores = 0.0;
        $scoredCount = 0;

        $startTime = microtime(true);

        foreach ($items as $item) {
            $id = $item['id'] ?? 'N/A';
            $query = $item['query'] ?? '';
            $expectedDocs = $item['expected_document_ids'] ?? [];

            $retrievalStart = microtime(true);
            $chunks = $retrieveContext($query, topK: $topK, minScore: 0.27, fetchK: max($topK * 3, 12), maxPerDocument: 2);
            $durationMs = round((microtime(true) - $retrievalStart) * 1000);

            $retrievedDocIds = array_map(function (ScoredChunkDTO $chunk) {
                return $chunk->metadata['document_id'] ?? explode('-chunk', $chunk->id)[0];
            }, $chunks);

            $isHit = false;
            foreach ($expectedDocs as $expected) {
                if (in_array($expected, $retrievedDocIds, true)) {
                    $isHit = true;
                    break;
                }
            }

            if ($isHit) {
                $hits++;
            }

            $topScore = ! empty($chunks) ? round($chunks[0]->score, 3) : 0.0;
            if ($topScore > 0) {
                $totalScores += $topScore;
                $scoredCount++;
            }

            $status = $isHit ? '<fg=green>PASS</>' : '<fg=red>FAIL</>';
            $shortQuery = mb_substr($query, 0, 45).(mb_strlen($query) > 45 ? '...' : '');

            $rows[] = [
                $id,
                $shortQuery,
                implode(', ', $expectedDocs),
                implode(', ', array_unique($retrievedDocIds)) ?: '<fg=yellow>None</>',
                $topScore > 0 ? (string) $topScore : 'N/A',
                "{$durationMs}ms",
                $status,
            ];
        }

        $totalDuration = round(microtime(true) - $startTime, 2);
        $hitRate = round(($hits / count($items)) * 100, 1);
        $avgScore = $scoredCount > 0 ? round($totalScores / $scoredCount, 3) : 0.0;

        $this->table(
            ['ID', 'Query', 'Expected Docs', 'Retrieved Docs', 'Top Score', 'Latency', 'Status'],
            $rows
        );

        $this->newLine();
        $this->line('──────────────────────────────────────────────────────────');
        $this->info('Evaluation Summary:');
        $this->line('  • Total Benchmark Cases : '.count($items));
        $this->line("  • Successful Hits       : {$hits}/".count($items));
        $this->line("  • Hit Rate @ {$topK}        : <fg=".($hitRate >= 90 ? 'green' : 'yellow').">{$hitRate}%</>");
        $this->line("  • Average Top Score     : {$avgScore}");
        $this->line("  • Total Time            : {$totalDuration}s");
        $this->line('──────────────────────────────────────────────────────────');

        return $hitRate >= 80 ? Command::SUCCESS : Command::FAILURE;
    }
}
