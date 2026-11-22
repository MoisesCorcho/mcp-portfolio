<?php

namespace Tests\Feature;

use Tests\TestCase;

class V2ExtrudedBoxTest extends TestCase
{
    public function test_extruded_box_renders_default_div(): void
    {
        $view = $this->blade('<x-v2.extruded-box>Test Content</x-v2.extruded-box>');

        $view->assertSee('v2-extruded');
        $view->assertSee('data-extruded', false);
        $view->assertSee('data-depth="8"', false);
        $view->assertSee('v2-extruded-sheen');
        $view->assertSee('v2-extruded-beam');
        $view->assertSee('Test Content');
    }

    public function test_extruded_box_renders_interactive_button(): void
    {
        $view = $this->blade('<x-v2.extruded-box as="button" variant="amber" depth="md">Click Me</x-v2.extruded-box>');

        $view->assertSee('<button', false);
        $view->assertSee('v2-extruded-interactive');
        $view->assertSee('bg-amber-500');
        $view->assertSee('data-depth="8"', false);
        $view->assertSee('Click Me');
    }

    public function test_extruded_box_supports_cad_pins_and_depths(): void
    {
        $view = $this->blade('<x-v2.extruded-box depth="lg" :cad-pins="true">Showroom Card</x-v2.extruded-box>');

        $view->assertSee('data-depth="16"', false);
        $view->assertSee('bg-amber-500/80');
        $view->assertSee('Showroom Card');
    }

    public function test_social_links_renders_extruded_boxes(): void
    {
        $view = $this->blade('<x-v2.social-links :include-cv="true" />');

        $view->assertSee('v2-extruded');
        $view->assertSee('aria-label="Instagram"', false);
        $view->assertSee('aria-label="LinkedIn"', false);
        $view->assertSee('aria-label="GitHub"', false);
        $view->assertSee('CV');
    }

    public function test_experience_chambers_use_extruded_boxes(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('v2-extruded');
        $response->assertSee('data-extruded', false);
    }
}
