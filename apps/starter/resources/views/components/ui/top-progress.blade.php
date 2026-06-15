{{--
    Top Progress — an NProgress-style thin loading bar fixed at the top of the page.
      color   bar color; defaults to the primary token (e.g. "#6366f1" or "var(--color-ring)")
      height  bar thickness in px (default 2)
      demo    when true, render the bar in-flow (relative, not fixed) for docs previews

    Alpine API (on this element's own x-data scope):
      start()   show the bar and begin trickling its width toward ~90%
      set(p)    set the width to a fraction p (0..1)
      done()    jump to 100%, then fade out and reset

    Real apps drive it with window events (the component listens for these):
      window.dispatchEvent(new CustomEvent('top-progress:start'))
      window.dispatchEvent(new CustomEvent('top-progress:set', { detail: { value: 0.5 } }))
      window.dispatchEvent(new CustomEvent('top-progress:done'))
    Hook these into your navigation lifecycle (Livewire, Inertia, Turbo, fetch interceptors…).
    From inside Alpine you can also reach the scope via Alpine.$data($refs.bar).start().
--}}
@props([
    'color' => null,
    'height' => 2,
    'demo' => false,
])

@php
    $barColor = $color ?: 'var(--color-primary)';
    $barHeight = (int) $height . 'px';
@endphp

@once('blat-top-progress')
    <style>
        @media (prefers-reduced-motion: reduce) {
            [data-slot="top-progress"] .blat-top-progress-bar {
                transition: none !important;
            }
        }
    </style>
@endonce

<div
    data-slot="top-progress"
    x-data="{
        progress: 0,
        active: false,
        visible: false,
        timer: null,
        clamp(v) { return Math.max(0, Math.min(1, v)); },
        start() {
            if (this.active) return;
            this.active = true;
            this.visible = true;
            this.progress = 0.08;
            this.trickle();
            this.timer = setInterval(() => this.trickle(), 400);
        },
        trickle() {
            if (!this.active) return;
            if (this.progress >= 0.9) return;
            // ease the increment down as we approach the cap
            const remaining = 0.9 - this.progress;
            this.set(this.clamp(this.progress + remaining * (0.1 + Math.random() * 0.15)));
        },
        set(p) {
            this.progress = this.clamp(p);
            this.visible = true;
        },
        done() {
            if (this.timer) { clearInterval(this.timer); this.timer = null; }
            this.active = false;
            this.set(1);
            setTimeout(() => {
                this.visible = false;
                setTimeout(() => { if (!this.active) this.progress = 0; }, 300);
            }, 250);
        },
    }"
    x-on:top-progress:start.window="start()"
    x-on:top-progress:set.window="set($event.detail?.value ?? 0)"
    x-on:top-progress:done.window="done()"
    @if (! $demo) x-cloak @endif
    {{ $attributes->twMerge($demo ? 'relative block w-full overflow-hidden' : 'pointer-events-none fixed inset-x-0 top-0 z-[60] overflow-hidden') }}
    style="height: {{ $barHeight }};"
>
    <div
        class="blat-top-progress-bar absolute inset-y-0 start-0 origin-left rounded-e-full transition-[width,opacity] duration-200 ease-out"
        role="progressbar"
        aria-label="Page loading"
        aria-valuemin="0"
        aria-valuemax="100"
        x-bind:aria-valuenow="active ? Math.round(progress * 100) : null"
        x-bind:style="`width: ${progress * 100}%; opacity: ${visible ? 1 : 0}; background: {{ $barColor }};`"
    >
        {{-- decorative leading glow at the bar's edge --}}
        <span
            aria-hidden="true"
            class="pointer-events-none absolute inset-y-0 end-0 w-16 blur-[2px]"
            style="background: linear-gradient(90deg, transparent, {{ $barColor }}); box-shadow: 0 0 10px {{ $barColor }}, 0 0 5px {{ $barColor }};"
        ></span>
    </div>
</div>
