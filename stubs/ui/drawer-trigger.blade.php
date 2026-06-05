<span
    @click="open = true"
    x-blat-trigger="{ haspopup: 'dialog', controls: $id('blat-drawer') }"
    data-slot="drawer-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
