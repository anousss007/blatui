@php
    // A consumer x-init runs after the component's own: two x-init attributes on one element
    // and the browser keeps only the first, silently dropping the consumer's (issue #46).
    $xInit = $attributes->get('x-init');
    $attributes = $attributes->except('x-init');
@endphp

<button
    type="button"
    x-ref="trigger"
    role="menuitem"
    aria-haspopup="menu"
    x-init="register(id, $el){{ $xInit ? '; '.$xInit : '' }}"
    :id="id + '-trigger'"
    :aria-controls="id"
    :aria-expanded="active === id"
    :tabindex="rovingId === id ? 0 : -1"
    @click="toggleMenu(id)"
    @focus="rovingId = id"
    @mouseenter="
        if (active !== null) {
            active = id;
            rovingId = id;
        }
    "
    @keydown.down.prevent.stop="openMenu(id)"
    @keydown.enter.prevent.stop="openMenu(id)"
    @keydown.space.prevent.stop="openMenu(id)"
    @keydown.right.prevent.stop="moveTrigger(1, id)"
    @keydown.left.prevent.stop="moveTrigger(-1, id)"
    :data-state="active === id ? 'open' : 'closed'"
    data-slot="menubar-trigger"
    {{ $attributes->twMerge('focus:bg-accent focus:text-accent-foreground data-[state=open]:bg-accent data-[state=open]:text-accent-foreground flex items-center rounded-sm px-2 py-1 text-sm font-medium outline-hidden select-none') }}
>
    {{ $slot }}
</button>
