<?php

// API metadata for the collapsible component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the content is expanded on first render.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The disclosure markup. Place an <x-ui.collapsible-trigger> (the toggle button) and an <x-ui.collapsible-content> (the panel shown when open) inside; always-visible content can sit between them.',
        ],
    ],
];
