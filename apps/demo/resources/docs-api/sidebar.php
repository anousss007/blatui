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
        [
            'name' => 'mobileBreakpoint',
            'type' => 'string',
            'default' => "'767px'",
            'description' => 'Since 1.24. Set on <x-ui.sidebar-provider>. Viewport width below which the sidebar becomes an off-canvas drawer instead of collapsing to the icon rail. Raise it to 1023px to get the drawer on tablets too, where an always-docked rail often costs more room than it earns. A bare number is read as px; anything else is passed to matchMedia as written.',
        ],
        [
            'name' => 'tooltip',
            'type' => 'string',
            'description' => 'Since 1.23. Set on <x-ui.sidebar-menu-button>. Label shown on hover or focus while the sidebar is collapsed to the icon rail, where the button text is clipped away — opt in per button, as in shadcn/ui. It is a visual affordance only: the label <span> stays in the DOM when collapsed, so the accessible name never depended on it.',
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
