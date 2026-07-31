@props([
    'href' => null,
    'variant' => 'default',
    'inset' => false,
    'disabled' => false,
])

@php
    // context-menu-item never exposed `type`/`closeOnSelect`; it always submits as a
    // button and always closes on select. Drop any caller-supplied values for those so
    // the shared primitive's props can't change behaviour.
    $attributes = $attributes->except(['type', 'closeOnSelect', 'close-on-select']);
@endphp

<x-ui.menu-item
    :data-slot="'context-menu-item'"
    :click-conditional="false"
    :href="$href"
    :variant="$variant"
    :inset="$inset"
    :disabled="$disabled"
    {{ $attributes }}
>{{ $slot }}</x-ui.menu-item>
