<span
    x-ref="trigger"
    @focus="show()"
    @blur="hide()"
    tabindex="0"
    data-slot="tooltip-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
