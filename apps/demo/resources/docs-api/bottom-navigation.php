<?php

// API metadata for the bottom-navigation component.

return [
    'props' => [
        [
            'name' => 'ariaLabel',
            'type' => 'string',
            'default' => "'Bottom navigation'",
            'description' => 'Accessible name for the <nav> landmark wrapping the tab bar.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The navigation items. Place one <x-ui.bottom-navigation-item> per tab (each takes `icon`, `label`, `href`, `active`, and an optional `badge`); they stretch to equal width across the bar.',
        ],
    ],
];
