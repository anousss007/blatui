{{-- Collapsed to the icon rail, the list still has to scroll — clipping it vertically makes
     the last groups unreachable. Only the horizontal overflow is clipped; the scrollbar
     itself is hidden there because a classic (non-overlay) one would eat ~16px out of a 3rem
     rail and squeeze the size-8 buttons against its track. Wheel, trackpad and Tab still
     scroll; the expanded sidebar keeps its normal scrollbar.

     persist  Remember how far the list is scrolled, per browser tab, and restore it after a
              wire:navigate visit or a reload: true, or a key of your own when two lists
              should not share one. No @persist needed. #54 --}}
@props(['persist' => false])

@php
    $scrollKey = in_array($persist, [true, 'true'], true) ? 'sidebar_scroll' : (is_string($persist) && ! in_array($persist, ['', 'false'], true) ? $persist : null);
@endphp

<div
    data-slot="sidebar-content"
    data-sidebar="content"
    @if ($scrollKey) x-blat-scroll-memory="@js($scrollKey)" @endif
    {{-- Without anchoring when it remembers: the group around the current link opens just after
         the position is put back, above it, and anchoring would push the list down by that much. --}}
    {{ $attributes->twMerge(($scrollKey ? '[overflow-anchor:none] ' : '').'flex min-h-0 flex-1 flex-col gap-2 overflow-auto group-data-[collapsible=icon]:overflow-x-hidden group-data-[collapsible=icon]:[scrollbar-width:none] group-data-[collapsible=icon]:[&::-webkit-scrollbar]:hidden') }}
>
    {{ $slot }}
</div>
