<?php

// API metadata for the toggle component.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'outline'],
            'description' => 'Visual style of the toggle button.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'sm', 'lg'],
            'description' => 'Control size.',
        ],
        [
            'name' => 'pressed',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Initial pressed (on) state. The component manages the toggled state internally after that.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable the toggle.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The toggle content, typically an icon and/or a short label.',
        ],
    ],
];
