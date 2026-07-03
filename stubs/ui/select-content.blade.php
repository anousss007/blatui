@props([
    'align' => 'start',
    'side' => 'bottom',
    'sideOffset' => 4,
    'indicator' => 'check',   // check | checkbox | radio — cascades to child select-item options
])

@php
    $placement = $side.($align === 'center' ? '' : '-'.$align);
    $anchorAttr = 'x-blat-anchor.'.$placement.'.offset.'.$sideOffset.'="$refs.trigger"';
@endphp

<template x-teleport="body" wire:ignore>
    <div
        x-blat-dialog-layer
        x-show="open"
        x-cloak
        x-init="_list = $el"
        {!! $anchorAttr !!}
        @click.outside="close(false)"
        @keydown.escape.prevent.stop="close()"
        @keydown.tab.prevent.stop="close()"
        @keydown.enter.prevent.stop="document.activeElement?.click()"
        @keydown.space.prevent.stop="document.activeElement?.click()"
        @keydown="$blatNav($event, { selector: '[role=option]' }); $blatType($event, '[role=option]')"
        :id="$id('blat-listbox')"
        role="listbox"
        tabindex="-1"
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
