<?php

// API metadata for the navigation-menu component.

return [
    'slots' => [
        [
            'name' => 'default',
            'description' => 'The menu composition. Wrap entries in <x-ui.navigation-menu-list>, then one <x-ui.navigation-menu-item> per top-level entry. An item is either a dropdown (<x-ui.navigation-menu-trigger> followed by <x-ui.navigation-menu-content> holding the panel markup) or a plain <x-ui.navigation-menu-link href>. Links accept active to mark the current page. Only one menu is open at a time, controlled by the shared Alpine scope.',
        ],
    ],
];
