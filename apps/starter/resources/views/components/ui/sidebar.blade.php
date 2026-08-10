@props([
    'side' => 'left',
    'variant' => 'sidebar',
    'collapsible' => 'offcanvas',
])

@php
    $isLeft = $side === 'left';

    // twMerge() MUTATES the bag it is called on (it offsetSet's the merged class and returns
    // $this). The desktop root and the mobile panel are BOTH rendered, so merging into
    // $attributes for one leaks those classes into the other: that is how `hidden md:block`
    // reached the mobile drawer and kept it display:none below md. Merge into a copy and leave
    // $attributes exactly as the consumer passed it.
    $rootAttributes = $attributes->except('class');
    $userClass = (string) $attributes->get('class', '');
@endphp

@if ($collapsible === 'none')
    {{-- Non-collapsible: a plain in-flow panel (no fixed pinning). --}}
    <div
        data-slot="sidebar"
        data-variant="{{ $variant }}"
        data-side="{{ $side }}"
        {{ $rootAttributes->twMerge('bg-sidebar text-sidebar-foreground flex h-full w-(--sidebar-width) flex-col', $userClass) }}
    >
        {{ $slot }}
    </div>
@else
{{-- Desktop. The consumer's attributes land here (the in-flow root); the mobile
     overlay below is a teleported sibling, so it only mirrors the classes —
     duplicating id/x-data/aria across both would collide in the DOM. --}}
<div
    {{ $rootAttributes->twMerge('text-sidebar-foreground group peer hidden md:block', $userClass) }}
    :data-state="open ? 'expanded' : 'collapsed'"
    :data-collapsible="open ? '' : @js($collapsible)"
    data-variant="{{ $variant }}"
    data-side="{{ $side }}"
    data-slot="sidebar"
>
    {{-- gap --}}
    <div
        class="relative bg-transparent transition-[width] duration-200 ease-linear"
        :style="open
            ? 'width: var(--sidebar-width)'
            : (@js($collapsible) === 'icon' ? 'width: var(--sidebar-width-icon)' : 'width: 0')"
    ></div>
    {{-- fixed container --}}
    <div
        class="fixed inset-y-0 z-10 hidden h-svh transition-[left,right,width,transform] duration-200 ease-linear md:flex {{ $isLeft ? 'left-0' : 'right-0' }}"
        :style="open
            ? 'width: var(--sidebar-width)'
            : (@js($collapsible) === 'icon'
                ? 'width: var(--sidebar-width-icon)'
                : 'width: var(--sidebar-width); transform: translateX({{ $isLeft ? '-100%' : '100%' }})')"
    >
        <div
            data-sidebar="sidebar"
            class="bg-sidebar flex h-full w-full flex-col {{ $isLeft ? 'border-r' : 'border-l' }} border-sidebar-border"
        >
            {{ $slot }}
        </div>
    </div>
</div>

{{-- Mobile overlay --}}
<template x-teleport="body">
    <div x-show="openMobile" x-cloak class="fixed inset-0 z-50 md:hidden">
        <div
            x-show="openMobile"
            @click="openMobile = false"
            role="presentation"
            aria-hidden="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50"
        ></div>
        <div
            x-show="openMobile"
            x-trap.noscroll.inert="openMobile"
            @keydown.escape.window="openMobile = false"
            role="dialog"
            aria-modal="true"
            aria-label="Sidebar"
            tabindex="-1"
            x-transition:enter="transition ease-in-out duration-300"
            x-transition:enter-start="{{ $isLeft ? '-translate-x-full' : 'translate-x-full' }}"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="{{ $isLeft ? '-translate-x-full' : 'translate-x-full' }}"
            {{ $attributes->only('class')->twMerge('bg-sidebar text-sidebar-foreground fixed inset-y-0 '.($isLeft ? 'left-0' : 'right-0').' z-50 flex h-svh w-(--sidebar-width) flex-col') }}
        >
            {{ $slot }}
        </div>
    </div>
</template>
@endif
