<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Rag\IndexKnowledgeBaseAction;
use App\Services\Rag\RagCacheService;
use Illuminate\Console\Command;

final class RagIndexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rag:index {--file= : Specific markdown file to index}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ingest markdown files from storage/rag/knowledge, generate embeddings, and upsert into Pinecone';

    public function handle(IndexKnowledgeBaseAction $action, RagCacheService $cacheService): int
    {
        $this->info('Starting RAG Knowledge Base indexing...');
        $file = $this->option('file');

        try {
            $count = $action($file, function (string $msg): void {
                $this->line("  → {$msg}");
            });

            if ($count > 0) {
                $newVersion = $cacheService->bumpKnowledgeBaseVersion();
                $this->line("  → Cache version bumped to v{$newVersion}.");
            }

            $this->info("Indexing completed! Total vector records indexed: {$count}");

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error("Indexing failed: {$e->getMessage()}");

            return Command::FAILURE;
        }
    }
}
