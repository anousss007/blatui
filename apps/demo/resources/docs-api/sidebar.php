<?php

// API metadata for the sidebar component.

return [
    'props' => [
        [
            'name' => 'side',
            'type' => 'string',
            'default' => "'left'",
            'options' => ['left', 'right'],
            'description' => 'Which edge of the layout the sidebar is pinned to. Also sets the slide-in direction of the mobile overlay.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'sidebar'",
            'options' => ['sidebar', 'floating', 'inset'],
            'description' => 'Visual treatment of the panel, exposed as a data-variant for styling.',
        ],
        [
            'name' => 'collapsible',
            'type' => 'string',
            'default' => "'offcanvas'",
            'options' => ['offcanvas', 'icon', 'none'],
            'description' => 'Collapse behaviour on desktop. "offcanvas" slides the panel fully out of view, "icon" shrinks it to an icon rail, and "none" renders a static in-flow panel that never collapses.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The sidebar contents — typically <x-ui.sidebar-header>, <x-ui.sidebar-content> (with sidebar-group / sidebar-menu items) and <x-ui.sidebar-footer>. The same markup is reused for the desktop panel and the mobile overlay.',
        ],
    ],

    'methods' => [
        [
            'name' => 'toggle()',
            'description' => 'Toggles the sidebar — opens/closes the mobile overlay on small screens, or expands/collapses the desktop panel otherwise. Provided by <x-ui.sidebar-provider> and used by <x-ui.sidebar-trigger>.',
        ],
    ],
];
