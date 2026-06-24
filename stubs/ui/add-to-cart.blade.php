@props([
    'label' => 'Add to cart',
    'addedLabel' => 'Added',
    'size' => 'default',
    'icon' => 'shopping-cart',  // any lucide icon name for the idle state
])

@php
    // Text spoken by the live region. When `label` is hidden (icon-only, `:label="false"`)
    // we fall back to a sensible default so the announcement is never empty/"false".
    $busyText = $label !== false ? $label : 'Add to cart';
    // Pre-encode for the Alpine `x-data` literal — `@js()` does not compile inside a
    // component attribute, so we JSON-encode here and interpolate with `{{ }}` instead.
    $busyJs = \Illuminate\Support\Js::from($busyText);
    $addedJs = \Illuminate\Support\Js::from($addedLabel);
@endphp

{{--
    Stateful add-to-cart button: idle → adding → added → idle.
    The timed state machine here is a DEMO of the pattern — a real app replaces the
    setTimeout in `add()` with its request (e.g. fetch / Livewire / wire:click) and
    calls `done()` (success) or `reset()` (failure) when it resolves.

    Composes <x-ui.button> for sizing/spacing/focus; the success state recolors via the
    button's `color` token override, driven through a CSS var so it can toggle reactively.

    The `data-slot="add-to-cart"` lives on a `display:contents` wrapper because the composed
    button already emits its own `data-slot="button"`; the wrapper keeps the public selector
    `[data-slot="add-to-cart"]` working without altering layout.
--}}
<span class="contents" data-slot="add-to-cart">
<x-ui.button
    type="button"
    :size="$size"
    x-data="{
        state: 'idle',
        announce: '',
        _t: [],
        add() {
            if (this.state !== 'idle') return;
            this.state = 'adding';
            this.announce = {{ $busyJs }} + '…';
            // DEMO: pretend a request is in flight, then succeed.
            this._t.push(setTimeout(() => this.done(), 900));
        },
        done() {
            this.state = 'added';
            this.announce = {{ $addedJs }};
            this._t.push(setTimeout(() => this.reset(), 1600));
        },
        reset() {
            this.state = 'idle';
            this.announce = '';
        },
        destroy() { this._t.forEach(clearTimeout); },
    }"
    @click="add()"
    {{-- `x-bind:` (not `:`) so Blade doesn't read these as PHP prop bindings on <x-ui.button>. --}}
    x-bind:disabled="state !== 'idle'"
    x-bind:aria-busy="state === 'adding'"
    {{-- Recolor to the success token only in the `added` state (overrides button's --primary). --}}
    x-bind:style="state === 'added' ? '--primary: oklch(0.596 0.145 163.225); --primary-foreground: #ffffff;' : null"
    {{-- Stay near-opaque while disabled (adding/added) and show a pointer when actionable. --}}
    x-bind:class="state === 'idle' ? 'cursor-pointer' : ''"
    {{ $attributes->twMerge('disabled:opacity-90') }}
>
    {{-- Idle --}}
    <span x-show="state === 'idle'" class="contents">
        <x-dynamic-component :component="'lucide-'.$icon" aria-hidden="true" />
        @if (trim($slot) !== '' || $label !== false)
            <span>{{ trim($slot) !== '' ? $slot : $label }}</span>
        @endif
    </span>

    {{-- Adding --}}
    <span x-show="state === 'adding'" x-cloak class="contents">
        <x-lucide-loader-circle class="animate-spin" aria-hidden="true" />
        @if (trim($slot) !== '' || $label !== false)
            <span>{{ $label }}…</span>
        @endif
    </span>

    {{-- Added --}}
    <span x-show="state === 'added'" x-cloak class="contents">
        <x-lucide-check aria-hidden="true" />
        @if (trim($slot) !== '' || $label !== false)
            <span>{{ $addedLabel }}</span>
        @endif
    </span>

    {{-- Polite live region announces every transition to screen readers. --}}
    <span class="sr-only" aria-live="polite" x-text="announce"></span>
</x-ui.button>
</span>
