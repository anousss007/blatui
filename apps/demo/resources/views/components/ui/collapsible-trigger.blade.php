<button
    type="button"
    data-slot="collapsible-trigger"
    @click="open = !open"
    :data-state="open ? 'open' : 'closed'"
    :aria-expanded="open"
    {{ $attributes }}
>
    {{ $slot }}
</button>
