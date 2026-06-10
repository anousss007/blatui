@props([
    'icon' => 'loader-circle',    // any lucide icon name (e.g. loader-circle, rotate-cw, loader-pinwheel)
])

<x-dynamic-component
    :component="'lucide-' . $icon"
    data-slot="spinner"
    role="status"
    aria-label="Loading"
    {{ $attributes->twMerge('size-4 animate-spin') }}
/>
