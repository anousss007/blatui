@props(['direction' => null])

@php
    $sideClasses = [
        'bottom' => 'inset-x-0 bottom-0 mt-24 max-h-[80vh] rounded-t-lg border-b-0',
        'top' => 'inset-x-0 top-0 mb-24 max-h-[80vh] rounded-b-lg border-t-0',
        'right' => 'inset-y-0 right-0 w-3/4 border-l sm:max-w-sm',
        'left' => 'inset-y-0 left-0 w-3/4 border-r sm:max-w-sm',
    ];
    $enterStart = [
        'bottom' => 'translate-y-full',
        'top' => '-translate-y-full',
        'right' => 'translate-x-full',
        'left' => '-translate-x-full',
    ];
@endphp

<template x-teleport="body">
    <div x-show="open" x-cloak class="fixed inset-0 z-50">
        <div
            x-show="open"
            @click="open = false"
            data-slot="drawer-overlay"
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
            data-slot="drawer-content"
            :data-vaul-drawer-direction="direction"
            x-bind:class="{
                'inset-x-0 bottom-0 mt-24 max-h-[80vh] rounded-t-lg border-b-0': direction === 'bottom',
                'inset-x-0 top-0 mb-24 max-h-[80vh] rounded-b-lg border-t-0': direction === 'top',
                'inset-y-0 right-0 w-3/4 border-l sm:max-w-sm': direction === 'right',
                'inset-y-0 left-0 w-3/4 border-r sm:max-w-sm': direction === 'left'
            }"
            x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100 translate-x-0 translate-y-0"
            x-transition:leave="transition ease-in-out duration-200"
            x-transition:leave-start="opacity-100 translate-x-0 translate-y-0"
            x-transition:leave-end="opacity-0"
            {{ $attributes->twMerge('bg-background group/drawer-content fixed z-50 flex h-auto flex-col border') }}
        >
            <div
                x-show="direction === 'bottom'"
                class="bg-muted mx-auto mt-4 hidden h-2 w-[100px] shrink-0 rounded-full group-data-[vaul-drawer-direction=bottom]/drawer-content:block"
            ></div>
            {{ $slot }}
        </div>
    </div>
</template>
