<?php

// API metadata for the border-beam component.

return [
    'props' => [
        [
            'name' => 'duration',
            'type' => 'number',
            'default' => '6',
            'description' => 'Seconds for one full revolution of the beam around the border. Lower values make the beam travel faster.',
        ],
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'The beam highlight color (any CSS color or custom property). Defaults to the primary theme token.',
        ],
        [
            'name' => 'size',
            'type' => 'int',
            'default' => '2',
            'description' => 'Thickness of the border and beam ring, in pixels.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The card content, rendered on the card background above the animated ring so the beam peeks out around it.',
        ],
    ],
];
