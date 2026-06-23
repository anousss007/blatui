<?php

// API metadata for the card component.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'sectioned'],
            'description' => 'default is a simple padded box for free-form content. sectioned removes horizontal padding and stacks card-header / card-content / card-footer parts (each supplies its own padding).',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Card content. With the default variant put anything here directly; with the sectioned variant compose the card-* sub-parts below.',
        ],
        [
            'name' => 'x-ui.card-header',
            'description' => 'Top section holding the title, description, and optional action. Use with the sectioned variant.',
        ],
        [
            'name' => 'x-ui.card-title',
            'description' => 'The card heading text, placed inside card-header.',
        ],
        [
            'name' => 'x-ui.card-description',
            'description' => 'Muted supporting text under the title, placed inside card-header.',
        ],
        [
            'name' => 'x-ui.card-action',
            'description' => 'Top-right action area within card-header (e.g. a menu button or link).',
        ],
        [
            'name' => 'x-ui.card-content',
            'description' => 'The main body of a sectioned card.',
        ],
        [
            'name' => 'x-ui.card-footer',
            'description' => 'Bottom section for actions such as buttons.',
        ],
    ],
];
