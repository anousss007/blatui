<?php

// API metadata for the scheduler component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'events',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The events to place on the grid. Each event is positioned by its day column and start/end time; overlapping events in a column split into side-by-side lanes.',
            'shape' => 'event',
        ],
        [
            'name' => 'days',
            'type' => 'string[]',
            'description' => 'Column header labels. Defaults to Mon–Sun in week view, or a single "Day" column in day view.',
        ],
        [
            'name' => 'startHour',
            'type' => 'int',
            'default' => '8',
            'description' => 'First hour shown in the time gutter (0–24). Events before this are clamped or dropped.',
        ],
        [
            'name' => 'endHour',
            'type' => 'int',
            'default' => '18',
            'description' => 'Last hour shown in the time gutter (0–24), clamped to at least startHour + 1.',
        ],
        [
            'name' => 'view',
            'type' => 'string',
            'default' => "'week'",
            'options' => ['week', 'day'],
            'description' => 'Layout mode. In day view a date maps to the single column; in week view dates map to their weekday.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Schedule'",
            'description' => 'Accessible name for the scrollable grid region.',
        ],
    ],

    'shapes' => [
        'event' => [
            'label' => 'Each event',
            'fields' => [
                [
                    'name' => 'title',
                    'type' => 'string',
                    'default' => "'Event'",
                    'description' => 'The event label shown in the block and read out as its accessible name.',
                ],
                [
                    'name' => 'day',
                    'type' => 'int|string',
                    'description' => 'Which column the event belongs to: an integer 0-based index, or a "YYYY-MM-DD" date mapped to its weekday (week view) or column 0 (day view).',
                ],
                [
                    'name' => 'start',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Start time as "HH:MM" (24-hour). Events with an unparseable or non-positive duration are dropped.',
                ],
                [
                    'name' => 'end',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'End time as "HH:MM" (24-hour). Must be later than start.',
                ],
                [
                    'name' => 'color',
                    'type' => 'string',
                    'options' => ['primary', 'sky', 'emerald', 'amber', 'violet', 'rose'],
                    'description' => 'Tone for the event block. When omitted, a per-column tone is assigned so adjacent events stay distinct.',
                ],
            ],
        ],
    ],
];
