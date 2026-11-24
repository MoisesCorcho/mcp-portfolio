<?php

declare(strict_types=1);

namespace Tests\Unit\Rag;

use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Contracts\Rag\LlmProviderInterface;
use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\ChatMessageDTO;
use App\DTOs\Rag\ChatPromptDTO;
use App\DTOs\Rag\VectorRecordDTO;
use App\Enums\Rag\EmbeddingModelEnum;
use App\Enums\Rag\MessageRoleEnum;
use App\Exceptions\Rag\EmbeddingException;
use App\Exceptions\Rag\VectorStoreException;
use App\Gateways\Rag\OpenAiEmbeddingGateway;
use App\Gateways\Rag\OpenAiLlmGateway;
use App\Gateways\Rag\PineconeVectorStoreGateway;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RagGatewaysTest extends TestCase
{
    public function test_service_container_bindings(): void
    {
        $this->assertInstanceOf(OpenAiEmbeddingGateway::class, app(EmbeddingProviderInterface::class));
        $this->assertInstanceOf(PineconeVectorStoreGateway::class, app(VectorStoreInterface::class));
        $this->assertInstanceOf(OpenAiLlmGateway::class, app(LlmProviderInterface::class));
    }

    public function test_openai_embedding_gateway_success(): void
    {
        Http::fake([
            'https://api.openai.com/v1/embeddings' => Http::response([
                'data' => [
                    ['embedding' => array_fill(0, 1536, 0.05)],
                ],
            ], 200),
        ]);

        $gateway = new OpenAiEmbeddingGateway(apiKey: 'test-key');
        $vector = $gateway->embed('Sample text for embedding', EmbeddingModelEnum::TextEmbedding3Small);

        $this->assertCount(1536, $vector);
        $this->assertSame(0.05, $vector[0]);
    }

    public function test_openai_embedding_gateway_missing_key_throws_exception(): void
    {
        $this->expectException(EmbeddingException::class);
        $gateway = new OpenAiEmbeddingGateway(apiKey: '');
        config(['services.openai.key' => '']);
        $gateway->embed('Text');
    }

    public function test_pinecone_vector_store_gateway_documents_api_upsert_and_query(): void
    {
        Http::fake([
            'https://fake-index.pinecone.io/namespaces/__default__/documents/upsert' => Http::response(['upsertedCount' => 1], 200),
            'https://fake-index.pinecone.io/namespaces/__default__/documents/search' => Http::response([
                'matches' => [
                    [
                        '_id' => 'doc-1',
                        '_score' => 0.92,
                        'content' => 'Leen Honey e-commerce architecture',
                        'project' => 'leenhoney',
                    ],
                ],
            ], 200),
        ]);

        $gateway = new PineconeVectorStoreGateway(apiKey: 'pin-key', host: 'https://fake-index.pinecone.io');

        $gateway->upsert([
            new VectorRecordDTO('doc-1', [0.1, 0.2], ['content' => 'Leen Honey']),
        ]);

        $results = $gateway->query([0.1, 0.2], topK: 1);

        $this->assertCount(1, $results);
        $this->assertSame('doc-1', $results[0]->id);
        $this->assertSame(0.92, $results[0]->score);
        $this->assertSame('Leen Honey e-commerce architecture', $results[0]->content);
    }

    public function test_pinecone_vector_store_gateway_legacy_fallback(): void
    {
        Http::fake([
            'https://fake-index.pinecone.io/namespaces/__default__/documents/upsert' => Http::response(['message' => 'Not Found'], 404),
            'https://fake-index.pinecone.io/vectors/upsert' => Http::response(['upsertedCount' => 1], 200),
            'https://fake-index.pinecone.io/namespaces/__default__/documents/search' => Http::response(['message' => 'Not Found'], 404),
            'https://fake-index.pinecone.io/query' => Http::response([
                'matches' => [
                    [
                        'id' => 'doc-legacy',
                        'score' => 0.88,
                        'metadata' => [
                            'content' => 'Legacy vector store content',
                        ],
                    ],
                ],
            ], 200),
        ]);

        $gateway = new PineconeVectorStoreGateway(apiKey: 'pin-key', host: 'https://fake-index.pinecone.io');

        $gateway->upsert([
            new VectorRecordDTO('doc-legacy', [0.1, 0.2], ['content' => 'Legacy']),
        ]);

        $results = $gateway->query([0.1, 0.2], topK: 1);

        $this->assertCount(1, $results);
        $this->assertSame('doc-legacy', $results[0]->id);
        $this->assertSame(0.88, $results[0]->score);
        $this->assertSame('Legacy vector store content', $results[0]->content);
    }

    public function test_pinecone_missing_host_throws_exception(): void
    {
        $this->expectException(VectorStoreException::class);
        $gateway = new PineconeVectorStoreGateway(apiKey: 'pin-key', host: '');
        config(['services.pinecone.host' => '']);
        $gateway->query([0.1]);
    }

    public function test_openai_llm_gateway_chat_success(): void
    {
        Http::fake([
            'https://api.openai.com/v1/chat/completions' => Http::response([
                'choices' => [
                    [
                        'message' => [
                            'role' => 'assistant',
                            'content' => 'Moisés engineered Leen Honey with robust webhooks.',
                        ],
                    ],
                ],
            ], 200),
        ]);

        $gateway = new OpenAiLlmGateway(apiKey: 'test-key');
        $prompt = new ChatPromptDTO(
            messages: [new ChatMessageDTO(MessageRoleEnum::User, 'Explain Leen Honey')],
        );

        $response = $gateway->chat($prompt);
        $this->assertSame('Moisés engineered Leen Honey with robust webhooks.', $response);
    }
}
