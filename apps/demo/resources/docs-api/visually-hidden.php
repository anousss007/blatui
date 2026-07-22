<?php

// API metadata for the visually-hidden component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'as',
            'type' => 'string',
            'default' => "'span'",
            'description' => 'The HTML tag to render. Use a block-level tag (e.g. div) when the hidden content needs block semantics.',
        ],
        [
            'name' => 'focusable',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'When true the element un-hides itself on focus (the standard skip-link reveal). Use it for a "Skip to content" link that appears only when tabbed to.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The content to hide visually while keeping it available to assistive technology.',
        ],
    ],
];
