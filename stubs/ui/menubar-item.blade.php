@props([
    'href' => null,
    'variant' => 'default',
    'inset' => false,
    'disabled' => false,
])

@php
    $classes = "focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground data-[variant=destructive]:text-destructive data-[variant=destructive]:focus:bg-destructive/10 data-[variant=destructive]:hover:bg-destructive/10 data-[variant=destructive]:focus:text-destructive data-[variant=destructive]:*:[svg]:!text-destructive [&_svg:not([class*='text-'])]:text-muted-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-left text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 data-[inset]:pl-8";
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        role="menuitem"
        data-slot="menubar-item"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @click="active = null"
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</a>
@else
    <button
        type="button"
        role="menuitem"
        tabindex="-1"
        data-slot="menubar-item"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @if ($disabled) disabled data-disabled @endif
        @click="active = null"
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</button>
@endif
