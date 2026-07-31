<template x-teleport="body" wire:ignore>
    <div
        x-blat-dialog-layer
        x-show="open"
        x-cloak
        x-ref="menu"
        x-init="_menu = $el"
        @click.outside="closeMenu(false)"
        {{-- The menu is pinned to fixed viewport coords captured at open, so close it on
             page scroll/resize instead of leaving it stranded (matches Radix). The menu's
             own overflow scroll does not bubble to window, so it stays open while scrolling
             inside it. --}}
        @scroll.window="closeMenu(false)"
        @resize.window="closeMenu(false)"
        @keydown.escape.prevent.stop="closeMenu()"
        @keydown.tab.prevent.stop="closeMenu()"
        @keydown="$blatNav($event); $blatType($event)"
        :style="`position: fixed; left: ${x}px; top: ${y}px`"
        role="menu"
        aria-orientation="vertical"
        tabindex="-1"
        data-slot="context-menu-content"
        :data-state="open ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->twMerge('bg-popover text-popover-foreground z-50 max-h-96 min-w-[8rem] origin-top-left overflow-x-hidden overflow-y-auto rounded-md border p-1 shadow-md outline-none') }}
    >
        {{ $slot }}
    </div>
</template>
