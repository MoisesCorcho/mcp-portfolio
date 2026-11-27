<?php

declare(strict_types=1);

namespace App\Gateways\Rag;

use App\Contracts\Rag\LlmProviderInterface;
use App\DTOs\Rag\ChatPromptDTO;
use App\Exceptions\Rag\LlmException;
use Illuminate\Support\Facades\Http;

final class OpenAiLlmGateway implements LlmProviderInterface
{
    public function __construct(
        private readonly ?string $apiKey = null,
        private readonly string $baseUrl = 'https://api.openai.com/v1',
    ) {}

    public function chat(ChatPromptDTO $prompt): string
    {
        $key = $this->resolveKey();
        $messages = $this->buildMessages($prompt);

        $response = Http::withToken($key)
            ->timeout(60)
            ->post("{$this->baseUrl}/chat/completions", [
                'model' => $prompt->model->value,
                'messages' => $messages,
                'temperature' => $prompt->temperature,
                'max_tokens' => $prompt->maxTokens,
            ]);

        if ($response->failed()) {
            throw new LlmException('OpenAI Chat error: '.$response->body());
        }

        return (string) ($response->json('choices.0.message.content') ?? '');
    }

    public function streamChat(ChatPromptDTO $prompt, callable $onChunk): string
    {
        $key = $this->resolveKey();
        $messages = $this->buildMessages($prompt);
        $fullContent = '';
        $buffer = '';

        $body = json_encode([
            'model' => $prompt->model->value,
            'messages' => $messages,
            'temperature' => $prompt->temperature,
            'max_tokens' => $prompt->maxTokens,
            'stream' => true,
        ]);

        $ch = curl_init("{$this->baseUrl}/chat/completions");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "Authorization: Bearer {$key}",
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);

        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $data) use (&$fullContent, &$buffer, $onChunk) {
            $buffer .= $data;
            $lines = explode("\n", $buffer);
            // Retain incomplete trailing line in the persistent buffer
            $buffer = array_pop($lines) ?? '';

            foreach ($lines as $line) {
                $line = trim($line);
                if (! str_starts_with($line, 'data: ')) {
                    continue;
                }
                $payload = trim(substr($line, 6));
                if ($payload === '[DONE]') {
                    break;
                }
                $json = json_decode($payload, true);
                if (is_array($json) && isset($json['choices'][0]['delta']['content'])) {
                    $token = (string) $json['choices'][0]['delta']['content'];
                    $fullContent .= $token;
                    $onChunk($token);
                }
            }

            return strlen($data);
        });

        $success = curl_exec($ch);
        $err = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (! $success || $httpCode >= 400) {
            throw new LlmException("OpenAI stream error (HTTP {$httpCode}): {$err}");
        }

        return $fullContent;
    }

    private function buildMessages(ChatPromptDTO $prompt): array
    {
        $messages = [];

        if (! empty($prompt->contextChunks)) {
            $contextText = "Relevant technical context retrieved from Moisés Corcho's portfolio & repositories:\n\n";
            foreach ($prompt->contextChunks as $i => $chunk) {
                $index = $i + 1;
                $contextText .= "--- Document {$index} (Score: ".round($chunk->score, 3).") ---\n";
                $contextText .= $chunk->content."\n\n";
            }

            $messages[] = [
                'role' => 'system',
                'content' => $contextText,
            ];
        }

        foreach ($prompt->messages as $msg) {
            $messages[] = [
                'role' => $msg->role->value,
                'content' => $msg->content,
            ];
        }

        return $messages;
    }

    private function resolveKey(): string
    {
        $key = $this->apiKey ?: (string) config('services.openai.key');
        if (empty($key)) {
            throw new LlmException('OpenAI API key is missing.');
        }

        return $key;
    }
}
