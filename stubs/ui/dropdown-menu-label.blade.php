@props(['inset' => false])

<x-ui.menu-label
    :data-slot="'dropdown-menu-label'"
    :inset="$inset"
    {{ $attributes }}
>{{ $slot }}</x-ui.menu-label>
