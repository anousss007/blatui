@props([
    'href' => null,
    'variant' => 'default',
    'inset' => false,
    'disabled' => false,
    'closeOnSelect' => true,
    'type' => 'button',   // set type="submit" to submit the surrounding <form> (default button = no submit)
])

<x-ui.menu-item
    :data-slot="'dropdown-menu-item'"
    :href="$href"
    :variant="$variant"
    :inset="$inset"
    :disabled="$disabled"
    :close-on-select="$closeOnSelect"
    :type="$type"
    {{ $attributes }}
>{{ $slot }}</x-ui.menu-item>
