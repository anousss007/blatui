<template x-teleport="body" wire:ignore>
    <div
        x-blat-dialog-layer
        x-show="open"
        x-cloak
        x-ref="submenu"
        x-init="_menu = $el"
        x-anchor.fixed.right-start.offset.4="$refs.subtrigger"
        @mouseenter="cancelClose()"
        @mouseleave="closeSoon()"
        @keydown.escape.prevent.stop="closeMenu()"
        @keydown.left.prevent.stop="closeMenu()"
        @keydown.stop="$blatNav($event); $blatType($event)"
        :id="$id('blat-submenu')"
        :aria-labelledby="$id('blat-submenu-trigger')"
        role="menu"
        aria-orientation="vertical"
        tabindex="-1"
        data-slot="dropdown-menu-sub-content"
        :data-state="open ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->twMerge('bg-popover text-popover-foreground fixed z-50 min-w-[8rem] origin-top-left overflow-hidden rounded-md border p-1 shadow-lg outline-none') }}
    >
        {{ $slot }}
    </div>
</template>
