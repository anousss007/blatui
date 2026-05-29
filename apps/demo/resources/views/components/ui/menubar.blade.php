<div
    data-slot="menubar"
    x-data="{ active: null }"
    {{ $attributes->twMerge('bg-background flex h-9 items-center gap-1 rounded-md border p-1 shadow-xs') }}
>
    {{ $slot }}
</div>
