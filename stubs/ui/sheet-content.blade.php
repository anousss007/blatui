@props([
    'side' => 'right',
    'showClose' => true,
])

@php
    $sideClasses = [
        'right' => 'inset-y-0 right-0 h-full w-3/4 border-l sm:max-w-sm',
        'left' => 'inset-y-0 left-0 h-full w-3/4 border-r sm:max-w-sm',
        'top' => 'inset-x-0 top-0 h-auto border-b',
        'bottom' => 'inset-x-0 bottom-0 h-auto border-t',
    ];

    $enterStart = [
        'right' => 'translate-x-full',
        'left' => '-translate-x-full',
        'top' => '-translate-y-full',
        'bottom' => 'translate-y-full',
    ];

    $base = 'bg-background fixed z-50 flex flex-col gap-4 shadow-lg';
    $classes = $base.' '.($sideClasses[$side] ?? $sideClasses['right']);
    $start = $enterStart[$side] ?? $enterStart['right'];
@endphp

<template x-teleport="body">
    <div x-show="open" x-cloak class="fixed inset-0 z-50">
        <div
            x-show="open"
            @click="open = false"
            data-slot="sheet-overlay"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 bg-black/50"
        ></div>

        <div
            x-show="open"
            x-trap.noscroll="open"
            @keydown.escape.window="open = false"
            role="dialog"
            aria-modal="true"
            data-slot="sheet-content"
            data-side="{{ $side }}"
            x-transition:enter="transition ease-in-out duration-500"
            x-transition:enter-start="{{ $start }}"
            x-transition:enter-end="translate-x-0 translate-y-0"
            x-transition:leave="transition ease-in-out duration-300"
            x-transition:leave-start="translate-x-0 translate-y-0"
            x-transition:leave-end="{{ $start }}"
            {{ $attributes->twMerge($classes) }}
        >
            {{ $slot }}

            @if ($showClose)
                <button
                    type="button"
                    @click="open = false"
                    class="ring-offset-background focus:ring-ring absolute top-4 right-4 rounded-xs opacity-70 transition-opacity hover:opacity-100 focus:ring-2 focus:ring-offset-2 focus:outline-hidden disabled:pointer-events-none"
                >
                    <x-lucide-x class="size-4" />
                    <span class="sr-only">Close</span>
                </button>
            @endif
        </div>
    </div>
</template>
