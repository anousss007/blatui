<?php

// API metadata for the alert component.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'destructive'],
            'description' => 'Base visual style. Ignored when a tone is set.',
        ],
        [
            'name' => 'tone',
            'type' => 'string',
            'options' => ['success', 'warning', 'danger', 'info', 'neutral'],
            'description' => 'Semantic status tone — a soft tinted callout. When set, it overrides the variant.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The alert content. Compose with <x-ui.alert-title>, <x-ui.alert-description>, an optional leading <svg> icon, and <x-ui.alert-action> for a pinned top-right action.',
        ],
    ],
];
