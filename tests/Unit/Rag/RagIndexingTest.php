<?php

declare(strict_types=1);

namespace Tests\Unit\Rag;

use App\Actions\Rag\IndexKnowledgeBaseAction;
use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\Enums\Rag\EmbeddingModelEnum;
use App\Services\Rag\MarkdownChunkerService;
use Mockery;
use Tests\TestCase;

class RagIndexingTest extends TestCase
{
    public function test_markdown_chunker_service_splits_into_semantic_chunks(): void
    {
        $service = new MarkdownChunkerService;
        $markdown = <<<'MD'
# Leen Honey Project
## Problem Statement
High-volume honey e-commerce needed resilient multi-gateway payments.
## Technical Stack
Laravel 13, Filament v5, Stripe and Bold Webhooks.
## Key Results
Zero double charges through idempotent webhook architecture.
MD;

        $chunks = $service->chunk('02-leenhoney', $markdown);

        $this->assertCount(3, $chunks);
        $this->assertSame('02-leenhoney-chunk-1', $chunks[0]->id);
        $this->assertSame('Problem Statement', $chunks[0]->metadata['section']);
        $this->assertStringContainsString('High-volume honey e-commerce', $chunks[0]->content);

        $this->assertSame('02-leenhoney-chunk-2', $chunks[1]->id);
        $this->assertSame('Technical Stack', $chunks[1]->metadata['section']);

        $this->assertSame('02-leenhoney-chunk-3', $chunks[2]->id);
        $this->assertSame('Key Results', $chunks[2]->metadata['section']);
    }

    public function test_index_knowledge_base_action_workflow(): void
    {
        $chunker = new MarkdownChunkerService;
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);

        $embeddingMock->shouldReceive('embedBatch')
            ->atLeast()->once()
            ->andReturnUsing(function (array $texts, EmbeddingModelEnum $model) {
                return array_fill(0, count($texts), array_fill(0, 1536, 0.01));
            });

        $vectorStoreMock->shouldReceive('upsert')
            ->atLeast()->once()
            ->andReturnNull();

        $action = new IndexKnowledgeBaseAction($chunker, $embeddingMock, $vectorStoreMock);
        $count = $action('01-profile-and-capabilities.md');

        $this->assertGreaterThan(0, $count);
    }

    public function test_artisan_rag_index_command_success(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);

        $embeddingMock->shouldReceive('embedBatch')
            ->atLeast()->once()
            ->andReturnUsing(function (array $texts) {
                return array_fill(0, count($texts), array_fill(0, 1536, 0.02));
            });

        $vectorStoreMock->shouldReceive('upsert')
            ->atLeast()->once()
            ->andReturnNull();

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);

        $this->artisan('rag:index', ['--file' => '01-profile-and-capabilities.md'])
            ->expectsOutputToContain('Starting RAG Knowledge Base indexing...')
            ->expectsOutputToContain('Indexing completed!')
            ->assertSuccessful();
    }
}
