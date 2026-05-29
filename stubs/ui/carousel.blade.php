@props(['orientation' => 'horizontal'])

<div
    data-slot="carousel"
    role="region"
    aria-roledescription="carousel"
    x-data="{
        index: 0,
        count: 0,
        orientation: @js($orientation),
        init() { this.count = this.$refs.track ? this.$refs.track.children.length : 0 },
        get canPrev() { return this.index > 0 },
        get canNext() { return this.index < this.count - 1 },
        prev() { if (this.canPrev) this.index-- },
        next() { if (this.canNext) this.index++ }
    }"
    @keydown.left.prevent="prev()"
    @keydown.right.prevent="next()"
    tabindex="0"
    {{ $attributes->twMerge('relative') }}
>
    {{ $slot }}
</div>
