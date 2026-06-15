@props([
    'data' => [],       // ['YYYY-MM-DD' => int] (associative) OR a flat array of ints
    'levels' => null,   // optional ascending thresholds, e.g. [1, 3, 6, 9]; otherwise computed from max
])

@php
    // --- Normalise the data into an ordered list of ['date' => ?string, 'count' => int] cells ---
    $cells = [];
    $raw = (array) $data;

    if (empty($raw)) {
        // Deterministic demo data: ~17 weeks (119 days), a calm wave + weekday rhythm. No randomness.
        $days = 17 * 7;
        for ($i = 0; $i < $days; $i++) {
            $weekday = $i % 7;                       // 0..6
            $wave = (int) round(2.5 + 2.5 * sin($i / 9));     // 0..5 slow swell
            $weekend = ($weekday === 0 || $weekday === 6) ? -2 : 0;
            $count = max(0, $wave + ($i % 3) + $weekend);
            $cells[] = ['date' => null, 'count' => (int) $count];
        }
    } else {
        $isAssoc = array_keys($raw) !== range(0, count($raw) - 1);
        if ($isAssoc) {
            ksort($raw); // chronological by YYYY-MM-DD key
            foreach ($raw as $date => $count) {
                $cells[] = ['date' => (string) $date, 'count' => (int) $count];
            }
        } else {
            foreach (array_values($raw) as $count) {
                $cells[] = ['date' => null, 'count' => (int) $count];
            }
        }
    }

    // --- Level thresholds (1..4). Level 0 == zero/empty. ---
    $counts = array_map(fn ($c) => $c['count'], $cells);
    $maxCount = $counts ? max($counts) : 0;

    if (is_array($levels) && count($levels) >= 1) {
        $thresholds = array_values(array_map('intval', $levels));
        sort($thresholds);
        $thresholds = array_slice($thresholds, 0, 4);
    } else {
        // Quartile-ish thresholds derived from the max.
        $step = max(1, (int) ceil($maxCount / 4));
        $thresholds = [$step, $step * 2, $step * 3, $step * 4];
    }

    $levelOf = function (int $count) use ($thresholds): int {
        if ($count <= 0) {
            return 0;
        }
        $lvl = 1;
        foreach ($thresholds as $t) {
            if ($count >= $t) {
                $lvl = min(4, array_search($t, $thresholds, true) + 1);
            }
        }
        return $lvl;
    };

    // LITERAL class lookup per level (Tailwind needs literal class names to compile them).
    $cellClasses = [
        0 => 'bg-muted',
        1 => 'bg-emerald-200 dark:bg-emerald-900',
        2 => 'bg-emerald-400 dark:bg-emerald-700',
        3 => 'bg-emerald-600 dark:bg-emerald-500',
        4 => 'bg-emerald-800 dark:bg-emerald-300',
    ];

    // --- Lay out into 7 rows (weekdays) x N week-columns, filling top-to-bottom per column. ---
    $weekCount = (int) ceil(count($cells) / 7);
    $columns = array_fill(0, $weekCount, array_fill(0, 7, null));
    foreach ($cells as $i => $cell) {
        $col = intdiv($i, 7);
        $row = $i % 7;
        $columns[$col][$row] = $cell;
    }

    $weekdayLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $shownLabels = [1 => 'Mon', 3 => 'Wed', 5 => 'Fri']; // row index => label

    $total = array_sum($counts);
    $summary = count($cells).' days, '.$total.' total, peak '.$maxCount;
@endphp

<div
    data-slot="heatmap"
    role="group"
    aria-label="Activity heatmap: {{ $summary }}"
    {{ $attributes->twMerge('text-muted-foreground inline-flex flex-col gap-2 text-xs') }}
>
    <div class="flex gap-2">
        {{-- Weekday labels --}}
        <div class="grid grid-rows-7 gap-1" aria-hidden="true">
            @for ($r = 0; $r < 7; $r++)
                <div class="flex h-3 items-center leading-none">{{ $shownLabels[$r] ?? '' }}</div>
            @endfor
        </div>

        {{-- Week columns --}}
        <div class="flex gap-1">
            @foreach ($columns as $week)
                <div class="grid grid-rows-7 gap-1">
                    @foreach ($week as $r => $cell)
                        @php
                            $count = $cell['count'] ?? null;
                            $lvl = $count === null ? 0 : $levelOf($count);
                            $when = ($cell['date'] ?? null) ?: $weekdayLabels[$r];
                            $label = $count === null ? '' : $count.' on '.$when;
                        @endphp
                        @if ($cell === null)
                            <div class="size-3 rounded-sm" aria-hidden="true"></div>
                        @else
                            <div
                                @class(['size-3 rounded-sm', $cellClasses[$lvl]])
                                title="{{ $label }}"
                                aria-hidden="true"
                            ></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    {{-- Legend --}}
    <div class="flex items-center gap-1 self-end">
        <span>Less</span>
        @for ($l = 0; $l <= 4; $l++)
            <span @class(['size-3 rounded-sm', $cellClasses[$l]]) aria-hidden="true"></span>
        @endfor
        <span>More</span>
    </div>
</div>
