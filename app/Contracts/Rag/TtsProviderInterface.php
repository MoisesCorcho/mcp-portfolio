<?php

declare(strict_types=1);

namespace App\Contracts\Rag;

interface TtsProviderInterface
{
    /**
     * Synthesize speech audio from text.
     *
     * @return string Binary audio content (MP3)
     */
    public function synthesize(string $text): string;
}
