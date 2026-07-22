@props([
    'threshold' => 300,   // px scrolled before the button appears
    'variant' => 'primary', // 'primary' (filled) | 'subtle' (card + border)
    'demo' => false,      // docs-only: always visible & in-flow (preview frame doesn't scroll the window)
])

@php
    $variants = [
        'primary' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'subtle' => 'bg-card text-foreground border hover:bg-accent hover:text-accent-foreground',
    ];
    $variantClasses = $variants[$variant] ?? $variants['primary'];

    // In docs (`demo`), pin it static & in-flow so it renders inside the non-scrolling preview frame.
    // In real use it floats fixed at the bottom-end corner (end-* is RTL-safe).
    $position = $demo ? 'static' : 'fixed bottom-6 end-6 z-40';
@endphp

{{-- A floating "scroll to top" button. It listens to the window scroll position and
     reveals itself once the user has scrolled past `threshold` px, then smoothly
     scrolls back to the top on click (instantly under prefers-reduced-motion). --}}
<button
    data-slot="back-to-top"
    type="button"
    aria-label="Back to top"
    x-data="{
        shown: @js((bool) $demo),
        demo: @js((bool) $demo),
        threshold: @js((int) $threshold),
        reduced: false,
        init() {
            if (this.demo) return;
            this.reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            this.onScroll();
        },
        onScroll() {
            if (this.demo) return;
            this.shown = window.scrollY > this.threshold;
        },
        toTop() {
            window.scrollTo({ top: 0, behavior: this.reduced ? 'auto' : 'smooth' });
        },
    }"
    @scroll.window.passive="onScroll()"
    @resize.window.passive="onScroll()"
    x-show="shown"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    @click="toTop()"
    {{ $attributes->twMerge($position.' inline-flex size-11 shrink-0 cursor-pointer items-center justify-center rounded-full shadow-lg transition-colors outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px] '.$variantClasses) }}
>
    <x-lucide-arrow-up class="size-5" aria-hidden="true" />
</button>
