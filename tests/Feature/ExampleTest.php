<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_v2_route_returns_a_successful_response(): void
    {
        $response = $this->get('/v2');

        $response->assertStatus(200);
        $response->assertSee('Oxanium');
        $response->assertSee('Roboto+Mono');
        $response->assertSee('font-roboto-mono');
        $response->assertSee('font-oxanium');
        $response->assertSee('MoisesPiano.jpeg');
        $response->assertDontSee('AUTOMATED_CYCLING');
        $response->assertDontSee('SPEC: SYSTEMS_ENGINEER');
        $response->assertDontSee('EXPERIMENTO');
        $response->assertDontSee('VERTICAL SLICE POC');
        $response->assertDontSee('Track Record');
        $response->assertSee('InfoReal');
        $response->assertSee('Amatu Café', false);
        $response->assertSee('Keep Coding and Nobody Is Fired');
        $response->assertSee('Ingeniero de Sistemas');
        $response->assertSee('Data Engineer Associate');
        $response->assertSee('AI Engineer for Developers Associate');
        $response->assertSee('Mobile Apps & PWAs');
        $response->assertSee('Flutter');
        $response->assertSee('Cross-Platform & Mobile');
        $response->assertSee('AIEDA0013044819611');
        $response->assertSee('DEA0015812718348');
        $response->assertSee('b8phnx');
        $response->assertSee('NoticiasInfoReal');
        $response->assertSee('amatu-cafe');
        $response->assertSee('Keep-Coding-and-Nobody-Is-Fired');
        $response->assertSee('AWS Bedrock');
        $response->assertSee('Filament v3');
    }

    public function test_the_v2_videogame_route_returns_a_successful_response(): void
    {
        $response = $this->get('/v2/videogame');

        $response->assertStatus(200);
        $response->assertSee("THE DEVELOPER'S", false);
        $response->assertSee('Volver al Portfolio V2');
        $response->assertSee('Phaser 3');
    }
}
