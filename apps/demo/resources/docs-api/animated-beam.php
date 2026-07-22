<?php

// API metadata for the animated-beam component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'from',
            'type' => 'string',
            'required' => true,
            'description' => 'CSS selector (queried within this component) for the start element. Give your start node an id or class and pass that selector here.',
        ],
        [
            'name' => 'to',
            'type' => 'string',
            'required' => true,
            'description' => 'CSS selector (queried within this component) for the end element the beam connects to.',
        ],
        [
            'name' => 'curvature',
            'type' => 'number',
            'default' => '0',
            'description' => 'Vertical bow of the connecting path in pixels. 0 draws a straight line; positive or negative values bend the path up or down.',
        ],
        [
            'name' => 'duration',
            'type' => 'number',
            'default' => '3',
            'description' => 'Seconds for one full pass of the travelling light along the path.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The endpoint nodes (e.g. icon tiles). Place the elements matched by the from/to selectors here; the beam is drawn behind them.',
        ],
    ],
];
