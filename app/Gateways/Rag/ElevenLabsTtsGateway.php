<?php

declare(strict_types=1);

namespace App\Gateways\Rag;

use App\Contracts\Rag\TtsProviderInterface;
use App\Exceptions\Rag\TtsException;
use Illuminate\Support\Facades\Http;

final class ElevenLabsTtsGateway implements TtsProviderInterface
{
    public function __construct(
        private readonly ?string $apiKey = null,
        private readonly ?string $voiceId = null,
        private readonly ?string $modelId = null,
        private readonly string $baseUrl = 'https://api.elevenlabs.io/v1',
    ) {}

    public function synthesize(string $text): string
    {
        $key = $this->apiKey ?: (string) config('services.elevenlabs.key');
        $voiceId = $this->voiceId ?: (string) config('services.elevenlabs.voice_id');
        $modelId = $this->modelId ?: (string) config('services.elevenlabs.model_id', 'eleven_multilingual_v2');

        if (empty($key)) {
            throw new TtsException('ElevenLabs API key is missing.');
        }

        if (empty($voiceId)) {
            throw new TtsException('ElevenLabs Voice ID is missing.');
        }

        $cleanText = trim(strip_tags($text));
        if (empty($cleanText)) {
            throw new TtsException('Text to synthesize cannot be empty.');
        }

        $trimmedText = mb_substr($cleanText, 0, 500);

        $response = Http::withHeaders([
            'xi-api-key' => $key,
            'Content-Type' => 'application/json',
            'Accept' => 'audio/mpeg',
        ])->timeout(30)->post("{$this->baseUrl}/text-to-speech/{$voiceId}", [
            'text' => $trimmedText,
            'model_id' => $modelId,
            'voice_settings' => [
                'stability' => 0.5,
                'similarity_boost' => 0.8,
            ],
        ]);

        if ($response->failed()) {
            throw new TtsException('ElevenLabs API error: ' . $response->body());
        }

        return $response->body();
    }
}
