@props([
    'icon' => null,      // any lucide icon name (e.g. home, search, bell)
    'label' => null,     // visible text label rendered beneath the icon
    'href' => '#',
    'active' => false,
    'badge' => null,     // true => dot; string/number => count pill on the icon corner
])

@php
    // Render as a link when an href is given, otherwise a button (action tabs).
    $isLink = filled($href);
    $tag = $isLink ? 'a' : 'button';

    $base = 'group relative flex flex-1 flex-col items-center justify-center gap-1 px-1 text-center outline-none transition-colors focus-visible:ring-ring/50 focus-visible:ring-[3px] focus-visible:ring-inset';

    $state = $active
        ? 'text-primary'
        : 'text-muted-foreground hover:text-foreground';

    $hasDot = $badge === true;
    $hasCount = filled($badge) && $badge !== true;
@endphp

<{{ $tag }}
    data-slot="bottom-navigation-item"
    @if ($isLink)
        href="{{ $href }}"
        @if ($active) aria-current="page" @endif
    @else
        type="button"
        @if ($active) aria-current="page" @endif
    @endif
    {{ $attributes->twMerge($base.' '.$state) }}
>
    @if ($icon)
        <span class="relative inline-flex">
            <x-dynamic-component :component="'lucide-'.$icon" class="size-5 shrink-0" aria-hidden="true" />

            @if ($hasDot)
                <span class="bg-destructive absolute end-0 top-0 size-2 -translate-y-1/2 translate-x-1/2 rounded-full ring-2 ring-background rtl:-translate-x-1/2"></span>
                <span class="sr-only">(new)</span>
            @elseif ($hasCount)
                <span class="bg-destructive text-destructive-foreground absolute end-0 top-0 inline-flex h-4 min-w-4 -translate-y-1/2 translate-x-1/2 items-center justify-center rounded-full px-1 text-[0.625rem] font-medium leading-none ring-2 ring-background rtl:-translate-x-1/2">{{ $badge }}</span>
            @endif
        </span>
    @endif

    @if (filled($label))
        <span class="text-xs leading-none font-medium">{{ $label }}</span>
    @endif

    {{ $slot }}
</{{ $tag }}>
