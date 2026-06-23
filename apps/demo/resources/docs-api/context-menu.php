<?php

// API metadata for the context-menu component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'Set on <x-ui.context-menu-item>. Renders the item as a link (<a>) to this URL instead of a button.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'destructive'],
            'description' => 'Set on <x-ui.context-menu-item>. Use destructive to style dangerous actions in the destructive color.',
        ],
        [
            'name' => 'inset',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on an item, label, or sub-trigger to add left padding so its text aligns with items that have a leading icon or check.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on <x-ui.context-menu-item> to disable it (not focusable, not clickable, dimmed).',
        ],
        [
            'name' => 'closeOnSelect',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Set on <x-ui.context-menu-item> (true) — closes the menu after the item is chosen. On checkbox/radio items it defaults to false so the menu stays open while toggling.',
        ],
        [
            'name' => 'checked',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on <x-ui.context-menu-checkbox-item> for its initial checked state.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'On <x-ui.context-menu-radio-group> it is the initially selected value; on each <x-ui.context-menu-radio-item> it is that option\'s value. The matching item is shown as selected.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Compose the menu from <x-ui.context-menu-trigger> and <x-ui.context-menu-content>. The wrapper holds the shared open/position state.',
        ],
        [
            'name' => 'trigger',
            'description' => 'Content of <x-ui.context-menu-trigger> — the region the user right-clicks to open the menu at the pointer.',
        ],
        [
            'name' => 'content',
            'description' => 'Content of <x-ui.context-menu-content> — items, labels, separators, groups, checkbox/radio items, and submenus. Teleported to <body> and positioned at the cursor.',
        ],
    ],

    'methods' => [
        [
            'name' => 'openAt(event)',
            'description' => 'Opens the menu at the pointer position from a contextmenu event (the trigger wires this on @contextmenu) and focuses the first item.',
        ],
        [
            'name' => 'closeMenu(returnFocus = true)',
            'description' => 'Closes the menu and, unless returnFocus is false, restores focus to the trigger.',
        ],
    ],
];
