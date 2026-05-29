@props([
    'href' => null,
    'variant' => 'default',
    'inset' => false,
    'disabled' => false,
    'closeOnSelect' => true,
])

@php
    $classes = "focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground data-[variant=destructive]:text-destructive data-[variant=destructive]:focus:bg-destructive/10 dark:data-[variant=destructive]:focus:bg-destructive/20 data-[variant=destructive]:focus:text-destructive data-[variant=destructive]:hover:bg-destructive/10 data-[variant=destructive]:*:[svg]:!text-destructive [&_svg:not([class*='text-'])]:text-muted-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-left text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 data-[inset]:pl-8";

    // Merge any caller-provided @click with the close-on-select behaviour so the
    // two don't collide into duplicate attributes (the browser would keep only one).
    $userClick = $attributes->get('@click') ?? $attributes->get('x-on:click');
    $attributes = $attributes->except(['@click', 'x-on:click']);
    $clickExpr = collect([$userClick, $closeOnSelect ? 'open = false' : null])->filter()->implode('; ');
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        role="menuitem"
        data-slot="dropdown-menu-item"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @if ($clickExpr) @click="{{ $clickExpr }}" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</a>
@else
    <button
        type="button"
        role="menuitem"
        tabindex="-1"
        data-slot="dropdown-menu-item"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @if ($disabled) disabled data-disabled @endif
        @if ($clickExpr) @click="{{ $clickExpr }}" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</button>
@endif
