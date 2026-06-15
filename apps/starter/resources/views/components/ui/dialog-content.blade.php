{{--
    fullscreen  render the dialog edge-to-edge (inset-0) instead of a centered box —
                useful for mobile-style takeovers, editors, media viewers.
    position    where the box sits: center (default) | top | bottom | left | right |
                top-left | top-right | bottom-left | bottom-right.
--}}
@props(['showClose' => true, 'fullscreen' => false, 'position' => 'center'])

@php
    $positions = [
        'center' => 'top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2',
        'top' => 'top-4 left-1/2 -translate-x-1/2',
        'bottom' => 'bottom-4 left-1/2 -translate-x-1/2',
        'left' => 'top-1/2 left-4 -translate-y-1/2',
        'right' => 'top-1/2 right-4 -translate-y-1/2',
        'top-left' => 'top-4 left-4',
        'top-right' => 'top-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
    ];
    $pos = $positions[$position] ?? $positions['center'];

    $box = $fullscreen
        ? 'bg-background fixed inset-0 z-50 flex w-full flex-col gap-4 overflow-y-auto border-0 p-6 shadow-lg'
        : 'bg-background fixed z-50 grid w-full max-w-[calc(100%-2rem)] gap-4 rounded-lg border p-6 shadow-lg sm:max-w-lg '.$pos;
@endphp

<template x-teleport="body">
    <div x-show="open" x-cloak class="fixed inset-0 z-50">
        <div
            x-show="open"
            @click="open = false"
            role="presentation"
            aria-hidden="true"
            data-slot="dialog-overlay"
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
            :id="$id('blat-dialog')"
            x-blat-labelledby="{ label: '[data-slot=dialog-title]', description: '[data-slot=dialog-description]' }"
            role="dialog"
            aria-modal="true"
            tabindex="-1"
            data-slot="dialog-content"
            @if ($fullscreen)
                data-fullscreen="true"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            @else
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
            @endif
            {{ $attributes->twMerge($box) }}
        >
            {{ $slot }}

            @if ($showClose)
                <button
                    type="button"
                    @click="open = false"
                    data-slot="dialog-close"
                    class="ring-offset-background focus:ring-ring data-[state=open]:bg-accent data-[state=open]:text-muted-foreground absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4"
                >
                    <x-lucide-x />
                    <span class="sr-only">Close</span>
                </button>
            @endif
        </div>
    </div>
</template>
