{{-- Secondary step text, under the title. --}}
<span
    data-slot="stepper-description"
    {{ $attributes->twMerge('text-muted-foreground text-xs') }}
>
    {{ $slot }}
</span>
