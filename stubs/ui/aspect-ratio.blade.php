@props(['ratio' => '1 / 1'])

<div data-slot="aspect-ratio" style="aspect-ratio: {{ $ratio }}" {{ $attributes->twMerge('relative') }}>
    {{ $slot }}
</div>
