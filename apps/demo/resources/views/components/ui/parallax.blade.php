@props([
    'speed' => 0.3,   // depth factor: how far the content shifts relative to scroll.
                      //   0 = locked to the page (no parallax). Positive moves the
                      //   content opposite the scroll (it appears to lag, reading as
                      //   "further away"). Negative moves it with the scroll (faster /
                      //   "closer"). Typical range -1 .. 1.
    'axis' => 'y',    // 'y' (vertical, the usual) or 'x' (horizontal).
])

@php
    // The content translates as the wrapper crosses the viewport. We measure the
    // element's bounding rect against window scroll (see x-data below) and only
    // animate while it is in view, so off-screen wrappers cost nothing.
    $speed = (float) $speed;
    $axis = $axis === 'x' ? 'x' : 'y';

    // Maximum travel in px at the extremes of the in-view range. Kept modest so the
    // effect reads as depth, not as content flying off. The applied amount scales
    // with `speed`, so the prop alone controls intensity and direction.
    $range = 80;
@endphp

<div
    data-slot="parallax"
    x-data="{
        speed: @js($speed),
        axis: @js($axis),
        range: @js($range),
        offset: 0,
        reduced: false,
        ticking: false,
        onScroll: null,
        onResize: null,
        init() {
            const mq = window.matchMedia('(prefers-reduced-motion: reduce)');
            this.reduced = mq.matches;
            mq.addEventListener?.('change', (e) => {
                this.reduced = e.matches;
                if (this.reduced) this.offset = 0;
                else this.measure();
            });

            if (this.reduced || this.speed === 0) return;

            // Passive listeners + rAF coalescing keep scroll smooth. We recompute the
            // element's position each frame so it stays correct through resizes,
            // sticky headers, zoom, and content reflow.
            this.onScroll = () => {
                if (this.ticking) return;
                this.ticking = true;
                requestAnimationFrame(() => {
                    this.measure();
                    this.ticking = false;
                });
            };
            this.onResize = this.onScroll;
            window.addEventListener('scroll', this.onScroll, { passive: true });
            window.addEventListener('resize', this.onResize, { passive: true });
            this.measure();
        },
        measure() {
            if (this.reduced || this.speed === 0) { this.offset = 0; return; }
            const r = this.$el.getBoundingClientRect();
            const vh = window.innerHeight || document.documentElement.clientHeight;
            // progress: -1 when the element sits just below the viewport, 0 at the
            // vertical centre, +1 when just above. Clamped so nothing animates while
            // the wrapper is fully out of view.
            const center = r.top + r.height / 2;
            const denom = vh / 2 + r.height / 2;
            let progress = denom > 0 ? (center - vh / 2) / denom : 0;
            progress = Math.max(-1, Math.min(1, progress));
            this.offset = progress * this.speed * this.range;
        },
        get style() {
            if (this.reduced || this.speed === 0) return 'transform: none;';
            const v = this.offset.toFixed(2);
            return this.axis === 'x'
                ? `transform: translate3d(${v}px, 0, 0); will-change: transform;`
                : `transform: translate3d(0, ${v}px, 0); will-change: transform;`;
        },
        destroy() {
            if (this.onScroll) window.removeEventListener('scroll', this.onScroll);
            if (this.onResize) window.removeEventListener('resize', this.onResize);
        },
    }"
    {{ $attributes->twMerge('block') }}
>
    {{-- Content stays in normal flow and fully readable; only a decorative transform
         is applied. Under prefers-reduced-motion the style getter returns no transform. --}}
    <div :style="style" class="motion-reduce:!transform-none">
        {{ $slot }}
    </div>
</div>
