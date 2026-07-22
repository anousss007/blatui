@props(['inset' => false])

<x-ui.menu-label
    :data-slot="'menubar-label'"
    :inset="$inset"
    {{ $attributes }}
>{{ $slot }}</x-ui.menu-label>
