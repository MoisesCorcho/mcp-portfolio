<?php

declare(strict_types=1);

namespace App\Actions\Rag;

use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\VectorRecordDTO;
use App\Enums\Rag\EmbeddingModelEnum;
use App\Services\Rag\MarkdownChunkerService;
use Illuminate\Support\Facades\File;

final class IndexKnowledgeBaseAction
{
    public function __construct(
        private readonly MarkdownChunkerService $chunker,
        private readonly EmbeddingProviderInterface $embeddingProvider,
        private readonly VectorStoreInterface $vectorStore,
    ) {}

    /**
     * Ingest and index technical markdown files from storage/rag/knowledge.
     *
     * @param ?callable(string $message): void $progressCallback
     * @return int Total chunks indexed
     */
    public function __invoke(?string $specificFile = null, ?callable $progressCallback = null): int
    {
        $dir = storage_path('rag/knowledge');

        if (!File::isDirectory($dir)) {
            return 0;
        }

        $files = $specificFile
            ? [new \SplFileInfo($dir . '/' . basename($specificFile))]
            : File::files($dir);

        $allChunks = [];

        foreach ($files as $file) {
            if ($file->getExtension() !== 'md') {
                continue;
            }

            $content = File::get($file->getPathname());
            $documentId = $file->getBasename('.md');
            $chunks = $this->chunker->chunk($documentId, $content);

            foreach ($chunks as $chunk) {
                $allChunks[] = $chunk;
            }

            if ($progressCallback) {
                $progressCallback("Chunked {$file->getFilename()} (" . count($chunks) . " chunks)");
            }
        }

        if (empty($allChunks)) {
            return 0;
        }

        $records = [];
        $chunkBatches = array_chunk($allChunks, 20);

        foreach ($chunkBatches as $batchIndex => $batch) {
            $texts = array_map(fn ($chunk) => $chunk->content, $batch);
            $vectors = $this->embeddingProvider->embedBatch($texts, EmbeddingModelEnum::TextEmbedding3Small);

            foreach ($batch as $i => $chunk) {
                $vector = $vectors[$i] ?? [];
                if (empty($vector)) {
                    continue;
                }

                $records[] = new VectorRecordDTO(
                    id: $chunk->id,
                    values: $vector,
                    metadata: array_merge($chunk->metadata, [
                        'content' => $chunk->content,
                        'indexed_at' => now()->toIso8601String(),
                    ])
                );
            }

            if ($progressCallback) {
                $progressCallback("Generated embeddings for batch " . ($batchIndex + 1) . "/" . count($chunkBatches));
            }
        }

        $this->vectorStore->upsert($records);

        if ($progressCallback) {
            $progressCallback("Successfully upserted " . count($records) . " vector records into Pinecone.");
        }

        return count($records);
    }
}
