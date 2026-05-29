<div
    x-show="active === id"
    x-cloak
    x-anchor.bottom-start.offset.8="$refs.trigger"
    @mouseenter="active = id"
    @click.outside="if (active === id) active = null"
    @keydown.escape.window="active = null"
    data-slot="navigation-menu-content"
    :data-state="active === id ? 'open' : 'closed'"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    {{ $attributes->twMerge('bg-popover text-popover-foreground z-50 origin-top overflow-hidden rounded-md border p-2 shadow-md') }}
>
    {{ $slot }}
</div>
