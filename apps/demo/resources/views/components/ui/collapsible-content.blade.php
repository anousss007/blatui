<div
    data-slot="collapsible-content"
    :id="$id('blat-collapsible')"
    x-show="open"
    x-collapse
    x-cloak
    :data-state="open ? 'open' : 'closed'"
    {{ $attributes }}
>
    {{ $slot }}
</div>
