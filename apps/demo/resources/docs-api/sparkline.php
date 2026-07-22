<?php

// API metadata for the sparkline component.

return [
    'props' => [
        [
            'name' => 'data',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The series of numbers to plot. Needs at least two points to draw a trend line; the path scales to the data\'s own min/max.',
        ],
        [
            'name' => 'width',
            'type' => 'int',
            'default' => '100',
            'description' => 'SVG width in pixels and the viewBox width.',
        ],
        [
            'name' => 'height',
            'type' => 'int',
            'default' => '28',
            'description' => 'SVG height in pixels and the viewBox height.',
        ],
        [
            'name' => 'area',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Fill the area under the line with a faint tint of the current color.',
        ],
        [
            'name' => 'strokeWidth',
            'type' => 'number',
            'default' => '1.5',
            'description' => 'Line thickness. Also used as inner padding so the stroke stays inside the viewBox.',
        ],
        [
            'name' => 'ariaLabel',
            'type' => 'string',
            'default' => "'Trend'",
            'description' => 'Accessible name for the SVG (role="img" aria-label).',
        ],
    ],
];
