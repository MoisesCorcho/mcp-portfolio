<?php

declare(strict_types=1);

namespace Tests\Feature\Rag;

use App\Actions\Rag\RecordRagInteractionAction;
use App\Actions\Rag\RetrieveRelevantContextAction;
use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\LlmProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\ChatPromptDTO;
use App\DTOs\Rag\RagInteractionLogDTO;
use App\DTOs\Rag\ScoredChunkDTO;
use App\Enums\Rag\RagBlockedReasonEnum;
use App\Enums\Rag\RagLogStatusEnum;
use App\Models\RagLog;
use App\Services\Rag\RagCacheService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Mockery;
use Tests\TestCase;

class RagChatApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_retrieve_relevant_context_action_caches_embeddings_and_respects_version_bump(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $cacheService = new RagCacheService;

        $embeddingMock->shouldReceive('embed')
            ->twice()
            ->with('Tell me about Leen Honey', Mockery::any())
            ->andReturn(array_fill(0, 1536, 0.05));

        $vectorStoreMock->shouldReceive('query')
            ->times(3)
            ->andReturn([
                new ScoredChunkDTO('doc-1', 0.88, 'Leen Honey multi-gateway', ['document_title' => 'Leen Honey']),
                new ScoredChunkDTO('doc-2', 0.15, 'Low score chunk', ['document_title' => 'Other']),
            ]);

        $action = new RetrieveRelevantContextAction($embeddingMock, $vectorStoreMock, $cacheService);

        $results = $action('Tell me about Leen Honey', topK: 4, minScore: 0.30);
        $this->assertCount(1, $results);
        $this->assertSame('doc-1', $results[0]->id);
        $this->assertSame(0.88, $results[0]->score);

        // Normalized variant hits embedding cache without calling EmbeddingProvider again
        $cachedResults = $action('  tell me about Leen Honey? ', topK: 4, minScore: 0.30);
        $this->assertCount(1, $cachedResults);

        // Bumping KB version invalidates cached embeddings
        $cacheService->bumpKnowledgeBaseVersion();
        $freshResults = $action('Tell me about Leen Honey', topK: 4, minScore: 0.30);
        $this->assertCount(1, $freshResults);
    }

    public function test_rag_chat_stream_endpoint_validates_input(): void
    {
        $response = $this->postJson('/api/rag/chat', []);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['message']);
    }

    public function test_rag_chat_stream_endpoint_returns_event_stream_and_logs_interaction(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $embeddingMock->shouldReceive('embed')
            ->once()
            ->andReturn(array_fill(0, 1536, 0.05));

        $vectorStoreMock->shouldReceive('query')
            ->once()
            ->andReturn([
                new ScoredChunkDTO('leenhoney-1', 0.91, 'Leen Honey content', ['document_title' => 'Leen Honey', 'section' => 'Stack']),
            ]);

        $llmMock->shouldReceive('streamChat')
            ->once()
            ->with(Mockery::on(static fn (ChatPromptDTO $prompt): bool => $prompt->maxTokens === 600), Mockery::any())
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

        $this->assertDatabaseHas('rag_logs', [
            'question' => '¿Qué hizo Moisés en Leen Honey?',
            'answer' => 'Moisés diseñó Leen Honey.',
            'chunks_count' => 1,
            'cache_hit' => false,
            'status' => RagLogStatusEnum::Completed->value,
        ]);
    }

    public function test_rag_chat_short_circuits_empty_context_on_first_turn_without_calling_llm(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $embeddingMock->shouldReceive('embed')
            ->once()
            ->andReturn(array_fill(0, 1536, 0.01));

        $vectorStoreMock->shouldReceive('query')
            ->once()
            ->andReturn([
                new ScoredChunkDTO('unrelated-1', 0.12, 'Low score noise', ['document_title' => 'Noise']),
            ]);

        $llmMock->shouldNotReceive('streamChat');

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);
        $this->app->instance(LlmProviderInterface::class, $llmMock);

        $response = $this->postJson('/api/rag/chat', [
            'message' => 'Dame una receta de pasta carbonara',
        ]);

        $response->assertStatus(200);
        $streamContent = $response->streamedContent();
        $this->assertStringContainsString('event: context', $streamContent);
        $this->assertStringContainsString('"sources":[]', $streamContent);
        $this->assertStringContainsString(__('home.rag_out_of_scope_fallback', [], 'es'), $streamContent);
        $this->assertStringContainsString('event: done', $streamContent);

        $this->assertDatabaseHas('rag_logs', [
            'question' => 'Dame una receta de pasta carbonara',
            'chunks_count' => 0,
            'cache_hit' => false,
            'blocked_reason' => RagBlockedReasonEnum::EmptyContext->value,
            'status' => RagLogStatusEnum::Blocked->value,
        ]);
    }

    public function test_rag_chat_allows_empty_context_when_history_is_present(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $embeddingMock->shouldReceive('embed')
            ->once()
            ->andReturn(array_fill(0, 1536, 0.01));

        $vectorStoreMock->shouldReceive('query')
            ->once()
            ->andReturn([]);

        $llmMock->shouldReceive('streamChat')
            ->once()
            ->andReturnUsing(function (ChatPromptDTO $prompt, callable $callback) {
                $callback('En ese proyecto usó webhooks idempotentes.');

                return 'En ese proyecto usó webhooks idempotentes.';
            });

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);
        $this->app->instance(LlmProviderInterface::class, $llmMock);

        $response = $this->postJson('/api/rag/chat', [
            'message' => '¿Y cómo manejó los pagos?',
            'history' => [
                ['role' => 'user', 'content' => 'Háblame de Leen Honey'],
                ['role' => 'assistant', 'content' => 'Moisés diseñó Leen Honey con Laravel.'],
            ],
        ]);

        $response->assertStatus(200);
        $streamContent = $response->streamedContent();
        $this->assertStringContainsString('webhooks idempotentes', $streamContent);
    }

    public function test_rag_chat_serves_normalized_exact_cache_on_repeat_first_turn_and_bypasses_when_history_present(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        // Expect 1 embed call (3rd request bypasses response cache due to history, but hits embedding cache),
        // and 2 vector queries + 2 LLM stream calls (1st request + 3rd request; 2nd is pure response cache hit)
        $embeddingMock->shouldReceive('embed')
            ->once()
            ->andReturn(array_fill(0, 1536, 0.05));

        $vectorStoreMock->shouldReceive('query')
            ->twice()
            ->andReturn([
                new ScoredChunkDTO('leenhoney-1', 0.92, 'Leen Honey architecture', ['document_title' => 'Leen Honey', 'section' => 'Architecture']),
            ]);

        $llmMock->shouldReceive('streamChat')
            ->twice()
            ->andReturnUsing(function (ChatPromptDTO $prompt, callable $callback) {
                $callback('Moisés usó Filament v5.');

                return 'Moisés usó Filament v5.';
            });

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);
        $this->app->instance(LlmProviderInterface::class, $llmMock);

        $first = $this->postJson('/api/rag/chat', [
            'message' => '¿Qué usó en Leen Honey?',
        ]);
        $first->assertStatus(200);
        $this->assertStringContainsString('Moisés usó Filament v5.', $first->streamedContent());

        // Normalized equivalent query (extra spaces, different casing, no punctuation)
        $second = $this->postJson('/api/rag/chat', [
            'message' => '  qué   usó en leen honey ',
        ]);
        $second->assertStatus(200);
        $secondContent = $second->streamedContent();
        $this->assertStringContainsString('Moisés usó Filament v5.', $secondContent);
        $this->assertStringContainsString('Leen Honey', $secondContent);

        $this->assertDatabaseHas('rag_logs', [
            'question' => 'qué   usó en leen honey',
            'cache_hit' => true,
            'status' => RagLogStatusEnum::Completed->value,
        ]);

        // Same question with history must NOT hit response cache
        $third = $this->postJson('/api/rag/chat', [
            'message' => '¿Qué usó en Leen Honey?',
            'history' => [
                ['role' => 'user', 'content' => 'Hola'],
                ['role' => 'assistant', 'content' => 'Hola, pregunta sobre Moisés.'],
            ],
        ]);
        $third->assertStatus(200);
        $this->assertStringContainsString('Moisés usó Filament v5.', $third->streamedContent());
    }

    public function test_rag_chat_enforces_tighter_rate_limit(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $embeddingMock->shouldReceive('embed')->andReturn(array_fill(0, 1536, 0.01));
        $vectorStoreMock->shouldReceive('query')->andReturn([]);
        $llmMock->shouldNotReceive('streamChat');

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);
        $this->app->instance(LlmProviderInterface::class, $llmMock);

        for ($i = 0; $i < 10; $i++) {
            $resp = $this->postJson('/api/rag/chat', ['message' => "unrelated {$i}"]);
            $resp->assertStatus(200);
            $resp->streamedContent();
        }

        $limited = $this->postJson('/api/rag/chat', ['message' => 'unrelated 11']);
        $limited->assertStatus(429);
    }

    public function test_record_rag_interaction_action_is_non_blocking_when_table_is_missing(): void
    {
        Schema::dropIfExists('rag_logs');

        $action = new RecordRagInteractionAction;
        $action(new RagInteractionLogDTO(
            sessionHash: 'hash',
            question: 'Test question',
            answer: 'Test answer',
            chunksCount: 1,
            topScore: 0.9,
            sources: [],
            cacheHit: false,
            blockedReason: null,
            latencyMs: 50,
            status: RagLogStatusEnum::Completed,
        ));

        $this->assertFalse(Schema::hasTable('rag_logs'));
    }

    public function test_rag_logs_artisan_command_lists_and_filters_interactions(): void
    {
        RagLog::query()->create([
            'session_hash' => 'hash-1',
            'question' => '¿Qué hizo en CarFleet?',
            'answer' => 'Clean Architecture SaaS',
            'chunks_count' => 3,
            'top_score' => 0.89,
            'sources' => [['id' => 'carfleet-1', 'score' => 0.89]],
            'cache_hit' => false,
            'blocked_reason' => null,
            'latency_ms' => 420,
            'status' => RagLogStatusEnum::Completed->value,
        ]);

        RagLog::query()->create([
            'session_hash' => 'hash-2',
            'question' => 'Give me a pizza recipe',
            'answer' => 'Out of scope',
            'chunks_count' => 0,
            'top_score' => null,
            'sources' => [],
            'cache_hit' => false,
            'blocked_reason' => RagBlockedReasonEnum::EmptyContext->value,
            'latency_ms' => 110,
            'status' => RagLogStatusEnum::Blocked->value,
        ]);

        $this->artisan('rag:logs')
            ->expectsOutputToContain('CarFleet')
            ->expectsOutputToContain('pizza recipe')
            ->assertSuccessful();

        $this->artisan('rag:logs', ['--blocked' => true])
            ->expectsOutputToContain('pizza recipe')
            ->doesntExpectOutputToContain('CarFleet')
            ->assertSuccessful();

        $this->artisan('rag:logs', ['--status' => 'invalid'])
            ->assertFailed();
    }
}
