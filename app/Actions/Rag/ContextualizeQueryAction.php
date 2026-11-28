<?php

declare(strict_types=1);

namespace App\Actions\Rag;

use App\Contracts\Rag\LlmProviderInterface;
use App\DTOs\Rag\ChatMessageDTO;
use App\DTOs\Rag\ChatPromptDTO;
use App\Enums\Rag\LlmModelEnum;
use App\Enums\Rag\MessageRoleEnum;

final class ContextualizeQueryAction
{
    public function __construct(
        private readonly LlmProviderInterface $llmProvider,
    ) {}

    /**
     * Rewrite a follow-up user message into a standalone search query using recent history.
     *
     * @param  array<int, array{role: string, content: string}>  $history
     */
    public function __invoke(string $userMessage, array $history): string
    {
        $cleanMessage = trim($userMessage);
        if ($cleanMessage === '' || $history === []) {
            return $cleanMessage;
        }

        $messages = [
            new ChatMessageDTO(
                MessageRoleEnum::System,
                'Rewrite the latest user message into a standalone search query about Moisés Corcho (his portfolio, projects, tech stack, experience, soft skills, or documented interests). '
                .'Use conversation history ONLY to resolve pronouns or missing context (e.g. "what about PHP?" -> "Does Moisés Corcho know PHP and what projects has he built with PHP?"). '
                .'If the latest message switches to a completely new topic, keep ONLY the new topic and do NOT carry over unrelated prior topics. '
                .'Return ONLY the rewritten search query in the same language as the latest message, with no quotes or extra explanation.'
            ),
        ];

        foreach (array_slice($history, -4) as $item) {
            $role = $item['role'] === 'assistant' ? MessageRoleEnum::Assistant : MessageRoleEnum::User;
            $messages[] = new ChatMessageDTO($role, (string) $item['content']);
        }

        $messages[] = new ChatMessageDTO(MessageRoleEnum::User, $cleanMessage);

        try {
            $rewritten = trim($this->llmProvider->chat(new ChatPromptDTO(
                messages: $messages,
                contextChunks: [],
                model: LlmModelEnum::Gpt4oMini,
                temperature: 0.0,
                maxTokens: 80,
            )));

            return $rewritten !== '' ? $rewritten : $cleanMessage;
        } catch (\Throwable) {
            return $cleanMessage;
        }
    }
}
