{{-- Step label. --}}
<span
    data-slot="stepper-title"
    {{ $attributes->twMerge('text-sm font-medium leading-none') }}
>
    {{ $slot }}
</span>
