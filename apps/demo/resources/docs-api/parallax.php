<?php

// API metadata for the parallax component.

return [
    'props' => [
        [
            'name' => 'speed',
            'type' => 'number',
            'default' => '0.3',
            'description' => 'Depth factor: how far the content shifts relative to scroll. 0 locks it to the page (no effect); positive values lag the content (reads as "further away"); negative values move it with the scroll (reads as "closer"). Typical range -1 to 1.',
        ],
        [
            'name' => 'axis',
            'type' => 'string',
            'default' => "'y'",
            'options' => ['y', 'x'],
            'description' => 'Direction the content translates as the wrapper crosses the viewport: vertical (the usual) or horizontal.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The content to parallax. It stays in normal flow and fully readable; only a decorative transform is applied, and that transform is removed entirely under prefers-reduced-motion.',
        ],
    ],
];
