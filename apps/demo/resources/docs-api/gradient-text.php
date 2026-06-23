<?php

// API metadata for the gradient-text component.

return [
    'props' => [
        [
            'name' => 'preset',
            'type' => 'string',
            'options' => ['brand', 'sunset', 'ocean', 'candy', 'gold', 'aurora', 'flamingo', 'mint'],
            'description' => 'A named gradient palette. Defaults to "brand" when no preset and no explicit from/to are given. Explicit from/to override the preset.',
        ],
        [
            'name' => 'from',
            'type' => 'string',
            'description' => 'The starting gradient color stop (any CSS color). Setting this (or to) switches to a custom gradient and ignores the preset.',
        ],
        [
            'name' => 'via',
            'type' => 'string',
            'description' => 'An optional middle gradient color stop. Overrides the preset\'s middle stop when set; omitted entirely when empty.',
        ],
        [
            'name' => 'to',
            'type' => 'string',
            'description' => 'The ending gradient color stop (any CSS color). Falls back to the from color when only from is given.',
        ],
        [
            'name' => 'animate',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Animates a looping shimmer by sliding the background position. Automatically disabled under prefers-reduced-motion.',
        ],
        [
            'name' => 'as',
            'type' => 'string',
            'default' => "'span'",
            'description' => 'The HTML tag to render. Defaults to span so it composes inside headings and other text; pass a block tag like "h1" when used standalone.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The text to paint with the gradient. It stays real, selectable DOM text; only the fill is decorative.',
        ],
    ],
];
