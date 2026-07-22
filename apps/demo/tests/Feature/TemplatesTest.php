<?php

namespace Tests\Feature;

use Tests\TestCase;

class TemplatesTest extends TestCase
{
    public function test_marketing_landing_renders(): void
    {
        // /raw renders the block directly, exercising every component + icon.
        $res = $this->get('/blocks/marketing-01/raw');
        $res->assertOk();
        $res->assertSee('Ship your product at the speed of thought');
        $res->assertSee('Trusted by teams at');

        $this->get('/blocks/marketing-01')->assertOk();
    }

    public function test_pricing_page_renders(): void
    {
        $res = $this->get('/blocks/pricing-01/raw');
        $res->assertOk();
        $res->assertSee('Simple, transparent pricing');
        $res->assertSee('Most popular');

        $this->get('/blocks/pricing-01')->assertOk();
    }

    public function test_new_categories_appear_in_the_blocks_gallery(): void
    {
        $this->get('/blocks')
            ->assertOk()
            ->assertSee('Marketing')
            ->assertSee('Pricing');
    }

    public function test_new_templates_are_installable_from_the_registry(): void
    {
        $res = $this->get('/r/blocks/marketing-01.json');
        $res->assertOk();
        $this->assertNotEmpty($res->json('files.0.content'));
        $res->assertJsonPath('type', 'registry:block');
    }
}
