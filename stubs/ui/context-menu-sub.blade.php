<div
    data-slot="context-menu-sub"
    x-data="{ subOpen: false }"
    @mouseenter="subOpen = true"
    @mouseleave="subOpen = false"
    {{ $attributes->twMerge('relative') }}
>
    {{ $slot }}
</div>
