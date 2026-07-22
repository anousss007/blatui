@props([
    'events' => [],         // [['title','day'=>0..6 or 'YYYY-MM-DD','start'=>'HH:MM','end'=>'HH:MM','color'?], ...]
    'days' => null,         // array of column labels; defaults to Mon–Sun (week) or single day
    'startHour' => 8,       // first hour shown in the gutter (0–24)
    'endHour' => 18,        // last hour shown in the gutter (0–24)
    'view' => 'week',       // 'week' | 'day'
    'label' => 'Schedule',  // accessible name for the grid region
])

@php
    $startHour = max(0, min(24, (int) $startHour));
    $endHour   = max($startHour + 1, min(24, (int) $endHour));
    $hours     = range($startHour, $endHour);
    $span      = $endHour - $startHour;            // total hours shown
    $rowRem    = 3.5;                                // height of one hour row, in rem
    $bodyRem   = $span * $rowRem;                    // total scrollable body height

    // Resolve the column labels. For week view default to Mon–Sun; day view to a single column.
    if (is_array($days) && count($days)) {
        $columns = array_values($days);
    } elseif ($view === 'day') {
        $columns = ['Day'];
    } else {
        $columns = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    }
    $colCount = count($columns);

    // Map a 'HH:MM' string to fractional hours (e.g. '08:30' => 8.5). Returns null if unparseable.
    $toHours = function ($t) {
        if (!is_string($t) || !preg_match('/^(\d{1,2}):(\d{2})$/', trim($t), $m)) {
            return null;
        }
        return (int) $m[1] + ((int) $m[2]) / 60;
    };

    // Format fractional hours back to a readable 'h:mm AM/PM'.
    $fmt = function ($h) {
        $hh = (int) floor($h);
        $mm = (int) round(($h - $hh) * 60);
        if ($mm === 60) { $hh++; $mm = 0; }
        $period = $hh >= 12 ? 'PM' : 'AM';
        $h12 = $hh % 12 === 0 ? 12 : $hh % 12;
        return $mm === 0 ? "{$h12} {$period}" : sprintf('%d:%02d %s', $h12, $mm, $period);
    };

    // Resolve an event's day to a 0-based column index.
    //  - integer 0..6 indexes directly into $columns
    //  - 'YYYY-MM-DD' maps to weekday Mon=0..Sun=6 (week view) or column 0 (day view)
    $colOf = function ($day) use ($colCount, $view) {
        if (is_int($day) || (is_string($day) && ctype_digit($day))) {
            return ((int) $day) % max(1, $colCount);
        }
        if (is_string($day) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $day)) {
            if ($view === 'day' || $colCount === 1) {
                return 0;
            }
            // PHP date('N'): Mon=1..Sun=7 -> 0..6
            return ((int) date('N', strtotime($day)) - 1) % $colCount;
        }
        return 0;
    };

    // Per-column tone palette so adjacent events without an explicit colour stay distinct.
    // Each tone pairs a soft fill with a start-border accent that reads as a time band.
    $tones = [
        'primary' => 'bg-primary/10 border-primary text-foreground',
        'sky'     => 'bg-sky-500/10 border-sky-500 text-foreground',
        'emerald' => 'bg-emerald-500/10 border-emerald-500 text-foreground',
        'amber'   => 'bg-amber-500/10 border-amber-500 text-foreground',
        'violet'  => 'bg-violet-500/10 border-violet-500 text-foreground',
        'rose'    => 'bg-rose-500/10 border-rose-500 text-foreground',
    ];

    // Pre-compute the placed events: column index, top/height in rem, label, time range.
    // Events fully outside [startHour, endHour] are dropped; partial ones are clamped.
    $placed = [];
    foreach ($events as $ev) {
        $s = $toHours($ev['start'] ?? null);
        $e = $toHours($ev['end'] ?? null);
        if ($s === null || $e === null || $e <= $s) {
            continue;
        }
        $cs = max($startHour, $s);
        $ce = min($endHour, $e);
        if ($ce <= $cs) {
            continue;
        }
        $placed[] = [
            'col'     => $colOf($ev['day'] ?? 0),
            'top'     => ($cs - $startHour) * $rowRem,
            'height'  => ($ce - $cs) * $rowRem,
            'title'   => (string) ($ev['title'] ?? 'Event'),
            'range'   => $fmt($s) . ' – ' . $fmt($e),
            'tone'    => isset($ev['color'], $tones[$ev['color']]) ? $tones[$ev['color']] : null,
        ];
    }

    // Group placed events by column, then assign overlapping events to side-by-side lanes
    // so they narrow instead of covering each other (basic stacking).
    $byCol = array_fill(0, $colCount, []);
    foreach ($placed as $p) {
        $byCol[$p['col']][] = $p;
    }
