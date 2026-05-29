@props(['inset' => false])

<div
    role="menuitem"
    tabindex="-1"
    x-ref="subtrigger"
    data-slot="context-menu-sub-trigger"
    @if ($inset) data-inset @endif
    :data-state="subOpen ? 'open' : 'closed'"
    {{ $attributes->twMerge("focus:bg-accent focus:text-accent-foreground hover:bg-accent hover:text-accent-foreground data-[state=open]:bg-accent data-[state=open]:text-accent-foreground flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none data-[inset]:pl-8 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4") }}
>
    {{ $slot }}
    <x-lucide-chevron-right class="ml-auto size-4" />
</div>
