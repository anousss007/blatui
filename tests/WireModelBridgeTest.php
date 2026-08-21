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

    /** @return list<string> */
    private function componentStubs(): array
    {
        return array_merge(
            glob(dirname(__DIR__).'/stubs/ui/*.blade.php') ?: [],
            glob(dirname(__DIR__).'/stubs/block/*.blade.php') ?: [],
        );
    }
}
