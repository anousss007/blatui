<?php

// API metadata for the gantt component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'tasks',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The rows to plot. Each task is drawn as a bar across the timeline; a one-day task renders as a diamond milestone instead.',
            'shape' => 'task',
        ],
        [
            'name' => 'start',
            'type' => 'string',
            'description' => 'Overall range start as "YYYY-MM-DD". Defaults to the earliest task start.',
        ],
        [
            'name' => 'end',
            'type' => 'string',
            'description' => 'Overall range end as "YYYY-MM-DD". Defaults to the latest task end.',
        ],
        [
            'name' => 'unit',
            'type' => 'string',
            'default' => "'day'",
            'options' => ['day', 'week', 'month'],
            'description' => 'Granularity of the header buckets above the timeline.',
        ],
        [
            'name' => 'today',
            'type' => 'string',
            'description' => 'Override the "today" marker date as "YYYY-MM-DD" (useful for stable demos). The vertical marker only shows when this date falls inside the range. Defaults to the real current day.',
        ],
    ],

    'shapes' => [
        'task' => [
            'label' => 'Each task',
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'description' => 'The task label shown in the sticky left column (and on the milestone marker).',
                ],
                [
                    'name' => 'start',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Task start date as "YYYY-MM-DD". Tasks missing a start or end are skipped.',
                ],
                [
                    'name' => 'end',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Task end date as "YYYY-MM-DD", inclusive. When equal to start the task renders as a diamond milestone.',
                ],
                [
                    'name' => 'progress',
                    'type' => 'int',
                    'description' => 'Completion percentage 0–100. Dims the unfilled remainder of the bar and shows a percentage chip. Omit for no progress fill.',
                ],
                [
                    'name' => 'color',
                    'type' => 'string',
                    'default' => "'bg-primary'",
                    'description' => 'A literal Tailwind background class for the bar or milestone, e.g. "bg-sky-500". Must be a static class so the JIT compiler can see it.',
                ],
            ],
        ],
    ],
];
