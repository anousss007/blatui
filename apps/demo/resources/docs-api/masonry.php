<?php

// API metadata for the masonry component.

return [
    'props' => [
        [
            'name' => 'columns',
            'type' => 'int',
            'default' => '3',
            'options' => ['1', '2', '3', '4', '5', '6'],
            'description' => 'Number of columns at the largest breakpoint (1-6). Lower counts are used progressively at smaller breakpoints so the grid reflows responsively.',
        ],
        [
            'name' => 'gap',
            'type' => 'string',
            'default' => "'4'",
            'options' => ['0', '1', '2', '3', '4', '6', '8'],
            'description' => 'Spacing token applied as both the column-gap and the bottom margin between items, keeping horizontal and vertical rhythm equal.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The tiles. Drop any direct children in — each is automatically given break-inside-avoid (so a tile never splits across columns) and a bottom margin. No per-item classes needed.',
        ],
    ],
];
