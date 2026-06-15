@props([
    'label' => 'Add to cart',
    'addedLabel' => 'Added',
    'size' => 'default',
    'icon' => 'shopping-cart',  // any lucide icon name for the idle state
])

@php
    // Mirrors button.blade.php so sizing/spacing/focus behave identically.
    $base = "inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-90 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]";

    $sizes = [
        'default' => 'h-9 px-4 py-2 has-[>svg]:px-3',
        'sm' => 'h-8 rounded-md gap-1.5 px-3 has-[>svg]:px-2.5',
        'lg' => 'h-10 rounded-md px-6 has-[>svg]:px-4',
        'icon' => 'size-9',
        'icon-sm' => 'size-8',
        'icon-lg' => 'size-10',
    ];

    $classes = $base.' '.($sizes[$size] ?? $sizes['default']);

    // Text spoken by the live region. When `label` is hidden (icon-only, `:label="false"`)
    // we fall back to a sensible default so the announcement is never empty/"false".
    $busyText = $label !== false ? $label : 'Add to cart';
@endphp

{{--
    Stateful add-to-cart button: idle → adding → added → idle.
    The timed state machine here is a DEMO of the pattern — a real app replaces the
    setTimeout in `add()` with its request (e.g. fetch / Livewire / wire:click) and
    calls `done()` (success) or `reset()` (failure) when it resolves.
--}}
<button
    type="button"
    data-slot="add-to-cart"
    x-data="{
        state: 'idle',
        announce: '',
        _t: [],
        add() {
            if (this.state !== 'idle') return;
            this.state = 'adding';
            this.announce = @js($busyText) + '…';
            // DEMO: pretend a request is in flight, then succeed.
            this._t.push(setTimeout(() => this.done(), 900));
        },
        done() {
            this.state = 'added';
            this.announce = @js($addedLabel);
            this._t.push(setTimeout(() => this.reset(), 1600));
        },
        reset() {
            this.state = 'idle';
            this.announce = '';
        },
        destroy() { this._t.forEach(clearTimeout); },
    }"
    @click="add()"
    :disabled="state !== 'idle'"
    :aria-busy="state === 'adding'"
    :class="state === 'added'
        ? 'bg-emerald-600 text-white shadow-xs hover:bg-emerald-600'
        : 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90 cursor-pointer'"
    {{ $attributes->twMerge($classes) }}
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
</button>
