<?php

// API metadata for the textarea component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Minimum height, padding and text size of the field.',
        ],
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'CSS color that brands the focus ring and text selection locally, overriding the default ring/primary tokens.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Initial text content rendered inside the textarea.',
        ],
    ],
];
