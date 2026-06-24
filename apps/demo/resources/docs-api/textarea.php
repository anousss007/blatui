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
        [
            'name' => 'rows',
            'type' => 'int',
            'description' => 'Initial number of visible text rows (the native rows attribute). Unset uses the size-based min-height.',
        ],
        [
            'name' => 'maxRows',
            'type' => 'int',
            'description' => 'Caps auto-growth at this many rows, then scrolls. When set, the field switches from native field-sizing-content auto-grow to an Alpine-driven height that shrinks and grows with the content. Unlimited (native auto-grow) when not set.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Initial text content rendered inside the textarea.',
        ],
    ],
];
