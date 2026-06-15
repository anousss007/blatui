@props([
    'as' => 'span',
    'focusable' => false,
])

@php
    // `sr-only` keeps content available to assistive tech while hiding it visually.
    // When `focusable`, the standard skip-link reveal un-hides the element on focus
    // (e.g. a "Skip to content" link that appears only when tabbed to). `start-4`
    // (logical inset) keeps it RTL-safe.
    $base = 'sr-only';

    if ($focusable) {
        $base .= ' focus:not-sr-only focus:fixed focus:start-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-primary focus:px-4 focus:py-2 focus:text-primary-foreground focus:shadow-md';
    }
@endphp

<{{ $as }}
    data-slot="visually-hidden"
    {{ $attributes->twMerge($base) }}
>{{ $slot }}</{{ $as }}>
