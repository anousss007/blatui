@props([
    'label' => null,     // top-row label text (text element)
    'value' => null,     // the big KPI value
    'change' => null,    // the change text, e.g. "+12.5%" or "-3.2%"
    'trend' => null,     // up | down | neutral — inferred from a leading +/- in $change when null
    'icon' => null,      // lucide icon name (e.g. "dollar-sign") rendered in a muted tile
    'caption' => null,   // small caption next to the change, e.g. "vs last month"
    'series' => null,    // array of numbers — renders a sparkline (x-ui.sparkline) in the corner
])

@php
    // Infer the trend direction from a leading sign in $change when not given explicitly.
    $t = $trend;
    if ($t === null && is_string($change)) {
        $first = ltrim($change);
        if (str_starts_with($first, '+')) {
            $t = 'up';
        } elseif (str_starts_with($first, '-') || str_starts_with($first, "\u{2212}")) {
            $t = 'down';
        }
    }
    $t = in_array($t, ['up', 'down', 'neutral'], true) ? $t : 'neutral';

    // Semantic colours — meaning is ALSO carried by the icon + the sign in $change text,
    // so colour is never the sole signal (axe-clean).
    $trendColor = [
        'up' => 'text-emerald-700 dark:text-emerald-400',
        'down' => 'text-destructive',
        'neutral' => 'text-muted-foreground',
    ][$t];

    $trendWord = ['up' => 'Increase', 'down' => 'Decrease', 'neutral' => 'No change'][$t];

    $hasSeries = is_array($series) && count($series) > 0;
@endphp

<div
    data-slot="stat"
    {{ $attributes->twMerge('bg-card text-card-foreground flex flex-col gap-3 rounded-xl border p-6 shadow-sm') }}
>
    <div class="flex items-start justify-between gap-4">
        <div class="flex items-center gap-3">
            @if ($icon || isset($leading))
                <span class="bg-muted text-muted-foreground flex size-9 shrink-0 items-center justify-center rounded-lg" aria-hidden="true">
                    @if (isset($leading))
                        {{ $leading }}
                    @else
                        <x-dynamic-component :component="'lucide-'.$icon" class="size-4" />
                    @endif
                </span>
            @endif

            @if ($label !== null)
                <span class="text-muted-foreground text-sm font-medium">
                    {{ $label }}
                </span>
            @endif
        </div>

        @if ($hasSeries)
            <x-ui.sparkline
                :data="$series"
                :width="80"
                :height="28"
                :class="$trendColor.' mt-0.5 shrink-0'"
                :ariaLabel="($label ? $label.' ' : '').'trend'"
            />
        @elseif (isset($trailing))
            <div class="mt-0.5 shrink-0">{{ $trailing }}</div>
        @endif
    </div>

    <div class="text-2xl font-semibold tabular-nums sm:text-3xl">
        {{ $value ?? $slot }}
    </div>

    @if ($change !== null || $caption !== null)
        <div class="flex items-center gap-1.5 text-sm">
            @if ($change !== null)
                <span @class(['inline-flex items-center gap-1 font-medium', $trendColor])>
                    @if ($t === 'up')
                        <x-lucide-trending-up class="size-4" aria-hidden="true" />
                    @elseif ($t === 'down')
                        <x-lucide-trending-down class="size-4" aria-hidden="true" />
                    @endif
                    <span class="sr-only">{{ $trendWord }}:</span>
                    <span class="tabular-nums">{{ $change }}</span>
                </span>
            @endif

            @if ($caption !== null)
                <span class="text-muted-foreground">{{ $caption }}</span>
            @endif
        </div>
    @endif
</div>
