<template x-teleport="body">
    <div x-show="open" x-cloak class="fixed inset-0 z-50">
        <div
            x-show="open"
            role="presentation"
            aria-hidden="true"
            data-slot="alert-dialog-overlay"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-black/50"
        ></div>

        <div
            x-show="open"
            x-trap.noscroll.inert="open"
            @keydown.escape.window="open = false"
            :id="$id('blat-alert-dialog')"
            x-blat-labelledby="{ label: '[data-slot=alert-dialog-title]', description: '[data-slot=alert-dialog-description]' }"
            role="alertdialog"
            aria-modal="true"
            tabindex="-1"
            data-slot="alert-dialog-content"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            {{ $attributes->twMerge('bg-background fixed top-[50%] left-[50%] z-50 grid w-full max-w-[calc(100%-2rem)] translate-x-[-50%] translate-y-[-50%] gap-4 rounded-lg border p-6 shadow-lg sm:max-w-lg') }}
        >
            {{ $slot }}
        </div>
    </div>
</template>
