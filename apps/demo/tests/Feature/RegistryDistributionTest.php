<?php

namespace Tests\Feature;

use App\Support\RegistryDistribution;
use Tests\TestCase;

class RegistryDistributionTest extends TestCase
{
    public function test_registry_index_lists_components_blocks_and_charts(): void
    {
        $res = $this->get('/registry.json');

        $res->assertOk();
        $res->assertHeader('access-control-allow-origin', '*');
        $res->assertJsonPath('name', 'blatui');
        $res->assertJsonPath('$schema', 'https://ui.shadcn.com/schema/registry.json');

        $names = collect($res->json('items'))->pluck('name');
        $this->assertContains('button', $names);
        $this->assertGreaterThan(100, $names->count(), 'index should span components + blocks + charts');
    }

    public function test_component_item_inlines_file_contents_with_target(): void
    {
        $res = $this->get('/r/button.json');

        $res->assertOk();
        $res->assertJsonPath('$schema', 'https://ui.shadcn.com/schema/registry-item.json');
        $res->assertJsonPath('name', 'button');

        $file = $res->json('files.0');
        $this->assertSame('resources/views/components/ui/button.blade.php', $file['target']);
        $this->assertNotEmpty($file['content']);
        $this->assertStringContainsString('x-ui', $res->json('files.0.content').'<x-ui', 'sanity: content present');
    }

    public function test_component_item_carries_registry_and_package_dependencies(): void
    {
        // accordion depends on @alpinejs/collapse (npm) per the manifest.
        $res = $this->get('/r/accordion.json');

        $res->assertOk();
        $this->assertContains('@alpinejs/collapse', $res->json('dependencies'));
        $this->assertNotEmpty($res->json('meta.artisan'));
    }

    public function test_block_and_chart_items_resolve_with_component_dependencies(): void
    {
        $dist = app(RegistryDistribution::class);

        $block = $dist->blockNames()[0];
        $res = $this->get("/r/blocks/{$block}.json");
        $res->assertOk();
        $res->assertJsonPath('type', 'registry:block');
        $this->assertNotEmpty($res->json('files.0.content'));

        // registryDependencies must be ABSOLUTE registry URLs so the official
        // shadcn CLI resolves them against us, not ui.shadcn.com.
        foreach ($res->json('registryDependencies') ?? [] as $dep) {
            $this->assertMatchesRegularExpression('#^https?://.+/r/[a-z0-9-]+\.json$#', $dep);
        }

        $chart = $dist->chartNames()[0];
        $res = $this->get("/r/charts/{$chart}.json");
        $res->assertOk();
        $this->assertNotEmpty($res->json('files.0.content'));
    }

    public function test_block_components_are_installable_and_wired_as_block_dependencies(): void
    {
        // The <x-block.*> components a block composes must be installable items…
        $res = $this->get('/r/nav-user.json');
        $res->assertOk();
        $res->assertJsonPath('name', 'nav-user');
        $this->assertSame(
            'resources/views/components/block/nav-user.blade.php',
            $res->json('files.0.target'),
            'block components install to components/block, so <x-block.nav-user> resolves'
        );
        $this->assertNotEmpty($res->json('files.0.content'));

        // …and a block that uses them must LIST them in registryDependencies (regression
        // guard for #10: the dep scanner previously matched <x-ui.*> only, dropping <x-block.*>).
        $res = $this->get('/r/blocks/sidebar-07.json');
        $res->assertOk();
        $deps = collect($res->json('registryDependencies') ?? [])
            ->map(fn ($u) => basename($u, '.json'))->all();
        foreach (['nav-main', 'nav-projects', 'nav-user', 'team-switcher'] as $blockComponent) {
            $this->assertContains($blockComponent, $deps, "sidebar-07 must declare its {$blockComponent} dependency");
        }
    }

    public function test_unknown_item_is_404(): void
    {
        $this->get('/r/does-not-exist.json')->assertNotFound();
        $this->get('/r/blocks/nope.json')->assertNotFound();
    }

    public function test_llms_txt_is_served_as_markdown(): void
    {
        $res = $this->get('/llms.txt');

        $res->assertOk();
        $res->assertHeader('content-type', 'text/markdown; charset=utf-8');
        $this->assertStringContainsString('# BlatUI', $res->getContent());
        $this->assertStringContainsString('php artisan blatui:add button', $res->getContent());
    }

    public function test_llms_full_txt_contains_component_reference(): void
    {
        $res = $this->get('/llms-full.txt');

        $res->assertOk();
        $this->assertStringContainsString('# Component reference', $res->getContent());
        $this->assertStringContainsString('Registry: ', $res->getContent());
    }
}
