<div data-slot="sidebar-menu-badge" data-sidebar="menu-badge" {{ $attributes->twMerge('text-sidebar-foreground pointer-events-none absolute right-1 flex h-5 min-w-5 items-center justify-center rounded-md px-1 text-xs font-medium tabular-nums select-none peer-hover/menu-button:text-sidebar-accent-foreground peer-data-[active=true]/menu-button:text-sidebar-accent-foreground top-1.5 group-data-[collapsible=icon]:hidden') }}>
    {{ $slot }}
</div>
