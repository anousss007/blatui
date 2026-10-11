@php
    // Collapsed to the icon rail the list is hidden; blatSidebarFlyout (blatui-core.js) shows it
    // as a flyout beside the item's button instead, and these classes are what it looks like
    // there. Every one is gated on the rail AND the open flyout, so the inline list in the
    // expanded sidebar is untouched. Spelled out in full rather than built from a prefix:
    // Tailwind only generates a class it can read whole in the source.
    $flyout = implode(' ', [
        'group-data-[collapsible=icon]:data-[flyout=open]:flex!',
        'group-data-[collapsible=icon]:data-[flyout=open]:fixed',
        'group-data-[collapsible=icon]:data-[flyout=open]:z-50',
        'group-data-[collapsible=icon]:data-[flyout=open]:m-0',
        'group-data-[collapsible=icon]:data-[flyout=open]:min-w-44',
        'group-data-[collapsible=icon]:data-[flyout=open]:max-w-64',
        'group-data-[collapsible=icon]:data-[flyout=open]:translate-x-0',
        'group-data-[collapsible=icon]:data-[flyout=open]:border',
        'group-data-[collapsible=icon]:data-[flyout=open]:border-sidebar-border',
        'group-data-[collapsible=icon]:data-[flyout=open]:bg-sidebar',
        'group-data-[collapsible=icon]:data-[flyout=open]:text-sidebar-foreground',
        'group-data-[collapsible=icon]:data-[flyout=open]:rounded-md',
        'group-data-[collapsible=icon]:data-[flyout=open]:p-1',
        'group-data-[collapsible=icon]:data-[flyout=open]:shadow-md',
    ]);
@endphp

<ul
    data-slot="sidebar-menu-sub"
    data-sidebar="menu-sub"
    x-data="blatSidebarFlyout"
    :data-flyout="flyout ? 'open' : null"
    {{ $attributes->twMerge('border-sidebar-border mx-3.5 flex min-w-0 translate-x-px flex-col gap-1 border-s px-2.5 py-0.5 group-data-[collapsible=icon]:hidden '.$flyout) }}
>
    {{ $slot }}
</ul>
