@props(['size' => 'default', 'ariaLabel' => null])

<button
    type="button"
    x-ref="trigger"
    x-init="_trigger = $el"
    @if ($ariaLabel) aria-label="{{ $ariaLabel }}" @endif
    @click="toggleList()"
    @keydown.down.prevent.stop="openList()"
    @keydown.up.prevent.stop="openList()"
    @keydown.enter.prevent.stop="openList()"
    @keydown.space.prevent.stop="openList()"
    role="combobox"
    aria-haspopup="listbox"
    :aria-controls="$id('blat-listbox')"
    :aria-expanded="open"
    :data-state="open ? 'open' : 'closed'"
    :data-placeholder="label ? null : true"
    data-slot="select-trigger"
    data-size="{{ $size }}"
    {{ $attributes->twMerge("border-input data-[placeholder]:text-muted-foreground [&_svg:not([class*='text-'])]:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 dark:hover:bg-input/50 flex w-fit items-center justify-between gap-2 rounded-md border bg-transparent px-3 py-2 text-sm whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 data-[size=default]:h-9 data-[size=sm]:h-8 data-[size=lg]:h-10 *:data-[slot=select-value]:line-clamp-1 *:data-[slot=select-value]:flex *:data-[slot=select-value]:items-center *:data-[slot=select-value]:gap-2 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4") }}
>
    {{ $slot }}
    <x-lucide-chevron-down class="size-4 opacity-50" aria-hidden="true" />
</button>
