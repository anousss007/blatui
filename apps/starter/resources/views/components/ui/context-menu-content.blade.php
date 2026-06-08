<template x-teleport="body">
    <div
        x-show="open"
        x-cloak
        x-ref="menu"
        x-init="_menu = $el"
        @click.outside="closeMenu(false)"
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
