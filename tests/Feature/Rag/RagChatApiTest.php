<?php

declare(strict_types=1);

namespace Tests\Feature\Rag;

use App\Actions\Rag\ContextualizeQueryAction;
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

    public function test_retrieve_relevant_context_diversifies_chunks_across_documents(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);

        $embeddingMock->shouldReceive('embed')
            ->once()
            ->andReturn(array_fill(0, 1536, 0.05));

        $vectorStoreMock->shouldReceive('query')
            ->once()
            ->with(Mockery::any(), 12)
            ->andReturn([
                new ScoredChunkDTO('inforeal-chunk-1', 0.91, 'InfoReal 1', ['document_id' => '08-inforeal-cms']),
                new ScoredChunkDTO('inforeal-chunk-2', 0.89, 'InfoReal 2', ['document_id' => '08-inforeal-cms']),
                new ScoredChunkDTO('inforeal-chunk-3', 0.87, 'InfoReal 3', ['document_id' => '08-inforeal-cms']),
                new ScoredChunkDTO('catalog-chunk-1', 0.84, 'Catalog', ['document_id' => '00-portfolio-catalog']),
                new ScoredChunkDTO('carfleet-chunk-1', 0.81, 'CarFleet', ['document_id' => '03-carfleet-saas']),
                new ScoredChunkDTO('leenhoney-chunk-1', 0.79, 'LeenHoney', ['document_id' => '02-leenhoney-ecommerce']),
            ]);

        $action = new RetrieveRelevantContextAction($embeddingMock, $vectorStoreMock, new RagCacheService);
        $results = $action('proyectos con PHP', topK: 5, minScore: 0.27, fetchK: 12, maxPerDocument: 2);

        $this->assertCount(5, $results);
        $ids = array_map(static fn (ScoredChunkDTO $c): string => $c->id, $results);
        $this->assertContains('catalog-chunk-1', $ids);
        $this->assertContains('carfleet-chunk-1', $ids);
        $this->assertContains('leenhoney-chunk-1', $ids);
        $this->assertNotContains('inforeal-chunk-3', $ids);
    }

    public function test_contextualize_query_action_rewrites_and_falls_back_safely(): void
    {
        $llmMock = Mockery::mock(LlmProviderInterface::class);
        $llmMock->shouldReceive('chat')
            ->once()
            ->andReturn('¿Moisés Corcho tiene experiencia y proyectos en PHP?');

        $action = new ContextualizeQueryAction($llmMock);
        $rewritten = $action('y sabe sobre PHP?', [
            ['role' => 'user', 'content' => 'cual es la tecnologia que mas sabe?'],
            ['role' => 'assistant', 'content' => 'Moisés domina Laravel y PHP.'],
        ]);

        $this->assertSame('¿Moisés Corcho tiene experiencia y proyectos en PHP?', $rewritten);

        // Falls back cleanly if provider fails
        $failingLlm = Mockery::mock(LlmProviderInterface::class);
        $failingLlm->shouldReceive('chat')->once()->andThrow(new \RuntimeException('timeout'));

        $fallbackAction = new ContextualizeQueryAction($failingLlm);
        $this->assertSame('y sabe sobre PHP?', $fallbackAction('y sabe sobre PHP?', [
            ['role' => 'user', 'content' => 'Hola'],
        ]));
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

    public function test_rag_chat_short_circuits_empty_context_in_spanish_even_without_accents(): void
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
            'message' => 'dame el codigo para realizar prueba de fibonacci en php',
        ]);

        $response->assertStatus(200);
        $streamContent = $response->streamedContent();
        $this->assertStringContainsString('event: context', $streamContent);
        $this->assertStringContainsString('"sources":[]', $streamContent);
        $this->assertStringContainsString(__('home.rag_out_of_scope_fallback', [], 'es'), $streamContent);
        $this->assertStringContainsString('event: done', $streamContent);

        $this->assertDatabaseHas('rag_logs', [
            'question' => 'dame el codigo para realizar prueba de fibonacci en php',
            'chunks_count' => 0,
            'cache_hit' => false,
            'blocked_reason' => RagBlockedReasonEnum::EmptyContext->value,
            'status' => RagLogStatusEnum::Blocked->value,
        ]);
    }

    public function test_rag_chat_respects_explicit_locale_from_client(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $embeddingMock->shouldReceive('embed')->once()->andReturn(array_fill(0, 1536, 0.01));
        $vectorStoreMock->shouldReceive('query')->once()->andReturn([]);
        $llmMock->shouldNotReceive('streamChat');

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);
        $this->app->instance(LlmProviderInterface::class, $llmMock);

        $response = $this->postJson('/api/rag/chat', [
            'message' => 'Give me a pasta recipe',
            'locale' => 'en',
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString(__('home.rag_out_of_scope_fallback', [], 'en'), $response->streamedContent());
    }

    public function test_rag_chat_contextualizes_follow_up_and_injects_no_context_guardrail_when_empty(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $llmMock->shouldReceive('chat')
            ->once()
            ->andReturn('¿Moisés Corcho tiene experiencia con PHP?');

        $embeddingMock->shouldReceive('embed')
            ->once()
            ->with('¿Moisés Corcho tiene experiencia con PHP?', Mockery::any())
            ->andReturn(array_fill(0, 1536, 0.01));

        $vectorStoreMock->shouldReceive('query')
            ->once()
            ->andReturn([]);

        $llmMock->shouldReceive('streamChat')
            ->once()
            ->with(Mockery::on(function (ChatPromptDTO $prompt): bool {
                $systemMessages = array_filter($prompt->messages, static fn ($m): bool => $m->role->value === 'system');
                $joined = implode("\n", array_map(static fn ($m): string => $m->content, $systemMessages));

                return str_contains($joined, 'Do NOT invent or assume any technologies');
            }), Mockery::any())
            ->andReturnUsing(function (ChatPromptDTO $prompt, callable $callback) {
                $callback('No cuento con nuevos fragmentos verificados para ese detalle.');

                return 'No cuento con nuevos fragmentos verificados para ese detalle.';
            });

        $this->app->instance(EmbeddingProviderInterface::class, $embeddingMock);
        $this->app->instance(VectorStoreInterface::class, $vectorStoreMock);
        $this->app->instance(LlmProviderInterface::class, $llmMock);

        $response = $this->postJson('/api/rag/chat', [
            'message' => 'y sabe sobre PHP?',
            'history' => [
                ['role' => 'user', 'content' => 'Háblame de sus proyectos'],
                ['role' => 'assistant', 'content' => 'Moisés diseñó varios sistemas web.'],
            ],
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('No cuento con nuevos fragmentos verificados', $response->streamedContent());
    }

    public function test_rag_chat_serves_normalized_exact_cache_on_repeat_first_turn_and_bypasses_when_history_present(): void
    {
        $embeddingMock = Mockery::mock(EmbeddingProviderInterface::class);
        $vectorStoreMock = Mockery::mock(VectorStoreInterface::class);
        $llmMock = Mockery::mock(LlmProviderInterface::class);

        $llmMock->shouldReceive('chat')
            ->once()
            ->andReturn('¿Qué usó en Leen Honey?');

        // 1st request embeds original query; 2nd is pure response cache hit;
        // 3rd contextualizes to the same normalized query and hits embedding cache!
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
