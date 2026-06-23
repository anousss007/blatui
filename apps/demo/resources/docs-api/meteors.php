<?php

// API metadata for the meteors component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'count',
            'type' => 'int',
            'default' => '20',
            'description' => 'How many meteor streaks to render. Clamped to between 1 and 100 so the decorative layer can never explode the DOM.',
        ],
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'Any CSS colour for the meteor head and trail. Defaults to the foreground token at low opacity so it suits both light and dark surfaces.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The content rendered above the meteor layer. The wrapper is relative and overflow-hidden, so meteors fall behind whatever you put here.',
        ],
    ],
];
