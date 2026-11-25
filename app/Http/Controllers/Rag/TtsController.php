<?php

declare(strict_types=1);

namespace App\Http\Controllers\Rag;

use App\Contracts\Rag\TtsProviderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class TtsController extends Controller
{
    public function __construct(
        private readonly TtsProviderInterface $ttsProvider,
    ) {}

    public function synthesize(Request $request): Response
    {
        $validated = $request->validate([
            'text' => ['required', 'string', 'max:1000'],
        ]);

        try {
            $audioBinary = $this->ttsProvider->synthesize((string) $validated['text']);

            return response($audioBinary, 200, [
                'Content-Type' => 'audio/mpeg',
                'Cache-Control' => 'public, max-age=86400',
            ]);
        } catch (\Throwable $e) {
            return response($e->getMessage(), 503);
        }
    }
}
