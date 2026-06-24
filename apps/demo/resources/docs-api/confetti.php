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
        [
            'name' => 'direction',
            'type' => 'number',
            'description' => 'Aim the burst, in degrees (0 = right, 90 = up, 180 = left, 270 = down). Omit for a full 360° fan.',
        ],
        [
            'name' => 'spreadArc',
            'type' => 'number',
            'default' => '90',
            'description' => 'When direction is set, the arc width (in degrees) the particles fan across.',
        ],
        [
            'name' => 'fullscreen',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Rain confetti down from across the top edge of the viewport instead of bursting from the trigger.',
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
