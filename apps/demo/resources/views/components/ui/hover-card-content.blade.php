@props([
    'align' => 'center',
    'side' => 'bottom',
    'sideOffset' => 4,
])

@php
    $placement = $side.($align === 'center' ? '' : '-'.$align);
    $anchorAttr = 'x-anchor.'.$placement.'.offset.'.$sideOffset.'="$refs.trigger"';
@endphp

<template x-teleport="body">
    <div
        x-show="open"
        x-cloak
        {!! $anchorAttr !!}
        @mouseenter="show()"
        @mouseleave="hide()"
        data-slot="hover-card-content"
        data-side="{{ $side }}"
        :data-state="open ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->twMerge('bg-popover text-popover-foreground fixed z-50 w-64 origin-top rounded-md border p-4 shadow-md outline-hidden') }}
    >
        {{ $slot }}
    </div>
</template>
