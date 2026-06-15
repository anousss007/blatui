@props([
    'max' => 12,        // max tilt in degrees on each axis
    'scale' => 1.03,    // hover scale
    'glare' => false,   // pointer-following highlight overlay
])

@php
    // A perspective wrapper holds an inner card that rotates in 3D toward the cursor.
    // Server values pass through @js so the inline Alpine stays self-contained.
    $maxDeg = (float) $max;
    $hoverScale = (float) $scale;
@endphp

<div
    data-slot="tilt-card"
    x-data="{
        max: @js($maxDeg),
        scaleTo: @js($hoverScale),
        glare: @js((bool) $glare),
        rx: 0,
        ry: 0,
        gx: 50,
        gy: 50,
        active: false,
        reduced: false,
        init() {
            const mq = window.matchMedia('(prefers-reduced-motion: reduce)');
            this.reduced = mq.matches;
            mq.addEventListener?.('change', e => { this.reduced = e.matches; });
        },
        move(e) {
            if (this.reduced) return;
            const r = this.$refs.card.getBoundingClientRect();
            const px = (e.clientX - r.left) / r.width;   // 0..1
            const py = (e.clientY - r.top) / r.height;   // 0..1
            this.active = true;
            // Pointer at top tilts the top toward the viewer (negative rotateX); left tilts left.
            this.ry = (px - 0.5) * 2 * this.max;
            this.rx = -(py - 0.5) * 2 * this.max;
            this.gx = px * 100;
            this.gy = py * 100;
        },
        leave() {
            this.active = false;
            this.rx = 0;
            this.ry = 0;
            this.gx = 50;
            this.gy = 50;
        },
        get cardStyle() {
            const s = this.active && !this.reduced ? this.scaleTo : 1;
            return `transform: rotateX(${this.rx}deg) rotateY(${this.ry}deg) scale(${s});`;
        },
    }"
    {{ $attributes->twMerge('[perspective:1000px]') }}
>
    <div
        x-ref="card"
        @mousemove="move($event)"
        @mouseleave="leave()"
        :style="cardStyle"
        :class="active ? 'transition-none' : 'transition-transform duration-500 ease-out'"
        class="relative bg-card text-card-foreground overflow-hidden rounded-xl border shadow-sm [transform-style:preserve-3d] motion-reduce:!transform-none motion-reduce:transition-none"
    >
        {{ $slot }}

        @if ($glare)
            <div
                aria-hidden="true"
                x-show="active && !reduced"
                x-cloak
                class="pointer-events-none absolute inset-0 mix-blend-overlay motion-reduce:hidden"
                :style="`background: radial-gradient(circle at ${gx}% ${gy}%, rgba(255,255,255,0.45), rgba(255,255,255,0) 55%);`"
            ></div>
        @endif
    </div>
</div>
