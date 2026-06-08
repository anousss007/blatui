<button
    type="button"
    data-slot="collapsible-trigger"
    @click="open = !open"
    :aria-controls="$id('blat-collapsible')"
    :data-state="open ? 'open' : 'closed'"
    :aria-expanded="open"
    {{ $attributes }}
>
    {{ $slot }}
</button>
