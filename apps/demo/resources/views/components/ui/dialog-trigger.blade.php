<span
    @click="open = true"
    x-blat-trigger="{ haspopup: 'dialog', controls: $id('blat-dialog') }"
    data-slot="dialog-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
