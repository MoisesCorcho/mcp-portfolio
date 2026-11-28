<?php

declare(strict_types=1);

namespace App\Actions\Rag;

use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\VectorRecordDTO;
use App\Enums\Rag\EmbeddingModelEnum;
use App\Services\Rag\MarkdownChunkerService;
use App\Services\Rag\PortfolioCatalogService;
use Illuminate\Support\Facades\File;

final class IndexKnowledgeBaseAction
{
    private readonly PortfolioCatalogService $catalogService;

    public function __construct(
        private readonly MarkdownChunkerService $chunker,
        private readonly EmbeddingProviderInterface $embeddingProvider,
        private readonly VectorStoreInterface $vectorStore,
        ?PortfolioCatalogService $catalogService = null,
    ) {
        $this->catalogService = $catalogService ?? new PortfolioCatalogService($this->chunker);
    }

    /**
     * Ingest and index technical markdown files from storage/rag/knowledge
     * plus the dynamically generated SSOT portfolio catalog.
     *
     * @param  ?callable(string $message): void  $progressCallback
     * @return int Total chunks indexed
     */
    public function __invoke(?string $specificFile = null, ?callable $progressCallback = null): int
    {
        $dir = storage_path('rag/knowledge');
        $allChunks = [];
        $includeCatalog = $specificFile === null
            || pathinfo($specificFile, PATHINFO_FILENAME) === PortfolioCatalogService::CATALOG_DOCUMENT_ID;

        if ($includeCatalog) {
            $catalogChunks = $this->catalogService->buildChunks();
            foreach ($catalogChunks as $chunk) {
                $allChunks[] = $chunk;
            }
            if ($progressCallback) {
                $progressCallback('Generated '.PortfolioCatalogService::CATALOG_DOCUMENT_ID.' from config/portfolio.php ('.count($catalogChunks).' chunks)');
            }
        }

        if ($specificFile === null || pathinfo($specificFile, PATHINFO_FILENAME) !== PortfolioCatalogService::CATALOG_DOCUMENT_ID) {
            if (File::isDirectory($dir)) {
                $files = $specificFile
                    ? [new \SplFileInfo($dir.'/'.basename($specificFile))]
                    : File::files($dir);

                foreach ($files as $file) {
                    if (! $file->isFile() || $file->getExtension() !== 'md') {
                        continue;
                    }

                    $content = File::get($file->getPathname());
                    $documentId = $file->getBasename('.md');
                    $chunks = $this->chunker->chunk($documentId, $content);

                    foreach ($chunks as $chunk) {
                        $allChunks[] = $chunk;
                    }

                    if ($progressCallback) {
                        $progressCallback("Chunked {$file->getFilename()} (".count($chunks).' chunks)');
                    }
                }
            }
        }

        if ($allChunks === []) {
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
                $progressCallback('Generated embeddings for batch '.($batchIndex + 1).'/'.count($chunkBatches));
            }
        }

        $this->vectorStore->upsert($records);

        if ($progressCallback) {
            $progressCallback('Successfully upserted '.count($records).' vector records into Pinecone.');
        }

        return count($records);
    }
}
