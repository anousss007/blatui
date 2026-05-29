@props([
    'align' => 'start',
    'side' => 'bottom',
    'sideOffset' => 4,
])

@php
    $placement = $side.($align === 'center' ? '' : '-'.$align);
    // Anchor to the inner sidebar menu-action button when present (it is absolutely
    // positioned at the item's top-right), otherwise to the trigger element itself.
    // The trigger span is display:contents (no box), so anchor to its real inner
    // element: the sidebar menu-action button when present, else the first child.
    $anchorRef = '($refs.trigger?.querySelector(\'[data-slot=sidebar-menu-action]\') || $refs.trigger?.firstElementChild || $refs.trigger)';
    $anchorAttr = 'x-anchor.'.$placement.'.offset.'.$sideOffset.'="'.$anchorRef.'"';
@endphp

<template x-teleport="body">
    <div
        x-show="open"
        x-cloak
        {!! $anchorAttr !!}
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-trap="open"
        role="menu"
        data-slot="dropdown-menu-content"
        data-side="{{ $side }}"
        :data-state="open ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->twMerge('bg-popover text-popover-foreground fixed z-50 max-h-96 min-w-[8rem] origin-top overflow-x-hidden overflow-y-auto rounded-md border p-1 shadow-md') }}
    >
        {{ $slot }}
    </div>
</template>
