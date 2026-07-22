<?php

// API metadata for the container component.

return [
    'props' => [
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'lg'",
            'options' => ['sm', 'md', 'lg', 'xl', 'prose', 'full'],
            'description' => 'Maximum content width: sm (3xl), md (5xl), lg (6xl), xl (7xl), prose (optimal reading measure), or full (no cap). The container is centered with responsive horizontal padding.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The page content. It is centered horizontally and width-capped to the chosen size.',
        ],
    ],
];
