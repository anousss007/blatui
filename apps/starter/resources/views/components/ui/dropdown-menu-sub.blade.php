<div
    data-slot="dropdown-menu-sub"
    x-data="blatMenu()"
    x-id="['blat-submenu', 'blat-submenu-trigger']"
    @mouseenter="open = true"
    @mouseleave="closeMenu(false)"
    {{ $attributes->twMerge('relative') }}
>
    {{ $slot }}
</div>
