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
    private const API_VERSION = '2026-07';

    private const DEFAULT_NAMESPACE = '__default__';

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

        // Modern Pinecone Document Indexes (2025/2026+) require Documents API
        $documents = array_map(function (VectorRecordDTO $record): array {
            return array_merge([
                '_id' => $record->id,
                'embedding' => $record->values,
            ], $record->metadata);
        }, $records);

        foreach (array_chunk($documents, 50) as $chunk) {
            $response = Http::withHeaders([
                'Api-Key' => $key,
                'Content-Type' => 'application/json',
                'X-Pinecone-API-Version' => self::API_VERSION,
            ])->timeout(60)->post("{$host}/namespaces/".self::DEFAULT_NAMESPACE.'/documents/upsert', [
                'documents' => $chunk,
            ]);

            // If Documents API is not supported (classic/legacy vector index), fall back to Vectors API
            if ($response->status() === 404 || str_contains($response->body(), 'vectors')) {
                $this->upsertLegacyVectors($host, $key, $records);

                return;
            }

            if ($response->failed()) {
                throw new VectorStoreException('Pinecone upsert error: '.$response->body());
            }
        }
    }

    public function query(array $vector, int $topK = 5, array $filter = []): array
    {
        $host = $this->resolveHost();
        $key = $this->resolveKey();

        $payload = [
            'top_k' => $topK,
            'score_by' => [
                [
                    'type' => 'dense_vector',
                    'fields' => ['embedding'],
                    'values' => $vector,
                ],
            ],
            'include_fields' => ['*'],
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        $response = Http::withHeaders([
            'Api-Key' => $key,
            'Content-Type' => 'application/json',
            'X-Pinecone-API-Version' => self::API_VERSION,
        ])->timeout(15)->post("{$host}/namespaces/".self::DEFAULT_NAMESPACE.'/documents/search', $payload);

        // Fallback to legacy vectors query if Documents API is not found
        if ($response->status() === 404 || str_contains($response->body(), 'vectors')) {
            return $this->queryLegacyVectors($host, $key, $vector, $topK, $filter);
        }

        if ($response->failed()) {
            throw new VectorStoreException('Pinecone query error: '.$response->body());
        }

        $matches = $response->json('matches') ?? $response->json('results') ?? [];
        $results = [];

        foreach ($matches as $match) {
            $fields = $match['fields'] ?? [];
            $metadata = ! empty($fields) ? $fields : ($match['metadata'] ?? $match);
            $content = (string) ($match['content'] ?? $metadata['content'] ?? '');

            unset($metadata['_id'], $metadata['id'], $metadata['_score'], $metadata['score'], $metadata['embedding'], $metadata['fields']);

            $results[] = new ScoredChunkDTO(
                id: (string) ($match['_id'] ?? $match['id'] ?? ''),
                score: (float) ($match['_score'] ?? $match['score'] ?? 0.0),
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
            'X-Pinecone-API-Version' => self::API_VERSION,
        ])->timeout(15)->post("{$host}/namespaces/".self::DEFAULT_NAMESPACE.'/documents/delete', [
            'ids' => array_values($ids),
        ]);

        if ($response->status() === 404) {
            $this->deleteLegacyVectors($host, $key, $ids);

            return;
        }

        if ($response->failed()) {
            throw new VectorStoreException('Pinecone delete error: '.$response->body());
        }
    }

    private function upsertLegacyVectors(string $host, string $key, array $records): void
    {
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
                throw new VectorStoreException('Pinecone upsert error: '.$response->body());
            }
        }
    }

    private function queryLegacyVectors(string $host, string $key, array $vector, int $topK, array $filter): array
    {
        $payload = [
            'vector' => $vector,
            'topK' => $topK,
            'includeMetadata' => true,
            'includeValues' => false,
        ];

        if (! empty($filter)) {
            $payload['filter'] = $filter;
        }

        $response = Http::withHeaders([
            'Api-Key' => $key,
            'Content-Type' => 'application/json',
        ])->timeout(15)->post("{$host}/query", $payload);

        if ($response->failed()) {
            throw new VectorStoreException('Pinecone query error: '.$response->body());
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

    private function deleteLegacyVectors(string $host, string $key, array $ids): void
    {
        $response = Http::withHeaders([
            'Api-Key' => $key,
            'Content-Type' => 'application/json',
        ])->timeout(15)->post("{$host}/vectors/delete", [
            'ids' => array_values($ids),
        ]);

        if ($response->failed()) {
            throw new VectorStoreException('Pinecone delete error: '.$response->body());
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
