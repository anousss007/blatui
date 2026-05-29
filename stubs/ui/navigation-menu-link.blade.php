@props([
    'href' => '#',
    'active' => false,
])

<a
    href="{{ $href }}"
    data-slot="navigation-menu-link"
    @if ($active) data-active="true" @endif
    {{ $attributes->twMerge("data-[active=true]:focus:bg-accent data-[active=true]:hover:bg-accent data-[active=true]:bg-accent/50 data-[active=true]:text-accent-foreground hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground [&_svg:not([class*='text-'])]:text-muted-foreground flex flex-col gap-1 rounded-sm p-2 text-sm transition-all outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px] [&_svg:not([class*='size-'])]:size-4") }}
>{{ $slot }}</a>
