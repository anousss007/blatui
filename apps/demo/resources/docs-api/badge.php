<?php

// API metadata for the badge component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'secondary', 'destructive', 'outline', 'soft', 'solid'],
            'description' => 'Visual style. Without a tone, use default/secondary/destructive/outline brand styles. With a tone set, variant selects the intensity (soft, solid or outline).',
        ],
        [
            'name' => 'tone',
            'type' => 'string',
            'options' => ['success', 'warning', 'danger', 'info', 'neutral'],
            'description' => 'Semantic status colour. When set, variant chooses the intensity (soft by default) and overrides the brand variants above.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Padding and type scale of the badge.',
        ],
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'When provided, the badge renders as an anchor link with hover styling instead of a span.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The badge content — text, and optionally a leading or trailing SVG icon (sized automatically).',
        ],
    ],
];
