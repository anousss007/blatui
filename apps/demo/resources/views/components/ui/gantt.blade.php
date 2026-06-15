@props([
    'tasks' => [],          // [['name' => 'Design', 'start' => '2026-01-01', 'end' => '2026-01-10', 'progress' => 40, 'color' => 'bg-primary'], ...]
    'start' => null,        // overall range start 'YYYY-MM-DD' (defaults to min task start)
    'end' => null,          // overall range end 'YYYY-MM-DD' (defaults to max task end)
    'unit' => 'day',        // header bucket granularity: day | week | month
    'today' => null,        // override "today" for a stable demo; defaults to the real today
])

@php
    use Illuminate\Support\Carbon;

    // ── Normalise tasks ────────────────────────────────────────────────
    $rows = [];
    foreach ($tasks as $t) {
        if (empty($t['start']) || empty($t['end'])) {
            continue;
        }
        $rows[] = [
            'name'     => $t['name'] ?? '',
            'start'    => Carbon::parse($t['start'])->startOfDay(),
            'end'      => Carbon::parse($t['end'])->startOfDay(),
            'progress' => isset($t['progress']) ? max(0, min(100, (int) $t['progress'])) : null,
            'color'    => $t['color'] ?? 'bg-primary',
        ];
    }

    // ── Overall range (inclusive of the end day) ───────────────────────
    $rangeStart = $start ? Carbon::parse($start)->startOfDay() : null;
    $rangeEnd   = $end ? Carbon::parse($end)->startOfDay() : null;
    foreach ($rows as $r) {
        if (! $rangeStart || $r['start']->lt($rangeStart)) {
            $rangeStart = $r['start']->copy();
        }
        if (! $rangeEnd || $r['end']->gt($rangeEnd)) {
            $rangeEnd = $r['end']->copy();
        }
    }
    // Fallback so the component never divides by zero with no data.
    $rangeStart ??= Carbon::today();
    $rangeEnd ??= $rangeStart->copy()->addDays(7);

    // Total days the chart spans; +1 so the last day is fully drawn.
    // diffInDays can be a signed float in modern Carbon — floor to a whole count.
    $totalDays = max(1, (int) floor($rangeStart->diffInDays($rangeEnd)) + 1);

    // % of the timeline width occupied by one day — used for bar maths.
    $dayPct = 100 / $totalDays;

    // ── Header buckets ─────────────────────────────────────────────────
    // Each bucket: ['label' => '...', 'days' => N] so its column flexes by duration.
    $buckets = [];
    $cursor = $rangeStart->copy();
    if ($unit === 'month') {
        while ($cursor->lte($rangeEnd)) {
            $bucketEnd = $cursor->copy()->endOfMonth()->startOfDay();
            if ($bucketEnd->gt($rangeEnd)) {
                $bucketEnd = $rangeEnd->copy();
            }
            $buckets[] = ['label' => $cursor->isoFormat('MMM YYYY'), 'days' => (int) floor($cursor->diffInDays($bucketEnd)) + 1];
            $cursor = $bucketEnd->copy()->addDay();
        }
    } elseif ($unit === 'week') {
        while ($cursor->lte($rangeEnd)) {
            $bucketEnd = $cursor->copy()->addDays(6);
            if ($bucketEnd->gt($rangeEnd)) {
                $bucketEnd = $rangeEnd->copy();
            }
            $buckets[] = ['label' => $cursor->isoFormat('MMM D'), 'days' => (int) floor($cursor->diffInDays($bucketEnd)) + 1];
            $cursor = $bucketEnd->copy()->addDay();
        }
    } else { // day
        while ($cursor->lte($rangeEnd)) {
            $buckets[] = ['label' => $cursor->isoFormat('D'), 'sub' => $cursor->isoFormat('MMM'), 'days' => 1];
            $cursor->addDay();
        }
    }

    // Min px per day keeps long/short ranges legible and triggers horizontal scroll.
    $minDayPx = $unit === 'day' ? 40 : 16;
    $timelineMinPx = (int) ($totalDays * $minDayPx);

    // ── "Today" marker (only when inside the range) ────────────────────
    $todayDate = $today ? Carbon::parse($today)->startOfDay() : Carbon::today();
    $showToday = $todayDate->betweenIncluded($rangeStart, $rangeEnd);
    // Offset to the *middle* of today's column so the line reads as "now".
    $todayPct = $showToday ? ((int) floor($rangeStart->diffInDays($todayDate)) + 0.5) * $dayPct : 0;

    $labelWidth = '11rem'; // left task-name column
@endphp

<div
    data-slot="gantt"
    {{ $attributes->twMerge('bg-card text-card-foreground w-full overflow-hidden rounded-xl border text-sm') }}
