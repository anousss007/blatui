{{--
    Carousel root — holds the active index and exposes prev/next.
      orientation  horizontal (default) | vertical. Vertical needs a height on
                   <x-ui.carousel-content> (e.g. class="h-[240px]").
      swipe        enable touch/pen swipe to change slides (default true; mouse uses the arrows).
--}}
@props(['orientation' => 'horizontal', 'swipe' => true])

<div
    data-slot="carousel"
    role="region"
    aria-roledescription="carousel"
    x-data="{
        index: 0,
        count: 0,
        orientation: @js($orientation),
        swipe: @js((bool) $swipe),
        drag: { active: false, start: 0 },
        init() { this.count = this.$refs.track ? this.$refs.track.children.length : 0 },
        get canPrev() { return this.index > 0 },
        get canNext() { return this.index < this.count - 1 },
        prev() { if (this.canPrev) this.index-- },
        next() { if (this.canNext) this.index++ },
        onPointerDown(e) {
            if (!this.swipe || e.pointerType === 'mouse') return;
            this.drag.active = true;
            this.drag.start = this.orientation === 'vertical' ? e.clientY : e.clientX;
        },
        onPointerUp(e) {
            if (!this.drag.active) return;
            this.drag.active = false;
            const end = this.orientation === 'vertical' ? e.clientY : e.clientX;
            const d = end - this.drag.start;
            const threshold = 40;
            if (d <= -threshold) this.next();
            else if (d >= threshold) this.prev();
        }
    }"
    @keydown.left.prevent="prev()"
    @keydown.right.prevent="next()"
    tabindex="0"
    {{ $attributes->twMerge('relative') }}
>
    {{ $slot }}
</div>
