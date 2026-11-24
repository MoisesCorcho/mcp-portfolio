<?php

declare(strict_types=1);

namespace Tests\Feature\Rag;

use Tests\TestCase;

class RagDrawerRenderTest extends TestCase
{
    public function test_portfolio_renders_rag_hud_drawer_and_triggers(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('AI ADVISOR');
        $response->assertSee('AI Project Advisor');
        $response->assertSee('SYS//RAG_ENGINE: ONLINE');
        $response->assertSee('Leen Honey');
    }
}
