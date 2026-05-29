@props([
    'align' => 'start',
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
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-trap="open"
        role="listbox"
        data-slot="select-content"
        :data-state="open ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->twMerge('bg-popover text-popover-foreground fixed z-50 max-h-96 min-w-[8rem] origin-top overflow-x-hidden overflow-y-auto rounded-md border shadow-md') }}
    >
        <div data-slot="select-viewport" class="p-1">
            {{ $slot }}
        </div>
    </div>
</template>
