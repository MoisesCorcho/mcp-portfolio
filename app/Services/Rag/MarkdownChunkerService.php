<?php

declare(strict_types=1);

namespace App\Services\Rag;

use App\DTOs\Rag\DocumentChunkDTO;

final class MarkdownChunkerService
{
    /**
     * Chunk a Markdown document into semantic sections based on headings and content.
     *
     * @return array<int, DocumentChunkDTO>
     */
    public function chunk(string $documentId, string $markdownContent): array
    {
        $lines = explode("\n", $markdownContent);
        $docTitle = $documentId;
        $sections = [];
        $currentHeading = 'Overview';
        $currentLines = [];

        foreach ($lines as $line) {
            if (str_starts_with($line, '# ')) {
                $docTitle = trim(substr($line, 2));

                continue;
            }

            if (str_starts_with($line, '## ')) {
                if (! empty($currentLines)) {
                    $sections[] = [
                        'heading' => $currentHeading,
                        'content' => trim(implode("\n", $currentLines)),
                    ];
                    $currentLines = [];
                }
                $currentHeading = trim(substr($line, 3));

                continue;
            }

            $currentLines[] = $line;
        }

        if (! empty($currentLines)) {
            $sections[] = [
                'heading' => $currentHeading,
                'content' => trim(implode("\n", $currentLines)),
            ];
        }

        $chunks = [];
        $chunkIndex = 1;

        foreach ($sections as $section) {
            $text = $section['content'];
            if (empty($text)) {
                continue;
            }

            $chunkText = "Document: {$docTitle}\nSection: {$section['heading']}\n\n{$text}";

            $chunks[] = new DocumentChunkDTO(
                id: "{$documentId}-chunk-{$chunkIndex}",
                documentId: $documentId,
                content: $chunkText,
                metadata: [
                    'document_id' => $documentId,
                    'document_title' => $docTitle,
                    'section' => $section['heading'],
                    'chunk_index' => $chunkIndex,
                ]
            );

            $chunkIndex++;
        }

        return $chunks;
    }
}
