<?php

// API metadata for the presence component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'status',
            'type' => 'string',
            'default' => "'online'",
            'options' => ['online', 'away', 'busy', 'offline'],
            'description' => 'The presence state, which sets the dot colour and the default status label.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Diameter of the status dot.',
        ],
        [
            'name' => 'pulse',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render an animated ping halo around the dot (only applied when status is online). Disabled under prefers-reduced-motion.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'description' => 'Override the status text. Defaults to a human label for the status (e.g. "Online"). Always announced to screen readers even when not visible.',
        ],
        [
            'name' => 'showLabel',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show the label text beside the dot. When false the label remains as sr-only text so the state is never conveyed by colour alone.',
        ],
    ],
];
