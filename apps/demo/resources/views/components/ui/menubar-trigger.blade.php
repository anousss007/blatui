<button
    type="button"
    x-ref="trigger"
    @click="active = (active === id ? null : id)"
    @mouseenter="if (active !== null) active = id"
    :data-state="active === id ? 'open' : 'closed'"
    data-slot="menubar-trigger"
    {{ $attributes->twMerge('focus:bg-accent focus:text-accent-foreground data-[state=open]:bg-accent data-[state=open]:text-accent-foreground flex items-center rounded-sm px-2 py-1 text-sm font-medium outline-hidden select-none') }}
>{{ $slot }}</button>
