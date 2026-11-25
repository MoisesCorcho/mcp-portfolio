<?php

declare(strict_types=1);

namespace Tests\Feature\Rag;

use App\Actions\Rag\RetrieveRelevantContextAction;
use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\LlmProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\ChatPromptDTO;
use App\DTOs\Rag\ScoredChunkDTO;
use Mockery;
use Tests\TestCase;

class RagChatApiTest extends TestCase
{
    public function test_retrieve_relevant_context_action(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);

        $embeddingMock->shouldReceive('embed')
            ->once()
            ->with('Tell me about Leen Honey', Mockery::any())
            ->andReturn(array_fill(0, 1536, 0.05));

        $vectorStoreMock->shouldReceive('query')
            ->once()
            ->andReturn([
                new ScoredChunkDTO('doc-1', 0.88, 'Leen Honey multi-gateway', ['document_title' => 'Leen Honey']),
                new ScoredChunkDTO('doc-2', 0.15, 'Low score chunk', ['document_title' => 'Other']),
            ]);

        $action = new RetrieveRelevantContextAction($embeddingMock, $vectorStoreMock);
        $results = $action('Tell me about Leen Honey', topK: 4, minScore: 0.30);

        $this->assertCount(1, $results);
        $this->assertSame('doc-1', $results[0]->id);
        $this->assertSame(0.88, $results[0]->score);
    }

    public function test_rag_chat_stream_endpoint_validates_input(): void
    {
        $response = $this->postJson('/api/rag/chat', []);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['message']);
    }

    public function test_rag_chat_stream_endpoint_returns_event_stream(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $embeddingMock->shouldReceive('embed')
            ->andReturn(array_fill(0, 1536, 0.05));

        $vectorStoreMock->shouldReceive('query')
            ->andReturn([
                new ScoredChunkDTO('leenhoney-1', 0.91, 'Leen Honey content', ['document_title' => 'Leen Honey', 'section' => 'Stack']),
            ]);

        $llmMock->shouldReceive('streamChat')
            ->once()
            ->andReturnUsing(function (ChatPromptDTO $prompt, callable $callback) {
                $callback('Moisés ');
                $callback('diseñó ');
                $callback('Leen Honey.');

                return 'Moisés diseñó Leen Honey.';
            });

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);
        $this->app->instance(LlmProviderInterface::class, $llmMock);

        $response = $this->postJson('/api/rag/chat', [
            'message' => '¿Qué hizo Moisés en Leen Honey?',
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('text/event-stream', (string) $response->headers->get('Content-Type'));

        $streamContent = $response->streamedContent();
        $this->assertStringContainsString('event: context', $streamContent);
        $this->assertStringContainsString('Leen Honey', $streamContent);
        $this->assertStringContainsString('event: token', $streamContent);
        $this->assertStringContainsString('Moisés ', $streamContent);
        $this->assertStringContainsString('event: done', $streamContent);
    }
}
