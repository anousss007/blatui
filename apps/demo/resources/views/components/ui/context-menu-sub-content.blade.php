<div
    x-show="subOpen"
    x-cloak
    x-anchor.right-start.offset.4="$refs.subtrigger"
    role="menu"
    data-slot="context-menu-sub-content"
    :data-state="subOpen ? 'open' : 'closed'"
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    {{ $attributes->twMerge('bg-popover text-popover-foreground z-50 min-w-[8rem] origin-top-left overflow-hidden rounded-md border p-1 shadow-lg') }}
>
    {{ $slot }}
</div>
