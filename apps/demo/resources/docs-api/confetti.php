<?php

// API metadata for the confetti component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'count',
            'type' => 'int',
            'default' => '80',
            'description' => 'Number of confetti particles spawned per burst.',
        ],
        [
            'name' => 'spread',
            'type' => 'number',
            'default' => '70',
            'description' => 'Horizontal spread of the burst — larger values fling particles farther from the origin.',
        ],
        [
            'name' => 'colors',
            'type' => 'array',
            'description' => 'Optional list of CSS colours cycled across the particles. Falls back to a built-in festive palette.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Trigger content that becomes the clickable element firing the burst. If omitted, a default "Celebrate" button is rendered.',
        ],
    ],

    'methods' => [
        [
            'name' => 'fire()',
            'description' => 'Spawns one confetti burst from the centre of the trigger. Exposed on the Alpine scope so it can be called from a slot child or via an external $refs handle. No-op under prefers-reduced-motion.',
        ],
    ],
];
