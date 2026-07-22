@props([
    'side' => 'top',
    'align' => 'center',
    'sideOffset' => 4,
    'arrow' => true,
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
        :id="$id('blat-tooltip')"
        role="tooltip"
        data-slot="tooltip-content"
        data-side="{{ $side }}"
        :data-state="open ? 'open' : 'closed'"
        {{-- Opacity-only transition: scaling an x-anchor'd, teleported panel makes it visibly
             resize + reposition on open (anchor recalculates after the reflow). --}}
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        {{-- max-w-xs so long text wraps instead of becoming a full-width single-line bar.
             No text-balance: it triggers a second layout pass on an anchored/teleported node. --}}
        {{ $attributes->twMerge('group/tooltip bg-primary text-primary-foreground fixed z-50 w-fit max-w-xs rounded-md px-3 py-1.5 text-xs') }}
    >
        {{ $slot }}
        @if ($arrow)
            {{-- Inherits the tooltip's background so colored / light variants match; positioned per side. --}}
            <span
                aria-hidden="true"
                class="bg-inherit absolute size-2.5 rotate-45 rounded-[2px]
                    group-data-[side=top]/tooltip:-bottom-1 group-data-[side=top]/tooltip:left-1/2 group-data-[side=top]/tooltip:-translate-x-1/2
                    group-data-[side=bottom]/tooltip:-top-1 group-data-[side=bottom]/tooltip:left-1/2 group-data-[side=bottom]/tooltip:-translate-x-1/2
                    group-data-[side=left]/tooltip:-right-1 group-data-[side=left]/tooltip:top-1/2 group-data-[side=left]/tooltip:-translate-y-1/2
                    group-data-[side=right]/tooltip:-left-1 group-data-[side=right]/tooltip:top-1/2 group-data-[side=right]/tooltip:-translate-y-1/2"
            ></span>
        @endif
    </div>
</template>
