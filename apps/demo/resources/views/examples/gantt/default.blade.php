@php
    $tasks = [
        ['name' => 'Discovery',     'start' => '2026-06-01', 'end' => '2026-06-05', 'progress' => 100],
        ['name' => 'Design',        'start' => '2026-06-04', 'end' => '2026-06-12', 'progress' => 80,  'color' => 'bg-violet-500'],
        ['name' => 'Frontend',      'start' => '2026-06-10', 'end' => '2026-06-22', 'progress' => 55],
        ['name' => 'Backend',       'start' => '2026-06-11', 'end' => '2026-06-24', 'progress' => 40,  'color' => 'bg-sky-500'],
        ['name' => 'QA & testing',  'start' => '2026-06-20', 'end' => '2026-06-28', 'progress' => 10,  'color' => 'bg-amber-500'],
        ['name' => 'Launch',        'start' => '2026-06-27', 'end' => '2026-06-30', 'progress' => 0,   'color' => 'bg-emerald-500'],
    ];
@endphp

<x-ui.gantt :tasks="$tasks" unit="week" today="2026-06-15" class="max-w-3xl" />
