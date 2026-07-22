@props([
    'name' => null,
])

@php
    // Auto-mirror directional icons under RTL (e.g. an arrow that should point the other
    // way in Arabic/Hebrew). Adds `.blat-rtl-flip` (defined in the foundations CSS) when the
    // icon name is a directional arrow/chevron/caret. Pass any other attributes through.
    $directional = $name
        && preg_match('/(arrow|chevron|caret)/i', $name)
        && preg_match('/(left|right)/i', $name);
@endphp

<x-dynamic-component
    :component="'lucide-' . $name"
    {{ $attributes->class(['blat-rtl-flip' => (bool) $directional]) }}
/>
