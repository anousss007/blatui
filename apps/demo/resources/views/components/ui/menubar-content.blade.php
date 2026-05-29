@props([
    'align' => 'start',
    'side' => 'bottom',
    'sideOffset' => 8,
])

@php
    $placement = $side.($align === 'center' ? '' : '-'.$align);
    $anchorAttr = 'x-anchor.'.$placement.'.offset.'.$sideOffset.'="$refs.trigger"';
@endphp

<template x-teleport="body">
    <div
        x-show="active === id"
        x-cloak
        {!! $anchorAttr !!}
        @click.outside="if (active === id) active = null"
        @keydown.escape.window="active = null"
        x-trap="active === id"
        role="menu"
        data-slot="menubar-content"
        :data-state="active === id ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->twMerge('bg-popover text-popover-foreground fixed z-50 min-w-[12rem] origin-top-left overflow-hidden rounded-md border p-1 shadow-md') }}
    >
        {{ $slot }}
    </div>
</template>
