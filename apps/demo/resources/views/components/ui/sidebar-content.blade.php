{{-- Collapsed to the icon rail, the list still has to scroll — clipping it vertically makes
     the last groups unreachable. Only the horizontal overflow is clipped; the scrollbar
     itself is hidden there because a classic (non-overlay) one would eat ~16px out of a 3rem
     rail and squeeze the size-8 buttons against its track. Wheel, trackpad and Tab still
     scroll; the expanded sidebar keeps its normal scrollbar. --}}
<div data-slot="sidebar-content" data-sidebar="content" {{ $attributes->twMerge('flex min-h-0 flex-1 flex-col gap-2 overflow-auto group-data-[collapsible=icon]:overflow-x-hidden group-data-[collapsible=icon]:[scrollbar-width:none] group-data-[collapsible=icon]:[&::-webkit-scrollbar]:hidden') }}>
    {{ $slot }}
</div>
