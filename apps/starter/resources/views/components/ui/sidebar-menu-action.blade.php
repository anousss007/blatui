@props(['showOnHover' => false])

<button
    type="button"
    data-slot="sidebar-menu-action"
    data-sidebar="menu-action"
    {{ $attributes->twMerge('text-sidebar-foreground ring-sidebar-ring hover:bg-sidebar-accent hover:text-sidebar-accent-foreground peer-hover/menu-button:text-sidebar-accent-foreground absolute top-1.5 right-1 flex aspect-square w-5 items-center justify-center rounded-md p-0 outline-none transition-transform focus-visible:ring-2 group-data-[collapsible=icon]:hidden [&>svg]:size-4 [&>svg]:shrink-0 '.($showOnHover ? 'md:opacity-0 group-focus-within/menu-item:opacity-100 group-hover/menu-item:opacity-100 data-[state=open]:opacity-100' : '')) }}
>
    {{ $slot }}
</button>