@endphp

<div
    data-slot="scheduler"
    {{ $attributes->twMerge('bg-card text-card-foreground w-full overflow-hidden rounded-xl border shadow-sm') }}
>
    <div role="group" aria-label="{{ $label }}" class="flex flex-col">
        {{-- Header row: empty gutter cell + one labelled cell per column. --}}
        <div class="bg-muted/40 flex border-b">
            <div class="text-muted-foreground w-14 shrink-0 border-e px-2 py-2 text-end text-[11px] font-medium">
                <span class="sr-only">Time</span>
            </div>
            @foreach ($columns as $col)
                <div class="text-foreground flex-1 px-2 py-2 text-center text-sm font-semibold">
                    {{ $col }}
                </div>
            @endforeach
        </div>

        {{-- Scrollable body: hour gutter + day columns with absolutely positioned events. --}}
        <div
            tabindex="0"
            class="focus-visible:ring-ring/50 max-h-[28rem] overflow-y-auto outline-none focus-visible:ring-2 focus-visible:ring-inset"
            aria-label="{{ $label }} grid, scrollable"
        >
            <div class="flex" style="height: {{ $bodyRem }}rem;">
                {{-- Left hour gutter: one label per hour boundary. --}}
                <div class="text-muted-foreground relative w-14 shrink-0 border-e text-[11px]" aria-hidden="true">
                    @foreach ($hours as $i => $h)
                        @if ($i < count($hours) - 1)
                            <div class="flex items-start justify-end px-2 pt-0.5" style="height: {{ $rowRem }}rem;">
                                {{ $fmt($h) }}
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Day columns. --}}
                @foreach ($columns as $colIndex => $colLabel)
                    @php
                        $colEvents = $byCol[$colIndex] ?? [];
                        // Assign lanes: an event reuses a lane whose last event ends at/before it starts.
                        $laneEnds = [];
                        foreach ($colEvents as $k => $ce2) {
                            $start = $ce2['top'];
                            $lane = null;
                            foreach ($laneEnds as $li => $end) {
                                if ($start >= $end - 0.001) { $lane = $li; break; }
                            }
                            if ($lane === null) { $lane = count($laneEnds); $laneEnds[$lane] = 0; }
                            $colEvents[$k]['lane'] = $lane;
                            $laneEnds[$lane] = $ce2['top'] + $ce2['height'];
                        }
                        $laneCount = max(1, count($laneEnds));
                    @endphp
                    <div
                        @class([
                            'relative flex-1 border-e last:border-e-0',
                            'bg-muted/10' => $loop->odd,
                        ])
                    >
                        {{-- Horizontal hour gridlines. --}}
                        @foreach ($hours as $i => $h)
                            @if ($i < count($hours) - 1)
                                <div class="bg-muted/40 absolute inset-x-0 h-px" style="top: {{ $i * $rowRem }}rem;" aria-hidden="true"></div>
                            @endif
                        @endforeach

                        {{-- Events positioned by start/end time. --}}
                        @foreach ($colEvents as $ev)
                            @php
                                $tone = $ev['tone'] ?? $tones[array_keys($tones)[$colIndex % count($tones)]];
                                $widthPct = 100 / $laneCount;
                                $leftPct = $ev['lane'] * $widthPct;
                            @endphp
                            <div
                                role="note"
                                aria-label="{{ $ev['title'] }}, {{ $ev['range'] }}"
                                title="{{ $ev['title'] }} · {{ $ev['range'] }}"
                                @class(['absolute overflow-hidden rounded-md border-s-2 px-2 py-1 text-start', $tone])
                                style="top: {{ $ev['top'] }}rem; height: {{ max(1.25, $ev['height']) }}rem; inset-inline-start: calc({{ $leftPct }}% + 0.125rem); width: calc({{ $widthPct }}% - 0.25rem);"
                            >
                                <p class="truncate text-xs font-semibold leading-tight">{{ $ev['title'] }}</p>
                                <p class="truncate text-[11px] leading-tight opacity-80">{{ $ev['range'] }}</p>
                                <span class="sr-only">from {{ $ev['range'] }}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
