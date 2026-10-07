<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

/**
 * Registry components must keep rendering the same HTML when an app compiles
 * components/ui with livewire/blaze (#38). Each check below is a pattern that
 * rendered fine under Blade and broke under Blaze.
 */
class RegistryBlazeTest extends TestCase
{
    /** @return array<string, string> file name => source, Blade comments stripped */
    private function sources(): array
    {
        $out = [];
        foreach (glob(resource_path('views/components/ui/*.blade.php')) as $path) {
            $out[basename($path)] = preg_replace('/\{\{--.*?--\}\}/s', '', file_get_contents($path));
        }

        return $out;
    }

    public function test_components_do_not_escape_bound_attributes_with_a_double_colon(): void
    {
        // Blaze forwards `::class` to a class-based component (<x-lucide-*>) as the
        // literal `::class`, which Alpine ignores. `x-bind:class` means the same in both.
        $offenders = [];
        foreach ($this->sources() as $file => $source) {
            if (preg_match_all('/\s::[a-zA-Z][\w.-]*=/', $source, $m)) {
                $offenders[] = $file.': '.implode(', ', array_unique($m[0]));
            }
        }

        $this->assertSame([], $offenders, 'Use x-bind:attr instead of ::attr.');
    }

    public function test_components_do_not_include_each_other_as_views(): void
    {
        // A file Blaze compiled defines a function and renders nothing through
        // @include or view(), so a recursive partial in ui/ came out empty.
        $offenders = [];
        foreach ($this->sources() as $file => $source) {
            if (preg_match("/(@include\w*|view)\(\s*['\"]components\.ui\./", $source)) {
                $offenders[] = $file;
            }
        }

        $this->assertSame([], $offenders, 'Render another ui component with its <x-ui.*> tag.');
    }

    public function test_php_comments_do_not_name_blade_control_structures(): void
    {
        // Once Blaze inlines a component into a Livewire view, Livewire's morph-aware
        // compiler sees a directive written in a PHP comment (`real @foreach`) and
        // fails with "Malformed @foreach statement".
        $directive = '/@(?:if|elseif|else|endif|unless|isset|empty|foreach|forelse|for|while|switch)\b/';
        $offenders = [];
        foreach ($this->sources() as $file => $source) {
            preg_match_all('/@props\s*\(.*?\n\]\)|@php\b.*?@endphp/s', $source, $blocks);
            foreach ($blocks[0] as $block) {
                preg_match_all('#//[^\n]*|/\*.*?\*/#s', $block, $comments);
                foreach ($comments[0] as $comment) {
                    if (preg_match($directive, $comment)) {
                        $offenders[] = $file.': '.trim($comment);
                    }
                }
            }
        }

        $this->assertSame([], $offenders, 'Name the directive without the @ in a PHP comment.');
    }

    public function test_recursive_trees_render_every_level(): void
    {
        $chart = Blade::render('<x-ui.org-chart :root="$tree" />', ['tree' => [
            'name' => 'Root',
            'children' => [['name' => 'Child', 'children' => [['name' => 'Grandchild']]]],
        ]]);
        $this->assertStringContainsString('Grandchild', $chart);
        $this->assertSame(3, substr_count($chart, '<li>'));

        $json = Blade::render('<x-ui.json-viewer :data="$data" />', ['data' => ['a' => ['b' => ['deep' => 1]]]]);
        $this->assertStringContainsString('"deep"', $json);
        $this->assertSame(3, substr_count($json, 'data-slot="json-viewer-node"'));
    }
}
