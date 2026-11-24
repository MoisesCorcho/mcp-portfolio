<?php

declare(strict_types=1);

namespace Tests\Unit\Rag;

use App\DTOs\Rag\ChatMessageDTO;
use App\DTOs\Rag\ChatPromptDTO;
use App\DTOs\Rag\DocumentChunkDTO;
use App\DTOs\Rag\ScoredChunkDTO;
use App\DTOs\Rag\VectorRecordDTO;
use App\Enums\Rag\EmbeddingModelEnum;
use App\Enums\Rag\LlmModelEnum;
use App\Enums\Rag\MessageRoleEnum;
use App\Enums\Rag\RagDocumentTypeEnum;
use PHPUnit\Framework\TestCase;

class RagDomainTest extends TestCase
{
    public function test_embedding_model_enum_dimensions(): void
    {
        $this->assertSame(1536, EmbeddingModelEnum::TextEmbedding3Small->dimension());
        $this->assertSame(3072, EmbeddingModelEnum::TextEmbedding3Large->dimension());
    }

    public function test_enums_expose_expected_values(): void
    {
        $this->assertSame('gpt-4o-mini', LlmModelEnum::Gpt4oMini->value);
        $this->assertSame('project', RagDocumentTypeEnum::Project->value);
        $this->assertSame('user', MessageRoleEnum::User->value);
    }

    public function test_document_chunk_dto_instantiation(): void
    {
        $chunk = new DocumentChunkDTO(
            id: 'leenhoney-chunk-1',
            documentId: 'leenhoney',
            content: 'E-commerce platform built with Laravel 13',
            metadata: ['project' => 'leenhoney']
        );

        $this->assertSame('leenhoney-chunk-1', $chunk->id);
        $this->assertSame('leenhoney', $chunk->documentId);
        $this->assertArrayHasKey('project', $chunk->metadata);
    }

    public function test_vector_record_and_scored_chunk_dtos(): void
    {
        $record = new VectorRecordDTO(
            id: 'vec-1',
            values: [0.1, 0.2, 0.3],
            metadata: ['title' => 'Sample']
        );
        $this->assertCount(3, $record->values);

        $scored = new ScoredChunkDTO(
            id: 'vec-1',
            score: 0.95,
            content: 'Sample content',
            metadata: ['title' => 'Sample']
        );
        $this->assertSame(0.95, $scored->score);
    }

    public function test_chat_message_and_prompt_dtos(): void
    {
        $message = new ChatMessageDTO(MessageRoleEnum::User, 'What stack did Moises use for Leen Honey?');
        $prompt = new ChatPromptDTO(
            messages: [$message],
            contextChunks: [],
            model: LlmModelEnum::Gpt4oMini,
            temperature: 0.2
        );

        $this->assertCount(1, $prompt->messages);
        $this->assertSame(LlmModelEnum::Gpt4oMini, $prompt->model);
        $this->assertSame(0.2, $prompt->temperature);
    }
}
