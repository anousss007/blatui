@props([
    'value' => null,
    'href' => null,
    'disabled' => false,
])

@php
    $kw = $value ?? trim(strip_tags($slot));
    $classes = "data-[selected=true]:bg-accent data-[selected=true]:text-accent-foreground hover:bg-accent hover:text-accent-foreground [&_svg:not([class*='text-'])]:text-muted-foreground relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4";
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        role="option"
        data-slot="command-item"
        x-init="registerItem($el, @js($kw), @js($disabled))"
        x-show="matches(@js($kw))"
        :aria-selected="activeId === $el.id"
        :data-selected="activeId === $el.id"
        @mouseenter="activeId = $el.id"
        @if ($disabled) aria-disabled="true" data-disabled="true" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</a>
@else
    <div
        role="option"
        data-slot="command-item"
        x-init="registerItem($el, @js($kw), @js($disabled))"
        x-show="matches(@js($kw))"
        :aria-selected="activeId === $el.id"
        :data-selected="activeId === $el.id"
        @mouseenter="activeId = $el.id"
        @if ($disabled) aria-disabled="true" data-disabled="true" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</div>
@endif
