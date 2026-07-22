<div
    data-slot="context-menu-trigger"
    x-init="_trigger = $el"
    tabindex="-1"
    @contextmenu="openAt($event)"
    {{ $attributes->twMerge('outline-none') }}
>
    {{ $slot }}
</div>
