@props(['src' => null, 'alt' => ''])

<img
    data-slot="avatar-image"
    src="{{ $src }}"
    alt="{{ $alt }}"
    x-show="!error"
    x-on:load="loaded = true"
    x-on:error="error = true"
    {{ $attributes->twMerge('aspect-square size-full') }}
/>
