<div
    data-slot="dropdown-menu-sub"
    x-data="blatMenu()"
    x-id="['blat-submenu', 'blat-submenu-trigger']"
    @mouseenter="open = true; cancelClose()"
    @mouseleave="closeSoon()"
    {{ $attributes->twMerge('relative') }}
>
    {{ $slot }}
</div>
