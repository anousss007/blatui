<div
    data-slot="collapsible-content"
    x-show="open"
    x-collapse
    x-cloak
    :data-state="open ? 'open' : 'closed'"
    {{ $attributes }}
>
    {{ $slot }}
</div>
