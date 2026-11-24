<?php

declare(strict_types=1);

namespace App\Gateways\Rag;

use App\Contracts\Rag\EmbeddingProviderInterface;
use App\Enums\Rag\EmbeddingModelEnum;
use App\Exceptions\Rag\EmbeddingException;
use Illuminate\Support\Facades\Http;

final class OpenAiEmbeddingGateway implements EmbeddingProviderInterface
{
    public function __construct(
        private readonly ?string $apiKey = null,
        private readonly string $baseUrl = 'https://api.openai.com/v1',
    ) {}

    public function embed(string $text, EmbeddingModelEnum $model = EmbeddingModelEnum::TextEmbedding3Small): array
    {
        $batch = $this->embedBatch([$text], $model);

        return $batch[0] ?? [];
    }

    public function embedBatch(array $texts, EmbeddingModelEnum $model = EmbeddingModelEnum::TextEmbedding3Small): array
    {
        $key = $this->apiKey ?: (string) config('services.openai.key');
        if (empty($key)) {
            throw new EmbeddingException('OpenAI API key is missing.');
        }

        if (empty($texts)) {
            return [];
        }

        $response = Http::withToken($key)
            ->timeout(30)
            ->post("{$this->baseUrl}/embeddings", [
                'model' => $model->value,
                'input' => array_values($texts),
                'dimensions' => $model->dimension(),
            ]);

        if ($response->failed()) {
            throw new EmbeddingException('OpenAI Embedding API error: ' . $response->body());
        }

        $data = $response->json('data') ?? [];
        $vectors = [];

        foreach ($data as $item) {
            $vectors[] = $item['embedding'] ?? [];
        }

        return $vectors;
    }
}