>
    <div
        data-slot="gantt-scroll"
        tabindex="0" role="region" aria-label="Project timeline (scrollable)"
        class="focus-visible:ring-ring/50 w-full overflow-x-auto rounded-[inherit] outline-none focus-visible:ring-[3px]"
    >
        <table
            data-slot="gantt-table"
            class="w-full border-collapse"
            style="min-width: calc({{ $labelWidth }} + {{ $timelineMinPx }}px)"
        >
            <caption class="sr-only">
                Project timeline from {{ $rangeStart->isoFormat('LL') }} to {{ $rangeEnd->isoFormat('LL') }},
                {{ count($rows) }} {{ \Illuminate\Support\Str::plural('task', count($rows)) }}.
            </caption>

            <thead>
                <tr class="bg-muted/40 border-b">
                    <th
                        scope="col"
                        class="bg-muted/40 text-muted-foreground sticky start-0 z-10 px-4 py-2 text-start align-bottom text-xs font-medium"
                        style="width: {{ $labelWidth }}; min-width: {{ $labelWidth }}"
                    >Task</th>
                    @foreach ($buckets as $b)
                        <th
                            scope="col"
                            @class([
                                'text-muted-foreground border-s px-1 py-2 text-center align-bottom font-normal',
                                'text-xs' => $unit !== 'day',
                                'text-[11px] leading-tight' => $unit === 'day',
                            ])
                            style="width: {{ $b['days'] * $dayPct }}%"
                        >
                            @isset($b['sub'])
                                <span class="text-muted-foreground/60 block text-[9px] tracking-wide uppercase">{{ $b['sub'] }}</span>
                            @endisset
                            <span class="tabular-nums">{{ $b['label'] }}</span>
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $r)
                    @php
                        // Bar geometry as % of the timeline area (RTL-safe via logical inset).
                        $barOffset = (int) floor($rangeStart->diffInDays($r['start'])) * $dayPct;
                        $barDays   = (int) floor($r['start']->diffInDays($r['end'])) + 1; // inclusive
                        $barWidth  = $barDays * $dayPct;
                        $isMilestone = $barDays <= 1;
                        $dateLabel = $r['start']->isoFormat('MMM D') .
                            (($r['start']->isSameDay($r['end'])) ? '' : ' – ' . $r['end']->isoFormat('MMM D'));
                    @endphp
                    <tr data-slot="gantt-row" class="hover:bg-muted/30 group border-b transition-colors last:border-0">
                        <th
                            scope="row"
                            class="bg-card group-hover:bg-muted/30 sticky start-0 z-10 truncate px-4 py-2 text-start font-medium transition-colors"
                            style="width: {{ $labelWidth }}; min-width: {{ $labelWidth }}"
                            title="{{ $r['name'] }}"
                        >{{ $r['name'] }}</th>
                        <td class="border-s px-0 py-2" colspan="{{ count($buckets) }}">
                            <div data-slot="gantt-track" class="relative h-7" style="min-width: {{ $timelineMinPx }}px">
                                {{-- subtle grid baseline so bars read against the range --}}
                                <div class="bg-border/60 absolute inset-x-0 top-1/2 h-px -translate-y-1/2" aria-hidden="true"></div>

                                {{-- "Today" marker: drawn per-row so it stays aligned with the bars during scroll --}}
                                @if ($showToday)
                                    <div
                                        data-slot="gantt-today"
                                        class="bg-destructive/70 absolute inset-y-0 w-px"
                                        style="inset-inline-start: {{ $todayPct }}%"
                                        aria-hidden="true"
                                    ></div>
                                @endif

                                @if ($isMilestone)
                                    {{-- 1-day milestone → diamond marker, anchored at the day's centre --}}
                                    <div
                                        data-slot="gantt-milestone"
                                        class="ring-background absolute top-1/2 size-3 -translate-y-1/2 -translate-x-1/2 rotate-45 rounded-[2px] shadow-sm ring-2 {{ $r['color'] }}"
                                        style="inset-inline-start: calc({{ $barOffset + $dayPct / 2 }}% )"
                                        aria-hidden="true"
                                    ></div>
                                    <span class="absolute top-1/2 -translate-y-1/2 ps-2 text-xs whitespace-nowrap"
                                        style="inset-inline-start: calc({{ $barOffset + $dayPct / 2 }}% )">
                                        <span class="bg-foreground/5 text-foreground/80 rounded px-1 py-0.5">
                                            {{ $r['name'] }}<span class="sr-only">, milestone on {{ $dateLabel }}</span>
                                        </span>
                                    </span>
                                @else
                                    {{-- Bar: a solid colour band (the {{ $color }} token is a literal class,
                                         so Tailwind's JIT sees it). The unfilled remainder is dimmed by a
                                         neutral overlay, avoiding any runtime-built opacity classes. --}}
                                    <div
                                        data-slot="gantt-bar"
                                        class="ring-border absolute top-1/2 flex h-5 -translate-y-1/2 items-center justify-end overflow-hidden rounded-md ring-1 ring-inset {{ $r['color'] }}"
                                        style="inset-inline-start: {{ $barOffset }}%; width: {{ $barWidth }}%; min-width: 0.5rem"
                                    >
                                        {{-- Accessible text: the task name (which also shows in the sticky
                                             row header) plus dates / progress, read out as one label. --}}
                                        <span class="sr-only">{{ $r['name'] }}, {{ $dateLabel }}@if (! is_null($r['progress'])), {{ $r['progress'] }}% complete @endif</span>
                                        @if (! is_null($r['progress']))
                                            {{-- dim the part beyond progress with a neutral scrim so the
                                                 filled length conveys progress by position, not colour alone --}}
                                            <div
                                                data-slot="gantt-progress-remainder"
                                                class="bg-card/55 absolute inset-y-0 end-0"
                                                style="width: {{ 100 - $r['progress'] }}%"
                                                aria-hidden="true"
                                            ></div>
                                            {{-- % chip on a contrast-safe neutral backing (AA on any tone) --}}
                                            <span class="text-foreground bg-card/80 relative me-1 rounded px-1 text-[10px] font-semibold tabular-nums" aria-hidden="true">{{ $r['progress'] }}%</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-muted-foreground px-4 py-8 text-center" colspan="2">No tasks to display.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($showToday && count($rows))
        <div data-slot="gantt-legend" class="text-muted-foreground flex items-center gap-1.5 border-t px-4 py-1.5 text-xs">
            <span class="bg-destructive/70 inline-block h-3 w-px" aria-hidden="true"></span>
            Today · {{ $todayDate->isoFormat('MMM D, YYYY') }}
        </div>
    @endif
</div>
