<span
    x-ref="trigger"
    x-blat-trigger="{ describedby: $id('blat-tooltip'), state: null, focusable: true }"
    data-slot="tooltip-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
