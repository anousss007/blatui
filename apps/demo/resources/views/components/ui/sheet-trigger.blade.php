<span
    @click="open = true"
    x-blat-trigger="{ haspopup: 'dialog', controls: $id('blat-sheet') }"
    data-slot="sheet-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
