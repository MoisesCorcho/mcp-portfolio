<?php

declare(strict_types=1);

namespace App\Gateways\Rag;

use App\Contracts\Rag\VectorStoreInterface;
use App\DTOs\Rag\ScoredChunkDTO;
use App\DTOs\Rag\VectorRecordDTO;
use App\Exceptions\Rag\VectorStoreException;
use Illuminate\Support\Facades\Http;

final class PineconeVectorStoreGateway implements VectorStoreInterface
{
    public function __construct(
        private readonly ?string $apiKey = null,
        private readonly ?string $host = null,
    ) {}

    public function upsert(array $records): void
    {
        if (empty($records)) {
            return;
        }

        $host = $this->resolveHost();
        $key = $this->resolveKey();

        $vectors = array_map(function (VectorRecordDTO $record): array {
            return [
                'id' => $record->id,
                'values' => $record->values,
                'metadata' => $record->metadata,
            ];
        }, $records);

        foreach (array_chunk($vectors, 100) as $chunk) {
            $response = Http::withHeaders([
                'Api-Key' => $key,
                'Content-Type' => 'application/json',
            ])->timeout(60)->post("{$host}/vectors/upsert", [
                'vectors' => $chunk,
            ]);

            if ($response->failed()) {
                throw new VectorStoreException('Pinecone upsert error: ' . $response->body());
            }
        }
    }

    public function query(array $vector, int $topK = 5, array $filter = []): array
    {
        $host = $this->resolveHost();
        $key = $this->resolveKey();

        $payload = [
            'vector' => $vector,
            'topK' => $topK,
            'includeMetadata' => true,
            'includeValues' => false,
        ];

        if (!empty($filter)) {
            $payload['filter'] = $filter;
        }

        $response = Http::withHeaders([
            'Api-Key' => $key,
            'Content-Type' => 'application/json',
        ])->timeout(15)->post("{$host}/query", $payload);

        if ($response->failed()) {
            throw new VectorStoreException('Pinecone query error: ' . $response->body());
        }

        $matches = $response->json('matches') ?? [];
        $results = [];

        foreach ($matches as $match) {
            $metadata = $match['metadata'] ?? [];
            $content = (string) ($metadata['content'] ?? '');

            $results[] = new ScoredChunkDTO(
                id: (string) ($match['id'] ?? ''),
                score: (float) ($match['score'] ?? 0.0),
                content: $content,
                metadata: $metadata
            );
        }

        return $results;
    }

    public function delete(array $ids): void
    {
        if (empty($ids)) {
            return;
        }

        $host = $this->resolveHost();
        $key = $this->resolveKey();

        $response = Http::withHeaders([
            'Api-Key' => $key,
            'Content-Type' => 'application/json',
        ])->timeout(15)->post("{$host}/vectors/delete", [
            'ids' => array_values($ids),
        ]);

        if ($response->failed()) {
            throw new VectorStoreException('Pinecone delete error: ' . $response->body());
        }
    }

    private function resolveHost(): string
    {
        $host = $this->host ?: (string) config('services.pinecone.host');
        if (empty($host)) {
            throw new VectorStoreException('Pinecone host URL is missing.');
        }

        return rtrim($host, '/');
    }

    private function resolveKey(): string
    {
        $key = $this->apiKey ?: (string) config('services.pinecone.key');
        if (empty($key)) {
            throw new VectorStoreException('Pinecone API key is missing.');
        }

        return $key;
    }
}
