@props(['href' => '#'])

<a href="{{ $href }}" data-slot="breadcrumb-link" {{ $attributes->twMerge('hover:text-foreground transition-colors') }}>
    {{ $slot }}
</a>
