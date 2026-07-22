<?php

// API metadata for the flip-card component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'trigger',
            'type' => 'string',
            'default' => "'hover'",
            'options' => ['hover', 'click'],
            'description' => 'What flips the card. "hover" flips on pointer hover and keyboard focus; "click" makes the card a button that toggles on click.',
        ],
        [
            'name' => 'height',
            'type' => 'string',
            'default' => "'16rem'",
            'description' => 'CSS height for the perspective box. Required because the two faces are absolutely positioned, so the box has no intrinsic height.',
        ],
    ],

    'slots' => [
        [
            'name' => 'front',
            'description' => 'The front face shown before flipping. If omitted, the default slot is used as the front face instead.',
        ],
        [
            'name' => 'back',
            'description' => 'The back face revealed after flipping.',
        ],
        [
            'name' => 'default',
            'description' => 'Fallback front face used only when no named front slot is provided.',
        ],
    ],
];
