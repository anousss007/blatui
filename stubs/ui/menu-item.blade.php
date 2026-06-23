@props([
    'dataSlot' => 'menu-item',
    'classes' => "focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground data-[variant=destructive]:text-destructive data-[variant=destructive]:focus:bg-destructive/10 dark:data-[variant=destructive]:focus:bg-destructive/20 data-[variant=destructive]:focus:text-destructive data-[variant=destructive]:hover:bg-destructive/10 data-[variant=destructive]:*:[svg]:!text-destructive [&_svg:not([class*='text-'])]:text-muted-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-left text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 data-[inset]:pl-8",
    'href' => null,
    'variant' => 'default',
    'inset' => false,
    'disabled' => false,
    'closeOnSelect' => true,
    'type' => 'button',   // set type="submit" to submit the surrounding <form> (default button = no submit)
    // mergeClick=true: strip any caller @click/x-on:click and merge it with the
    //   close-on-select expression (dropdown / context behaviour). mergeClick=false:
    //   always emit @click="closeMenu()" and leave the caller's @click on the bag (menubar).
    'mergeClick' => true,
    // clickConditional=true omits the click handler when the expression is empty
    //   (dropdown can opt out of close-on-select). clickConditional=false always emits
    //   a bare click line (context / menubar, which always close on select).
    //   Controls byte-for-byte whitespace layout of the click attribute.
    'clickConditional' => true,
])

@php
    // Merge any caller-provided @click with the close-on-select behaviour so the
    // two don't collide into duplicate attributes (the browser would keep only one).
    // closeMenu() (not a bare `open = false`) so keyboard focus returns to the trigger.
    if ($mergeClick) {
        $userClick = $attributes->get('@click') ?? $attributes->get('x-on:click');
        $attributes = $attributes->except(['@click', 'x-on:click']);
        $clickExpr = collect([$userClick, $closeOnSelect ? 'closeMenu()' : null])->filter()->implode('; ');
    } else {
        $clickExpr = 'closeMenu()';
    }
@endphp

@if ($href)
@if ($clickConditional)
    <a
        href="{{ $href }}"
        role="menuitem"
        tabindex="-1"
        data-slot="{{ $dataSlot }}"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @if ($clickExpr) @click="{{ $clickExpr }}" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</a>
@else
    <a
        href="{{ $href }}"
        role="menuitem"
        tabindex="-1"
        data-slot="{{ $dataSlot }}"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @click="{{ $clickExpr }}"
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</a>
@endif
@else
@if ($clickConditional)
    <button
        type="{{ $type }}"
        role="menuitem"
        tabindex="-1"
        data-slot="{{ $dataSlot }}"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @if ($disabled) disabled data-disabled aria-disabled="true" @endif
        @if ($clickExpr) @click="{{ $clickExpr }}" @endif
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</button>
@else
    <button
        type="{{ $type }}"
        role="menuitem"
        tabindex="-1"
        data-slot="{{ $dataSlot }}"
        data-variant="{{ $variant }}"
        @if ($inset) data-inset @endif
        @if ($disabled) disabled data-disabled aria-disabled="true" @endif
        @click="{{ $clickExpr }}"
        {{ $attributes->twMerge($classes) }}
    >{{ $slot }}</button>
@endif
@endif
