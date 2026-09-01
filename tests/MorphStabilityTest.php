<?php

namespace BlatUI\Tests;

/**
 * Nothing a component generates per render may end up as an element's `id`.
 *
 * Livewire's morph keys an element by `wire:id`, then `wire:key`, then its plain `id`
 * (livewire.js, `key()`). An id that is re-rolled on every render therefore makes the old and
 * the new element read as DIFFERENT elements, and morphdom swaps the node instead of patching
 * it — on every single re-render, for as long as the component is on the page.
 *
 * What that costs is not cosmetic. Measured against a real Livewire runtime: file-upload's
 * <input> was replaced mid-upload, so the finish event Livewire dispatches on the node it
 * captured never reached the document and the bar sat at 100% for good (#27); mention-input and
 * rich-text-editor lost the text being typed into them; markdown-editor, segmented-control,
 * variant-selector and color-picker lost focus and caret.
 *
 * So the rule is a rule, not a preference, and it is worth a grep: an id is either the
 * consumer's (stable by construction) or Alpine's (`$id()`, which Livewire's morph carries
 * across a re-render on purpose — see `seedingMatchingId`). Never the server's.
 *
 * A generated NAME is fine and still here: `name` is not a morph key, and a radio group with no
 * form name of its own needs one that no other instance on the page shares.
 */
class MorphStabilityTest extends TestCase
{
    public function test_no_component_renders_an_id_it_generated_itself(): void
    {
        $offenders = [];

        foreach ($this->componentStubs() as $file) {
            $source = (string) file_get_contents($file);

            foreach ($this->generatedIdsRenderedAsIds($source) as $variable) {
                $offenders[] = basename($file).' → $'.$variable;
            }
        }

        $this->assertSame([], $offenders, 'a generated id is a fresh morph key on every render');
    }

    /**
     * The reported case, kept by name: the id was referenced by nothing, and cost every consumer
     * who did not pass one by hand an upload that never left "uploading". Issue #27.
     */
    public function test_the_upload_input_carries_no_id_it_generated_itself(): void
    {
        $stub = (string) file_get_contents(dirname(__DIR__).'/stubs/ui/file-upload.blade.php');

        $this->assertStringNotContainsString('Str::random', $stub);
        $this->assertStringContainsString(
            '@if ($id) id="{{ $id }}" @endif',
            $stub,
            'an id the consumer passes is stable, and still belongs on the input',
        );
    }

    /**
     * Variables holding a per-render random value — including the ones derived from them, since
     * `$uid.'-textarea'` is exactly as unstable as `$uid` — that reach an `id=` attribute.
     *
     * @return list<string>
     */
    private function generatedIdsRenderedAsIds(string $source): array
    {
        preg_match_all('/\$(\w+)\s*=\s*([^;]*Str::random[^;]*);/', $source, $seeds);
        $tainted = $seeds[1];

        // Transitive: anything built out of a tainted variable is tainted too.
        do {
            $before = $tainted;
            preg_match_all('/\$(\w+)\s*=\s*([^;]+);/', $source, $assignments, PREG_SET_ORDER);

            foreach ($assignments as [, $name, $expression]) {
                foreach ($tainted as $seed) {
                    if (preg_match('/\$'.$seed.'\b/', $expression) && ! in_array($name, $tainted, true)) {
                        $tainted[] = $name;
                    }
                }
            }
        } while ($tainted !== $before);

        return array_values(array_filter(
            $tainted,
            fn (string $name) => (bool) preg_match('/\bid\s*=\s*"[^"]*\$'.$name.'\b/', $source),
        ));
    }

    /** @return list<string> */
    private function componentStubs(): array
    {
        return array_merge(
            glob(dirname(__DIR__).'/stubs/ui/*.blade.php') ?: [],
            glob(dirname(__DIR__).'/stubs/block/*.blade.php') ?: [],
        );
    }
}
