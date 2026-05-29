@props(['openDelay' => 400, 'closeDelay' => 100])

<div
    data-slot="hover-card"
    x-data="{ open: false, t: null,
        show() { clearTimeout(this.t); this.t = setTimeout(() => this.open = true, @js($openDelay)); },
        hide() { clearTimeout(this.t); this.t = setTimeout(() => this.open = false, @js($closeDelay)); } }"
    @mouseenter="show()"
    @mouseleave="hide()"
    {{ $attributes->twMerge('relative inline-block') }}
>
    {{ $slot }}
</div>
