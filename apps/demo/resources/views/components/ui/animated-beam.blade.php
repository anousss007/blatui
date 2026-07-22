{{--
    Animated Beam — an SVG line/curve connecting two elements inside the component, with a
    light gradient that continuously travels along the path (think "sync" between two cards).

    @props
      from       CSS selector (queried WITHIN this component) for the start element
      to         CSS selector (queried WITHIN this component) for the end element
      curvature  vertical bow of the connecting path in px (0 = straight line; +/- bend it)
      duration   seconds for one full pass of the travelling light (default 3)

    Usage: put your two endpoint nodes (e.g. icon tiles) inside the slot and give each an id
    (or any selector), then pass those selectors as `from` / `to`. For a hub-and-spoke layout
    render several <x-ui.animated-beam> wrappers, or this component can also be stacked: the
    slot content is shared, so you can place a second instance pointing at the same nodes.

    Technique: Alpine measures the two elements' centres via getBoundingClientRect relative to
    the container on init + on resize (ResizeObserver + window resize), then writes the SVG
    path. A short gradient-painted dash is swept along that path via an animated stroke-dashoffset
    (a scoped keyframe), giving a travelling light without any per-frame JS.

    A11y: the SVG is purely decorative (aria-hidden), so screen readers only read the slot nodes.
    Reduced-motion: the travelling gradient is disabled (a static resting line remains).
    Tokens: the moving beam is a gradient built from the primary token; the resting path uses
    the border/muted tokens. RTL-safe: geometry is measured, not hard-coded to left/right.
--}}
@props([
    'from' => null,
    'to' => null,
    'curvature' => 0,
    'duration' => 3,
])

@once('blat-animated-beam')
    <style>
        /* Sweep a short dash from the start of the path to the end. The dash + gap pattern is
           sized off the measured path length (--blat-beam-len) so one dash crosses the whole
           line, then the offset animates it from -length back to 0. */
        @keyframes blat-animated-beam-sweep {
            from { stroke-dashoffset: var(--blat-beam-len, 0); }
            to   { stroke-dashoffset: 0; }
        }
        [data-slot="animated-beam"] .blat-animated-beam-flow {
            stroke-dasharray: var(--blat-beam-dash, 60) calc(var(--blat-beam-len, 1000) + var(--blat-beam-dash, 60));
            animation: blat-animated-beam-sweep var(--blat-beam-duration, 3s) linear infinite;
        }
        @media (prefers-reduced-motion: reduce) {
            [data-slot="animated-beam"] .blat-animated-beam-flow {
                animation: none;
                /* Hide the travelling dash entirely; the static resting path remains visible. */
                stroke-dasharray: 0 100000;
            }
        }
    </style>
@endonce

@php
    $beamDuration = (float) $duration . 's';
    $curve = (float) $curvature;
@endphp

<div
    data-slot="animated-beam"
    x-id="['blat-beam-grad']"
    x-data="{
        from: @js($from),
        to: @js($to),
        curvature: @js($curve),
        d: '',
        w: 0,
        h: 0,
        len: 0,
        ready: false,
        measure() {
            const root = this.$root;
            const fromEl = this.from ? root.querySelector(this.from) : null;
            const toEl = this.to ? root.querySelector(this.to) : null;
            const box = root.getBoundingClientRect();
            this.w = box.width;
            this.h = box.height;
            if (!fromEl || !toEl || !box.width || !box.height) { this.ready = false; return; }
            const a = fromEl.getBoundingClientRect();
            const b = toEl.getBoundingClientRect();
            const ax = a.left - box.left + a.width / 2;
            const ay = a.top - box.top + a.height / 2;
            const bx = b.left - box.left + b.width / 2;
            const by = b.top - box.top + b.height / 2;
            // Control point bowed perpendicular-ish: lift the midpoint by `curvature` px.
            const mx = (ax + bx) / 2;
            const my = (ay + by) / 2 - this.curvature;
            this.d = `M ${ax} ${ay} Q ${mx} ${my} ${bx} ${by}`;
            this.ready = true;
            // Measure the real path length for the dash sweep (after the DOM updates d).
            this.$nextTick(() => {
                const p = this.$refs.flow;
                if (p && p.getTotalLength) {
                    try { this.len = p.getTotalLength(); } catch (e) { this.len = Math.hypot(bx - ax, by - ay); }
                } else {
                    this.len = Math.hypot(bx - ax, by - ay);
                }
            });
        },
        init() {
            this.$nextTick(() => this.measure());
            // Re-measure when the container resizes (layout shifts move the endpoints).
            if (window.ResizeObserver) {
                this._ro = new ResizeObserver(() => this.measure());
                this._ro.observe(this.$root);
            }
        },
        destroy() { if (this._ro) this._ro.disconnect(); },
    }"
    @resize.window="measure()"
    {{ $attributes->twMerge('relative w-full') }}
>
    {{-- Decorative connecting beam, drawn behind the slot content. --}}
    <svg
        aria-hidden="true"
        focusable="false"
        class="pointer-events-none absolute inset-0 h-full w-full overflow-visible"
        x-show="ready"
        x-cloak
        :viewBox="`0 0 ${w} ${h}`"
        preserveAspectRatio="none"
        fill="none"
        :style="`--blat-beam-duration: {{ $beamDuration }}; --blat-beam-len: ${len}; --blat-beam-dash: ${Math.max(24, len * 0.18)};`"
    >
        <defs>
            {{-- Soft beam paint for the travelling dash: a primary glow that fades at both ends. --}}
            <linearGradient :id="$id('blat-beam-grad')" gradientUnits="userSpaceOnUse" x1="0" y1="0" :x2="w" y2="0">
                <stop offset="0%" stop-color="var(--color-primary)" stop-opacity="0" />
                <stop offset="50%" stop-color="var(--color-primary)" stop-opacity="1" />
                <stop offset="100%" stop-color="var(--color-primary)" stop-opacity="0" />
            </linearGradient>
        </defs>

        {{-- Resting path: a faint static line so the connection reads even before/without motion. --}}
        <path
            :d="d"
            stroke="var(--color-border)"
            stroke-width="2"
            stroke-linecap="round"
            class="opacity-60"
        />

        {{-- Travelling light: a short gradient-painted dash swept along the path via dashoffset. --}}
        <path
            x-ref="flow"
            :d="d"
            :stroke="`url(#${$id('blat-beam-grad')})`"
            stroke-width="2"
            stroke-linecap="round"
            class="blat-animated-beam-flow"
        />
    </svg>

    {{-- Slot content (the endpoints) sits above the beam. --}}
    <div class="relative">{{ $slot }}</div>
</div>
