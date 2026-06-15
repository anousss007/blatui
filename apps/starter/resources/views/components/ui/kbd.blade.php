@php
    // `aria-label` is prohibited on <kbd> (no naming role). If one is passed (e.g. to spell out a
    // symbol like ⌘ for screen readers), render it as visually-hidden text instead.
    $srLabel = $attributes->get('aria-label');
    $attributes = $attributes->except('aria-label');
@endphp

<kbd
    data-slot="kbd"
    {{ $attributes->twMerge("bg-muted text-muted-foreground pointer-events-none inline-flex h-5 w-fit min-w-5 items-center justify-center gap-1 rounded-sm px-1 font-sans text-xs font-medium select-none [&_svg:not([class*='size-'])]:size-3 [[data-slot=tooltip-content]_&]:bg-background/20 [[data-slot=tooltip-content]_&]:text-background dark:[[data-slot=tooltip-content]_&]:bg-background/10") }}
>@if ($srLabel)<span class="sr-only">{{ $srLabel }}</span>@endif{{ $slot }}</kbd>
