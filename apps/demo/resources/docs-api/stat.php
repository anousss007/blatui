<?php

// API metadata for the stat component.

return [
    'props' => [
        [
            'name' => 'label',
            'type' => 'string',
            'description' => 'The metric name shown in the top row (e.g. "Active Sessions").',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'The big KPI value. Falls back to the default slot when not set.',
        ],
        [
            'name' => 'change',
            'type' => 'string',
            'description' => 'The change text, e.g. "+12.5%" or "-3.2%". A leading +/- infers the trend direction when trend is not given.',
        ],
        [
            'name' => 'trend',
            'type' => 'string',
            'options' => ['up', 'down', 'neutral'],
            'description' => 'Direction of the change, controlling the icon and color. Inferred from the leading sign in change when omitted.',
        ],
        [
            'name' => 'icon',
            'type' => 'string',
            'description' => 'A lucide icon name (e.g. "dollar-sign") rendered in a muted tile next to the label.',
        ],
        [
            'name' => 'caption',
            'type' => 'string',
            'description' => 'Small muted caption shown next to the change, e.g. "vs last month".',
        ],
        [
            'name' => 'series',
            'type' => 'array',
            'description' => 'An array of numbers rendered as a corner sparkline (x-ui.sparkline), tinted to match the trend color.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Custom KPI value markup, used when the value prop is not set.',
        ],
        [
            'name' => 'leading',
            'description' => 'Custom content for the icon tile next to the label (overrides the icon prop).',
        ],
        [
            'name' => 'trailing',
            'description' => 'Custom content in the top-right corner, shown when no series sparkline is provided.',
        ],
    ],
];
