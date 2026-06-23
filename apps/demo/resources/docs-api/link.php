<?php

// API metadata for the link component.

return [
    'props' => [
        [
            'name' => 'href',
            'type' => 'string',
            'default' => "'#'",
            'description' => 'The destination URL for the anchor.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'muted', 'subtle'],
            'description' => 'Visual style: default is a primary-colored underlined link, muted is low-contrast, subtle has no underline until hover.',
        ],
        [
            'name' => 'external',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Open in a new tab. Adds target="_blank" with rel="noopener noreferrer" and an "(opens in new tab)" hint for screen readers.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The link text or inline content.',
        ],
    ],
];
