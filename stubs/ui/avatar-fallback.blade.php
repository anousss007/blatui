<span
    data-slot="avatar-fallback"
    x-show="error || !loaded"
    {{ $attributes->twMerge('bg-muted flex size-full items-center justify-center rounded-full text-sm') }}
>
    {{ $slot }}
</span>
