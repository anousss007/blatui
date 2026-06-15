@props([
    'title' => null,       // optional heading (font-semibold)
    'description' => null, // optional supporting text (muted)
    'icon' => null,        // optional lucide icon name, rendered in a muted tile
    'colSpan' => 1,        // 1 | 2 | 3 — columns this cell spans at lg+
    'rowSpan' => 1,        // 1 | 2 — rows this cell spans
])

@php
    // Tailwind v4 only generates LITERAL class names, so spans map to spelled-out
    // classes here (never interpolated). colSpan 1 / rowSpan 1 add nothing.
    $colSpanClasses = [
        1 => '',
        2 => 'lg:col-span-2',
        3 => 'lg:col-span-3',
    ];

    $rowSpanClasses = [
        1 => '',
        2 => 'row-span-2',
    ];

    $span = trim(($colSpanClasses[(int) $colSpan] ?? '').' '.($rowSpanClasses[(int) $rowSpan] ?? ''));
@endphp

<div
    data-slot="bento-item"
    {{ $attributes->twMerge('bg-card text-card-foreground flex flex-col gap-3 rounded-xl border p-6 transition-colors hover:bg-muted/40 '.$span) }}
>
    @if ($icon || isset($leading))
        <span class="bg-muted text-muted-foreground flex size-10 shrink-0 items-center justify-center rounded-lg" aria-hidden="true">
            @if (isset($leading))
                {{ $leading }}
            @else
                <x-dynamic-component :component="'lucide-'.$icon" class="size-5" />
            @endif
        </span>
    @endif

    @if ($title !== null)
        <h3 class="font-semibold leading-none">{{ $title }}</h3>
    @endif

    @if ($description !== null)
        <p class="text-muted-foreground text-sm">{{ $description }}</p>
    @endif

    {{ $slot }}
</div>
