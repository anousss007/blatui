<?php

// API metadata for the countdown component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'to',
            'type' => 'string',
            'required' => true,
            'description' => 'The target date/time to count down to. Anything Carbon can parse (e.g. "2026-12-31 18:00" or now()->addDays(7)). Resolved to a millisecond epoch on the server so the countdown is timezone-safe.',
        ],
        [
            'name' => 'expired',
            'type' => 'string',
            'default' => "'Expired'",
            'description' => 'Text shown once the target has passed. Overridden by the default slot when one is provided.',
        ],
        [
            'name' => 'labels',
            'type' => 'array',
            'default' => "['days' => 'Days', 'hours' => 'Hrs', 'minutes' => 'Min', 'seconds' => 'Sec']",
            'description' => 'The unit captions under each number, keyed by days, hours, minutes and seconds.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Custom content shown when the countdown has expired, in place of the "expired" text.',
        ],
    ],
];
