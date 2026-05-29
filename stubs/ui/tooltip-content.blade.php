@props([
    'side' => 'top',
    'align' => 'center',
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
        role="tooltip"
        data-slot="tooltip-content"
        data-side="{{ $side }}"
        :data-state="open ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->twMerge('bg-primary text-primary-foreground fixed z-50 w-fit rounded-md px-3 py-1.5 text-xs text-balance') }}
    >
        {{ $slot }}
        <span class="bg-primary fill-primary absolute left-1/2 -bottom-1 size-2.5 -translate-x-1/2 rotate-45 rounded-[2px]"></span>
    </div>
</template>
