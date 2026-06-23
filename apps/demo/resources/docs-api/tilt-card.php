<?php

// API metadata for the tilt-card component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'max',
            'type' => 'number',
            'default' => '12',
            'description' => 'Maximum 3D tilt in degrees on each axis as the card rotates toward the cursor.',
        ],
        [
            'name' => 'scale',
            'type' => 'number',
            'default' => '1.03',
            'description' => 'How much the card scales up while the pointer is over it (1 = no zoom).',
        ],
        [
            'name' => 'glare',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show a pointer-following highlight overlay (a soft white radial glare) across the card surface.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The card content that tilts in 3D. The inner card surface carries the border, background and rounding.',
        ],
    ],
];
