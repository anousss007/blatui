<span
    x-ref="trigger"
    @click="open = !open"
    x-blat-trigger="{ haspopup: 'dialog', controls: $id('blat-popover') }"
    data-slot="popover-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
