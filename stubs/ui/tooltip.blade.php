@props(['delay' => 0])

<div
    data-slot="tooltip"
    x-data="{ open: false, t: null,
        show() { clearTimeout(this.t); this.t = setTimeout(() => this.open = true, @js($delay)); },
        hide() { clearTimeout(this.t); this.open = false; } }"
    @mouseenter="show()"
    @mouseleave="hide()"
    {{ $attributes->twMerge('relative inline-block') }}
>
    {{ $slot }}
</div>
