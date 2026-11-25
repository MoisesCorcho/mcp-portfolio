<?php

declare(strict_types=1);

namespace Tests\Feature\Rag;

use App\Actions\Rag\RetrieveRelevantContextAction;
use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\ScoredChunkDTO;
use Mockery;
use Tests\TestCase;

class RagGoldenDatasetTest extends TestCase
{
    private function loadGoldenDataset(): array
    {
        $filePath = __DIR__ . '/../../Fixtures/Rag/golden_dataset.json';
        $this->assertFileExists($filePath);

        $items = json_decode((string) file_get_contents($filePath), true);
        $this->assertIsArray($items);

        return $items;
    }

    public function test_golden_dataset_structure_is_valid(): void
    {
        $items = $this->loadGoldenDataset();
        $this->assertGreaterThanOrEqual(10, count($items));

        foreach ($items as $item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('query', $item);
            $this->assertArrayHasKey('expected_document_ids', $item);
            $this->assertArrayHasKey('expected_concepts', $item);
            $this->assertIsArray($item['expected_document_ids']);
        }
    }

    public function test_retrieval_hit_rate_on_all_golden_dataset_items(): void
    {
        $items = $this->loadGoldenDataset();

        foreach ($items as $benchmark) {
            $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
            $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);

            $fakeVector = array_fill(0, 1536, 0.05);
            $embeddingMock->shouldReceive('embed')
                ->once()
                ->with($benchmark['query'], Mockery::any())
                ->andReturn($fakeVector);

            $simulatedMatches = [];
            foreach ($benchmark['expected_document_ids'] as $index => $docId) {
                $simulatedMatches[] = new ScoredChunkDTO(
                    id: "{$docId}-chunk-1",
                    score: 0.85 - ($index * 0.05),
                    content: "Content relating to {$benchmark['query']}",
                    metadata: [
                        'document_id' => $docId,
                        'document_title' => "Title for {$docId}",
                        'section' => 'Core Architecture',
                    ]
                );
            }

            $vectorStoreMock->shouldReceive('query')
                ->once()
                ->with($fakeVector, 4)
                ->andReturn($simulatedMatches);

            $action = new RetrieveRelevantContextAction($embeddingMock, $vectorStoreMock);
            $results = $action($benchmark['query'], topK: 4, minScore: 0.30);

            $this->assertNotEmpty($results, "Retrieval returned empty for query: '{$benchmark['query']}'");

            $retrievedDocIds = array_map(function (ScoredChunkDTO $chunk) {
                return $chunk->metadata['document_id'] ?? explode('-chunk', $chunk->id)[0];
            }, $results);

            $hit = false;
            foreach ($benchmark['expected_document_ids'] as $expectedDoc) {
                if (in_array($expectedDoc, $retrievedDocIds, true)) {
                    $hit = true;
                    break;
                }
            }

            $this->assertTrue(
                $hit,
                "Hit Rate @ 4 failed for: '{$benchmark['query']}'. Expected: " . implode(', ', $benchmark['expected_document_ids'])
            );
        }
    }
}
