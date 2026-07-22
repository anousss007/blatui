<?php

// API metadata for the grid-pattern component.

return [
    'props' => [
        [
            'name' => 'gap',
            'type' => 'number',
            'default' => '24',
            'description' => 'Cell size in pixels (the grid spacing).',
        ],
        [
            'name' => 'lineWidth',
            'type' => 'number',
            'default' => '1',
            'description' => 'Grid line thickness in pixels.',
        ],
        [
            'name' => 'mask',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Radially fade the grid to transparent toward the edges so it dissolves at the container boundary.',
        ],
    ],
];
