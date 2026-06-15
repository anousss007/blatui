@props(['size' => 'lg'])

@php
    // Literal class strings so Tailwind v4 can statically detect them — never interpolate.
    $maxW = [
        'sm' => 'max-w-3xl',
        'md' => 'max-w-5xl',
        'lg' => 'max-w-6xl',
        'xl' => 'max-w-7xl',
        'prose' => 'max-w-prose',
        'full' => 'max-w-full',
    ][$size] ?? 'max-w-6xl';
@endphp

<div data-slot="container" {{ $attributes->twMerge('mx-auto w-full px-4 sm:px-6 lg:px-8 ' . $maxW) }}>
    {{ $slot }}
</div>
