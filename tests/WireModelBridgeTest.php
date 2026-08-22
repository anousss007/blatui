<?php

namespace BlatUI\Tests;

/**
 * The wire:model bridge, as it is SHIPPED (stubs/, what blatui:add copies into an app).
 *
 * Behaviour lives in apps/livewire's morph suite, where a real Livewire runtime can prove it.
 * These are the invariants that only need the source: that no component has gone back to
 * `@entangle`, and that every one which binds a value ships the pieces the bridge needs.
 */
class WireModelBridgeTest extends TestCase
{
    /**
     * `@entangle` keeps a second copy of the value, bakes the component id into an x-data that
     * Alpine evaluates once, and never releases its sync when the element is removed — which is
     * why Livewire 4 deprecates it. Issue #22. One grep, so the next one fails here.
     */
    public function test_no_component_binds_through_the_deprecated_entangle_directive(): void
    {
        $offenders = [];

        foreach ($this->componentStubs() as $file) {
            if (str_contains((string) file_get_contents($file), '@entangle')) {
                $offenders[] = basename($file);
            }
        }

        $this->assertSame([], $offenders, 'components must bind through $blatModel, not @entangle');
    }

    /**
     * The path is what makes the binding re-derivable: it travels as an attribute the server
     * re-renders, so a morph that re-points the component is followed rather than missed. A
     * component that calls $blatModel without rendering the attribute is bound to nothing.
     */
    public function test_every_component_using_the_bridge_renders_the_property_path(): void
    {
        $offenders = [];

        foreach ($this->componentStubs() as $file) {
            $source = (string) file_get_contents($file);
            if (str_contains($source, '$blatModel(') && ! str_contains($source, 'data-blat-model')) {
                $offenders[] = basename($file);
            }
        }

        $this->assertSame([], $offenders, "\$blatModel needs the property path on the component's root");
    }

    /** The engine has to register the magics those components resolve at runtime. */
    public function test_the_published_engine_registers_the_bridge(): void
    {
        $engine = (string) file_get_contents(dirname(__DIR__).'/stubs/foundations/blatui-core.js');

        foreach (['blatModel', 'blatWire', 'blatNumber'] as $magic) {
            $this->assertStringContainsString("Alpine.magic('{$magic}'", $engine);
        }
    }

    /**
     * A stepper that adds its raw step drifts (1.1 + 0.1 eight times is 1.3666…), and under
     * wire:model that drift is written straight into the consumer's property. Issue #22.
     */
    public function test_the_steppers_round_through_the_shared_helper(): void
    {
        foreach (['number-input', 'slider', 'knob'] as $component) {
            $source = (string) file_get_contents(dirname(__DIR__)."/stubs/ui/{$component}.blade.php");

            $this->assertStringContainsString('$blatNumber', $source, "{$component} steps without rounding");
        }
    }

    /**
     * file-upload's progress bar was a setInterval animating to 100% in about a second,
     * unconnected to the upload it claimed to describe. Issue #23.
     */
    public function test_file_upload_reports_the_real_upload(): void
    {
        $source = (string) file_get_contents(dirname(__DIR__).'/stubs/ui/file-upload.blade.php');

        $this->assertStringNotContainsString('setInterval', $source, 'the progress bar is animated, not reported');
        $this->assertStringNotContainsString('Math.random', $source);
        $this->assertStringContainsString('x-on:livewire-upload-progress', $source);
        $this->assertStringContainsString('x-on:livewire-upload-error', $source);
    }

    /**
     * A component with more than one mode has to bind in all of them. `mode="range"` used to
     * render its from/to form fields and nothing else, so the one mode a Livewire date filter
     * wants could not reach a property at all (#24). The tell is a data attribute rendered only
     * on one branch: the binding is what that attribute turns on.
     */
    public function test_range_modes_render_the_binding_too(): void
    {
        foreach (['date-picker', 'datetime-picker', 'slider'] as $component) {
            $source = (string) file_get_contents(dirname(__DIR__)."/stubs/ui/{$component}.blade.php");

            $this->assertStringContainsString('data-blat-model', $source, "{$component} does not bind at all");
            $this->assertSame(
                1,
                substr_count($source, "'data-blat-model' =>"),
                "{$component} renders the binding on only some of its modes"
            );
        }
    }

    /**
     * A slider writes on every pointermove. Committing each one would make a `.live` slider fire
     * a request per frame of a drag, so the value moves throughout and the request waits for the
     * drag to end — which only works if the engine offers a write that does not commit.
     */
    public function test_the_engine_can_write_without_committing(): void
    {
        $engine = (string) file_get_contents(dirname(__DIR__).'/stubs/foundations/blatui-core.js');
        $slider = (string) file_get_contents(dirname(__DIR__).'/stubs/ui/slider.blade.php');

        $this->assertStringContainsString('write(next)', $engine);
        $this->assertStringContainsString('commit()', $engine);
        $this->assertStringContainsString('_model.write(', $slider);
        $this->assertStringContainsString('_model.commit()', $slider);
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
