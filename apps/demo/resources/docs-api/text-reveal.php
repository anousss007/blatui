<?php

// API metadata for the text-reveal component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'as',
            'type' => 'string',
            'default' => "'p'",
            'description' => 'The wrapper HTML tag to render (sanitized to alphanumerics, falling back to "p").',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The text to reveal. It is split into words that dim, then brighten one by one as the element scrolls up through the viewport. The full text is server-rendered at full opacity, so no-JS readers and crawlers get everything; it stays fully revealed under prefers-reduced-motion.',
        ],
    ],
];
