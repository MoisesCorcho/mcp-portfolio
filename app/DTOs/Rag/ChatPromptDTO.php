<?php

declare(strict_types=1);

namespace App\DTOs\Rag;

use App\Enums\Rag\LlmModelEnum;

final readonly class ChatPromptDTO
{
    /**
     * @param  array<int, ChatMessageDTO>  $messages
     * @param  array<int, ScoredChunkDTO>  $contextChunks
     */
    public function __construct(
        public array $messages,
        public array $contextChunks = [],
        public LlmModelEnum $model = LlmModelEnum::Gpt4oMini,
        public float $temperature = 0.2,
        public int $maxTokens = 600,
    ) {}
}
