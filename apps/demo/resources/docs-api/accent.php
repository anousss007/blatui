<?php

// API metadata for the accent component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'Any CSS color value. Rewrites the theme tokens (--primary, --secondary, --ring) on this subtree only, so every BlatUI control inside — buttons, badges, checkboxes, switches, focus rings — recolours with no per-component props.',
        ],
        [
            'name' => 'foreground',
            'type' => 'string',
            'default' => "'#ffffff'",
            'description' => 'Text colour used on filled accents such as primary buttons and solid badges. Defaults to white when omitted.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The content to recolour. The wrapper renders as display:contents so it never affects layout — add a class if you need it to be a real box.',
        ],
    ],
];
