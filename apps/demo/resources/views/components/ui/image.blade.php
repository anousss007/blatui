@props([
    'src' => null,
    'alt' => '',
    'ratio' => null,
    'placeholder' => null,
    'rounded' => 'rounded-lg',
    'fit' => 'cover',
])

@php
    $object = $fit === 'contain' ? 'object-contain' : 'object-cover';
@endphp

<div
    data-slot="image"
    x-data="{ loaded: false, error: false }"
    @if ($ratio) style="aspect-ratio: {{ $ratio }}" @endif
    {{ $attributes->twMerge('relative block overflow-hidden ' . $rounded) }}
>
    {{-- Placeholder / skeleton shown until the full image loads --}}
    @if ($placeholder)
        <img
            src="{{ $placeholder }}"
            alt=""
            aria-hidden="true"
            x-show="!loaded && !error"
            class="absolute inset-0 size-full scale-110 blur-xl {{ $object }}"
        />
    @else
        <div
            aria-hidden="true"
            x-show="!loaded && !error"
            class="bg-muted absolute inset-0 size-full animate-pulse"
        ></div>
    @endif

    {{-- The actual image: fades in on load --}}
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        loading="lazy"
        decoding="async"
        x-show="!error"
        x-on:load="loaded = true"
        x-on:error="error = true"
        x-bind:class="loaded ? 'opacity-100' : 'opacity-0'"
        class="relative size-full transition-opacity duration-500 ease-out {{ $object }}"
    />

    {{-- Error fallback: muted box with an image-off icon + the alt as text --}}
    <div
        x-show="error"
        x-cloak
        class="bg-muted text-muted-foreground absolute inset-0 flex flex-col items-center justify-center gap-2 p-4 text-center text-sm"
    >
        <x-lucide-image-off class="size-6 opacity-60" aria-hidden="true" />
        @if ($alt !== '')
            <span>{{ $alt }}</span>
        @endif
    </div>
</div>
