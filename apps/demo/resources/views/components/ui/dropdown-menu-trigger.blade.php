<span
    x-ref="trigger"
    @click="open = !open"
    :data-state="open ? 'open' : 'closed'"
    :aria-expanded="open"
    aria-haspopup="menu"
    data-slot="dropdown-menu-trigger"
    {{ $attributes->twMerge('contents') }}
>
    {{ $slot }}
</span>
