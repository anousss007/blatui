<div
    data-slot="context-menu-trigger"
    @contextmenu.prevent="open = true; x = $event.clientX; y = $event.clientY"
    {{ $attributes }}
>
    {{ $slot }}
</div>
