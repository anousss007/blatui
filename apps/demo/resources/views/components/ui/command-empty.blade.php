<div
    data-slot="command-empty"
    x-show="visibleCount === 0"
    x-cloak
    {{ $attributes->twMerge('py-6 text-center text-sm') }}
>{{ $slot }}</div>
