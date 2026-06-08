<div
    data-slot="context-menu-sub"
    x-data="blatMenu()"
    x-id="['blat-ctx-submenu', 'blat-ctx-submenu-trigger']"
    @mouseenter="open = true"
    @mouseleave="closeMenu(false)"
    {{ $attributes->twMerge('relative') }}
>
    {{ $slot }}
</div>
