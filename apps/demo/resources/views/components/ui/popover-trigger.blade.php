<span
    x-ref="trigger"
    @click="open = !open"
    :data-state="open ? 'open' : 'closed'"
    :aria-expanded="open"
    data-slot="popover-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
