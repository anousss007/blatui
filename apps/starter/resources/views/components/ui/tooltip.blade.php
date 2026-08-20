@props(['delay' => 0])

<div
    data-slot="tooltip"
    x-data="{ open: false, t: null,
        show() { clearTimeout(this.t); this.t = setTimeout(() => this.open = true, @js($delay)); },
        hide() { clearTimeout(this.t); this.open = false; } }"
    x-id="['blat-tooltip']"
    @mouseenter="show()"
    @mouseleave="hide()"
    @focusin="$event.target.matches(':focus-visible') && show()"
    @focusout="hide()"
    @keydown.escape="hide()"
    {{ $attributes->twMerge('relative inline-block') }}
>
    {{ $slot }}
</div>
