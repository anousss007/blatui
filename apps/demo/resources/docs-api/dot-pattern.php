<?php

// API metadata for the dot-pattern component.

return [
    'props' => [
        [
            'name' => 'size',
            'type' => 'number',
            'default' => '1',
            'description' => 'Diameter of each dot in pixels.',
        ],
        [
            'name' => 'gap',
            'type' => 'number',
            'default' => '16',
            'description' => 'Spacing between dots in pixels (the grid cell size).',
        ],
        [
            'name' => 'mask',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Radially fade the dots to transparent toward the edges so the grid is densest in the centre.',
        ],
    ],
];
