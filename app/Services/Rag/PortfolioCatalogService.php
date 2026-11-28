<?php

declare(strict_types=1);

namespace App\Services\Rag;

use App\DTOs\Rag\DocumentChunkDTO;

final class PortfolioCatalogService
{
    public const CATALOG_DOCUMENT_ID = '00-portfolio-catalog';

    /**
     * Generic ecosystem taxonomy mapping so framework/tool tags also expose
     * their parent language or domain during semantic retrieval.
     *
     * @var array<string, array<int, string>>
     */
    private const ECOSYSTEM_TAXONOMY = [
        'laravel' => ['PHP'],
        'livewire' => ['PHP', 'Laravel'],
        'filament' => ['PHP', 'Laravel'],
        'flutter' => ['Dart', 'Mobile'],
        'next.js' => ['React', 'TypeScript', 'JavaScript'],
        'react' => ['JavaScript'],
        'vue' => ['JavaScript'],
        'inertia' => ['Laravel', 'PHP', 'JavaScript'],
        'pgvector' => ['PostgreSQL', 'Vector Search', 'AI'],
        'pinecone' => ['Vector Search', 'RAG', 'AI'],
        'playwright' => ['Node.js', 'Automation'],
        'bedrock' => ['AWS', 'AI', 'LLMs'],
    ];

    public function __construct(
        private readonly ?MarkdownChunkerService $chunker = null,
    ) {}

    /**
     * Build semantic chunks directly from config/portfolio.php (SSOT).
     *
     * @return array<int, DocumentChunkDTO>
     */
    public function buildChunks(): array
    {
        $chunker = $this->chunker ?? new MarkdownChunkerService;

        return $chunker->chunk(self::CATALOG_DOCUMENT_ID, $this->buildMarkdown());
    }

    public function buildMarkdown(): string
    {
        /** @var array<int, array<string, mixed>> $projects */
        $projects = config('portfolio.projects', []);
        /** @var array<int, array<string, mixed>> $services */
        $services = config('portfolio.services', []);
        /** @var array<int, string> $skills */
        $skills = config('portfolio.skills.cycling', []);
        /** @var array<int, array<string, mixed>> $certifications */
        $certifications = config('portfolio.certifications', []);
        /** @var array<int, array<string, mixed>> $education */
        $education = config('portfolio.education', []);

        $lines = [
            '# Complete Portfolio Catalog: Moisés Corcho (Projects, Technologies & Credentials)',
            '',
            '## Complete Portfolio Projects Index (All Projects by Stack & Technology)',
            'This is the authoritative complete list of projects built by Moisés Corcho in his portfolio. When asked for all projects using any technology (such as PHP, Laravel, Livewire, Tailwind CSS, Docker, Filament, PostgreSQL, Flutter, React, Next.js, TypeScript, Node.js, or AI), check every project listed below:',
            '',
        ];

        foreach ($projects as $index => $project) {
            $title = (string) ($project['title'] ?? 'Untitled');
            $category = (string) ($project['category'] ?? '');
            $tags = is_array($project['tags'] ?? null) ? $project['tags'] : [];
            $expandedStack = $this->expandEcosystemTags($tags);
            $links = $this->formatLinks($project);

            $number = $index + 1;
            $entry = "{$number}. **{$title}**";
            if ($category !== '') {
                $entry .= " ({$category})";
            }
            $entry .= ' — Technologies & Stack: '.implode(', ', $expandedStack).'.';
            if ($links !== '') {
                $entry .= " Links: {$links}.";
            }

            $lines[] = $entry;
        }

        $lines[] = '';
        $lines[] = '## Portfolio Core Skills, Services, Education & Certifications';

        if ($skills !== []) {
            $lines[] = '- **Core Technologies**: '.implode(', ', $this->expandEcosystemTags($skills)).'.';
        }

        foreach ($services as $service) {
            $title = __((string) ($service['title_key'] ?? ''), [], 'en');
            $tags = is_array($service['tags'] ?? null) ? $service['tags'] : [];
            $lines[] = "- **Service — {$title}**: ".implode(', ', $this->expandEcosystemTags($tags)).'.';
        }

        foreach ($education as $edu) {
            $degree = __((string) ($edu['degree_key'] ?? ''), [], 'en');
            $institution = __((string) ($edu['institution_key'] ?? ''), [], 'en');
            $period = __((string) ($edu['period_key'] ?? ''), [], 'en');
            $lines[] = "- **Education**: {$degree} — {$institution} ({$period}).";
        }

        foreach ($certifications as $cert) {
            $title = (string) ($cert['title'] ?? '');
            $issuer = (string) ($cert['issuer'] ?? '');
            $score = isset($cert['score']) ? " ({$cert['score']})" : '';
            $lines[] = "- **Certification**: {$title}{$score} by {$issuer}.";
        }

        return implode("\n", $lines)."\n";
    }

    /**
     * @param  array<int, string>  $tags
     * @return array<int, string>
     */
    public function expandEcosystemTags(array $tags): array
    {
        $expanded = [];

        foreach ($tags as $rawTag) {
            $tag = trim((string) $rawTag);
            if ($tag === '') {
                continue;
            }

            $lowerTag = mb_strtolower($tag, 'UTF-8');
            foreach (self::ECOSYSTEM_TAXONOMY as $needle => $parents) {
                if (str_contains($lowerTag, $needle)) {
                    foreach ($parents as $parent) {
                        $expanded[$parent] = true;
                    }
                }
            }

            $expanded[$tag] = true;
        }

        return array_keys($expanded);
    }

    /**
     * @param  array<string, mixed>  $project
     */
    private function formatLinks(array $project): string
    {
        $parts = [];
        foreach (['url', 'external_url', 'github'] as $key) {
            if (! empty($project[$key]) && is_string($project[$key])) {
                $parts[] = $project[$key];
            }
        }

        return implode(' | ', $parts);
    }
}
