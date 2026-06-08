<?php

namespace BlatUI\Tests;

class BoostIntegrationTest extends TestCase
{
    private function pkgPath(string $rel): string
    {
        return dirname(__DIR__).'/'.$rel;
    }

    public function test_ships_a_boost_guideline(): void
    {
        $path = $this->pkgPath('resources/boost/guidelines/core.blade.php');
        $this->assertFileExists($path, 'Boost auto-discovers resources/boost/guidelines/core.blade.php');

        $body = (string) file_get_contents($path);
        $this->assertStringContainsString('## BlatUI', $body);
        $this->assertStringContainsString('php artisan blatui:add', $body);
        $this->assertStringContainsString('x-ui.', $body);
        // Code snippets must use Boost's @verbatim + <code-snippet> wrapper.
        $this->assertStringContainsString('@verbatim', $body);
        $this->assertStringContainsString('<code-snippet', $body);
    }

    public function test_ships_a_boost_skill_with_required_frontmatter(): void
    {
        $path = $this->pkgPath('resources/boost/skills/blatui-development/SKILL.md');
        $this->assertFileExists($path, 'Boost auto-discovers resources/boost/skills/{name}/SKILL.md');

        $body = (string) file_get_contents($path);
        // Agent Skills format: YAML frontmatter with name + description.
        $this->assertMatchesRegularExpression('/\A---\s*\nname:\s*blatui-development\s*\n/', $body);
        $this->assertStringContainsString('description:', $body);
        $this->assertStringContainsString('php artisan blatui:add', $body);
    }
}
