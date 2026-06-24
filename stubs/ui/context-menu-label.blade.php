@props(['inset' => false])

<x-ui.menu-label
    :data-slot="'context-menu-label'"
    :classes="'text-foreground px-2 py-1.5 text-sm font-medium data-[inset]:pl-8'"
    :inset="$inset"
    {{ $attributes }}
>{{ $slot }}</x-ui.menu-label>
