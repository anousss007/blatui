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
            'name' => 'persist',
            'type' => 'bool|string',
            'default' => 'false',
            'description' => 'Since 1.36. Set on <x-ui.sidebar-provider>. Remembers the desktop expanded/collapsed state in a cookie (`sidebar_state`, or the name you pass instead of `true`). The cookie is read on the server, so the first paint is already in the remembered state — no flash on a reload, a wire:navigate visit or a Livewire re-render — and it is read from the raw Cookie header, so it needs no EncryptCookies exception. Give two persisting providers on one page different names.',
        ],
        [
            'name' => 'style',
            'type' => 'string',
            'description' => 'Since 1.36. On <x-ui.sidebar-provider>, the expand/collapse animation is tunable with two CSS variables: --sidebar-duration (default 200ms) and --sidebar-ease (default cubic-bezier(0.32, 0.72, 0, 1), an ease-out — it was linear before). Example: style="--sidebar-duration: 300ms". Reduced-motion users get no animation.',
        ],
        [
            'name' => 'current',
            'type' => 'bool|string',
            'default' => 'false',
            'options' => ['true', "'exact'"],
            'description' => 'Since 1.37. Set on <x-ui.sidebar-menu-button> or <x-ui.sidebar-menu-sub-button> with an href, in place of isActive. The link is active when the page path starts with its path, segment by segment (`/orders` on `/orders/12`), or only on the same path with \'exact\'; the root is always exact. It is the rule of Livewire\'s wire:current. Worked out on the server for the first paint (from the page, not the livewire/update route), then kept right in the browser on every wire:navigate visit: data-active, aria-current="page", and the <x-ui.collapsible> groups around the link open. That makes a sidebar inside @persist, or one in its own Livewire component, safe to leave un-rendered between visits.',
        ],
        [
            'name' => 'persist (sidebar-content)',
            'type' => 'bool|string',
            'default' => 'false',
            'description' => 'Since 1.37. Set on <x-ui.sidebar-content>. Remembers how far the list is scrolled, per browser tab (sessionStorage), and restores it after a wire:navigate visit or a reload, without @persist. Pass a name instead of true to keep two lists apart. The mobile drawer gets it back each time it opens.',
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
            'description' => 'The sidebar contents — typically <x-ui.sidebar-header>, <x-ui.sidebar-content> (with sidebar-group / sidebar-menu items) and <x-ui.sidebar-footer>. The same markup is reused for the desktop panel and the mobile overlay. Since 1.36, an item with a <x-ui.sidebar-menu-sub> stays reachable in the icon rail: clicking its button (or Enter, or the arrow pointing away from the rail) opens the sub list as a flyout beside it, with Up/Down/Home/End between the links and Escape back to the button.',
        ],
    ],

    'methods' => [
        [
            'name' => 'toggle()',
            'description' => 'Toggles the sidebar — opens/closes the mobile overlay on small screens, or expands/collapses the desktop panel otherwise. Provided by <x-ui.sidebar-provider> and used by <x-ui.sidebar-trigger>.',
        ],
    ],
];
