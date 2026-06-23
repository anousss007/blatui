<?php

// API metadata for the aspect-ratio component.

return [
    'props' => [
        [
            'name' => 'ratio',
            'type' => 'string',
            'default' => "'1 / 1'",
            'description' => 'The desired width-to-height ratio as a CSS aspect-ratio value, e.g. "16 / 9" or "4 / 3". The container keeps this ratio at any width.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The content constrained to the ratio (e.g. an <img>, <iframe>, or <video>). The wrapper is relatively positioned, so children can be absolutely positioned to fill it.',
        ],
    ],
];
