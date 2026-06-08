@props(['value' => null, 'disabled' => false])

<button
    type="button"
    role="tab"
    data-slot="tabs-trigger"
    :id="$id('blat-tab', @js($value))"
    :aria-controls="$id('blat-tabpanel', @js($value))"
    :aria-selected="tab === @js($value)"
    :tabindex="tab === @js($value) ? 0 : -1"
    :data-state="tab === @js($value) ? 'active' : 'inactive'"
    @if ($disabled) disabled aria-disabled="true" @else @click="tab = @js($value)" @focus="tab = @js($value)" @endif
    {{ $attributes->twMerge("data-[state=active]:bg-background dark:data-[state=active]:text-foreground focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:outline-ring dark:data-[state=active]:border-input dark:data-[state=active]:bg-input/30 text-foreground dark:text-muted-foreground inline-flex h-[calc(100%-1px)] flex-1 items-center justify-center gap-1.5 rounded-md border border-transparent px-2 py-1 text-sm font-medium whitespace-nowrap transition-[color,box-shadow] focus-visible:ring-[3px] focus-visible:outline-1 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4") }}
>
    {{ $slot }}
</button>
