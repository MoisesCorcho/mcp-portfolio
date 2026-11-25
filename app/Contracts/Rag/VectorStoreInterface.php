<?php

declare(strict_types=1);

namespace App\Contracts\Rag;

use App\DTOs\Rag\ScoredChunkDTO;
use App\DTOs\Rag\VectorRecordDTO;

interface VectorStoreInterface
{
    /**
     * Upsert a collection of vector records into the store.
     *
     * @param  array<int, VectorRecordDTO>  $records
     */
    public function upsert(array $records): void;

    /**
     * Query for the most similar vector records.
     *
     * @param  array<int, float>  $vector
     * @param  array<string, mixed>  $filter
     * @return array<int, ScoredChunkDTO>
     */
    public function query(array $vector, int $topK = 5, array $filter = []): array;

    /**
     * Delete records by IDs.
     *
     * @param  array<int, string>  $ids
     */
    public function delete(array $ids): void;
}
