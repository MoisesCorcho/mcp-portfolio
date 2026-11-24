<?php

declare(strict_types=1);

namespace Tests\Feature\Rag;

use App\Contracts\Rag\TtsProviderInterface;
use App\Exceptions\Rag\TtsException;
use App\Gateways\Rag\ElevenLabsTtsGateway;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RagTtsTest extends TestCase
{
    public function test_elevenlabs_tts_gateway_success(): void
    {
        Http::fake([
            'https://api.elevenlabs.io/v1/text-to-speech/*' => Http::response('FAKE_MP3_STREAM', 200, [
                'Content-Type' => 'audio/mpeg',
            ]),
        ]);

        $gateway = new ElevenLabsTtsGateway(
            apiKey: 'eleven-test-key',
            voiceId: 'cloned-voice-id',
            modelId: 'eleven_multilingual_v2'
        );

        $audio = $gateway->synthesize('Hola, soy el clon de voz de Moisés.');
        $this->assertSame('FAKE_MP3_STREAM', $audio);
    }

    public function test_elevenlabs_missing_credentials_throws_exception(): void
    {
        $this->expectException(TtsException::class);
        $gateway = new ElevenLabsTtsGateway(apiKey: '', voiceId: '');
        config(['services.elevenlabs.key' => '', 'services.elevenlabs.voice_id' => '']);
        $gateway->synthesize('Texto');
    }

    public function test_tts_controller_endpoint_success(): void
    {
        $ttsMock = \Mockery::mock(TtsProviderInterface::class);
        $ttsMock->shouldReceive('synthesize')
            ->once()
            ->with('Prueba de audio')
            ->andReturn('FAKE_AUDIO_BYTES');

        $this->app->instance(TtsProviderInterface::class, $ttsMock);

        $response = $this->postJson('/api/rag/tts', [
            'text' => 'Prueba de audio',
        ]);

        $response->assertStatus(200);
        $this->assertSame('audio/mpeg', $response->headers->get('Content-Type'));
        $this->assertSame('FAKE_AUDIO_BYTES', $response->getContent());
    }

    public function test_tts_controller_endpoint_failure_returns_503(): void
    {
        $ttsMock = \Mockery::mock(TtsProviderInterface::class);
        $ttsMock->shouldReceive('synthesize')
            ->once()
            ->andThrow(new TtsException('Quota exceeded'));

        $this->app->instance(TtsProviderInterface::class, $ttsMock);

        $response = $this->postJson('/api/rag/tts', [
            'text' => 'Prueba de audio',
        ]);

        $response->assertStatus(503);
    }
}
