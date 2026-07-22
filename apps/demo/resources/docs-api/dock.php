<?php

// API metadata for the dock component.

return [
    'props' => [
        [
            'name' => 'magnify',
            'type' => 'number',
            'default' => '1.6',
            'description' => 'The peak scale a tile reaches when the cursor is directly over it. Falls back to rest size (1) under prefers-reduced-motion.',
        ],
        [
            'name' => 'distance',
            'type' => 'int',
            'default' => '120',
            'description' => 'The influence radius in pixels over which the magnify effect eases back to rest size as the cursor moves away from a tile.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The dock tiles. Place one <x-ui.dock-item> per entry (each takes `icon`, `label`, `href`, `active`); items read the dock scope to compute their own magnification.',
        ],
    ],
];
