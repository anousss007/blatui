@props(['value' => null, 'disabled' => false])

@php
    // Shared, variant-agnostic base.
    $base = "text-foreground dark:text-muted-foreground inline-flex items-center justify-center gap-1.5 text-sm font-medium whitespace-nowrap transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:outline-ring focus-visible:ring-[3px] focus-visible:outline-1 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4";

    // Per-variant styling, selected by the parent tabs-list's data-variant (group/tabs-list).
    $segmented = "group-data-[variant=segmented]/tabs-list:h-[calc(100%-1px)] group-data-[variant=segmented]/tabs-list:flex-1 group-data-[variant=segmented]/tabs-list:rounded-md group-data-[variant=segmented]/tabs-list:border group-data-[variant=segmented]/tabs-list:border-transparent group-data-[variant=segmented]/tabs-list:px-2 group-data-[variant=segmented]/tabs-list:py-1 group-data-[variant=segmented]/tabs-list:data-[state=active]:bg-background group-data-[variant=segmented]/tabs-list:data-[state=active]:shadow-sm dark:group-data-[variant=segmented]/tabs-list:data-[state=active]:text-foreground dark:group-data-[variant=segmented]/tabs-list:data-[state=active]:border-input dark:group-data-[variant=segmented]/tabs-list:data-[state=active]:bg-input/30";

    $underline = "group-data-[variant=underline]/tabs-list:-mb-px group-data-[variant=underline]/tabs-list:rounded-none group-data-[variant=underline]/tabs-list:border-0 group-data-[variant=underline]/tabs-list:border-b-2 group-data-[variant=underline]/tabs-list:border-transparent group-data-[variant=underline]/tabs-list:bg-transparent group-data-[variant=underline]/tabs-list:px-1 group-data-[variant=underline]/tabs-list:pb-2.5 group-data-[variant=underline]/tabs-list:shadow-none group-data-[variant=underline]/tabs-list:data-[state=active]:border-primary group-data-[variant=underline]/tabs-list:data-[state=active]:text-foreground";

    $pills = "group-data-[variant=pills]/tabs-list:rounded-full group-data-[variant=pills]/tabs-list:px-3 group-data-[variant=pills]/tabs-list:py-1 group-data-[variant=pills]/tabs-list:data-[state=active]:bg-primary group-data-[variant=pills]/tabs-list:data-[state=active]:text-primary-foreground";

    $classes = "$base $segmented $underline $pills";
@endphp

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
    {{ $attributes->twMerge($classes) }}
>
    {{ $slot }}
</button>
