@props([
    'value' => '',
    'closeOnSelect' => false,
])

<x-ui.menu-radio-item
    :data-slot="'dropdown-menu-radio-item'"
    :value="$value"
    :close-on-select="$closeOnSelect"
    {{ $attributes }}
>{{ $slot }}</x-ui.menu-radio-item>
