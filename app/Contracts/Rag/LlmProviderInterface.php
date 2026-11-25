<?php

declare(strict_types=1);

namespace App\Contracts\Rag;

use App\DTOs\Rag\ChatPromptDTO;

interface LlmProviderInterface
{
    /**
     * Generate a complete chat completion response.
     */
    public function chat(ChatPromptDTO $prompt): string;

    /**
     * Stream the chat response token-by-token invoking the provided callback.
     *
     * @param  callable(string $token): void  $onChunk
     */
    public function streamChat(ChatPromptDTO $prompt, callable $onChunk): string;
}
