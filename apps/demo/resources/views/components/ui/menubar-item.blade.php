@props([
    'href' => null,
    'variant' => 'default',
    'inset' => false,
    'disabled' => false,
])

@php
    // menubar uses a slightly different destructive-variant class set (no dark: focus
    // background, hover ordered before focus:text) and always wires @click="closeMenu()"
    // without merging/stripping any caller @click, so pass the exact string + mergeClick=false.
    $menubarClasses = "focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground data-[variant=destructive]:text-destructive data-[variant=destructive]:focus:bg-destructive/10 data-[variant=destructive]:hover:bg-destructive/10 data-[variant=destructive]:focus:text-destructive data-[variant=destructive]:*:[svg]:!text-destructive [&_svg:not([class*='text-'])]:text-muted-foreground relative flex w-full cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-left text-sm outline-hidden select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4 data-[inset]:pl-8";

    // menubar-item never exposed `type`/`closeOnSelect`; it always submits as a button
    // and always closes on select. Drop any caller values so the primitive can't change.
    $attributes = $attributes->except(['type', 'closeOnSelect', 'close-on-select']);
@endphp

<x-ui.menu-item
    :data-slot="'menubar-item'"
    :classes="$menubarClasses"
    :merge-click="false"
    :click-conditional="false"
    :href="$href"
    :variant="$variant"
    :inset="$inset"
    :disabled="$disabled"
    {{ $attributes }}
>{{ $slot }}</x-ui.menu-item>
