@php
    // Mix of multi-day tasks and single-day milestones (rendered as diamonds).
    $tasks = [
        ['name' => 'Kickoff',         'start' => '2026-07-01', 'end' => '2026-07-01', 'color' => 'bg-emerald-500'], // milestone
        ['name' => 'Research',        'start' => '2026-07-01', 'end' => '2026-07-07', 'progress' => 100],
        ['name' => 'Prototype',       'start' => '2026-07-06', 'end' => '2026-07-15', 'progress' => 70,  'color' => 'bg-violet-500'],
        ['name' => 'Design review',   'start' => '2026-07-15', 'end' => '2026-07-15', 'color' => 'bg-amber-500'],  // milestone
        ['name' => 'Build',           'start' => '2026-07-16', 'end' => '2026-07-30', 'progress' => 30,  'color' => 'bg-sky-500'],
        ['name' => 'Beta release',    'start' => '2026-07-31', 'end' => '2026-07-31', 'color' => 'bg-rose-500'],   // milestone
    ];
@endphp

<x-ui.gantt :tasks="$tasks" start="2026-07-01" end="2026-07-31" unit="week" today="2026-07-14" class="max-w-3xl" />
