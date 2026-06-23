<?php

// API metadata for the spotlight-card component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'Any CSS colour for the radial glow that follows the cursor. Defaults to a subtle neutral glow (the foreground token mixed to a low alpha) that reads well in both light and dark themes.',
        ],
        [
            'name' => 'size',
            'type' => 'int',
            'default' => '350',
            'description' => 'The spotlight radius in pixels (the gradient\'s solid-centre to transparent-edge falloff distance).',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The card content. It sits above the decorative spotlight overlay on its own stacking context.',
        ],
    ],
];
