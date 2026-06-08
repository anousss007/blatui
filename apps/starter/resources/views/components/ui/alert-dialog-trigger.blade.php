<span
    @click="open = true"
    x-blat-trigger="{ haspopup: 'dialog', controls: $id('blat-alert-dialog') }"
    data-slot="alert-dialog-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
