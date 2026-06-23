<?php

// API metadata for the dropdown-menu component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'align',
            'type' => 'string',
            'default' => "'start'",
            'options' => ['start', 'center', 'end'],
            'description' => 'Set on <x-ui.dropdown-menu-content>. Aligns the menu along the trigger edge it is anchored to.',
        ],
        [
            'name' => 'side',
            'type' => 'string',
            'default' => "'bottom'",
            'options' => ['top', 'right', 'bottom', 'left'],
            'description' => 'Set on <x-ui.dropdown-menu-content>. Which edge of the trigger the menu opens from.',
        ],
        [
            'name' => 'sideOffset',
            'type' => 'int',
            'default' => '4',
            'description' => 'Set on <x-ui.dropdown-menu-content>. Gap in pixels between the trigger and the menu.',
        ],
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'Set on <x-ui.dropdown-menu-item>. Renders the item as a link (<a>) to this URL instead of a button.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'destructive'],
            'description' => 'Set on <x-ui.dropdown-menu-item>. Use destructive to style dangerous actions in the destructive color.',
        ],
        [
            'name' => 'inset',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on an item, label, or sub-trigger to add left padding so its text lines up with items that have a leading icon or check.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on <x-ui.dropdown-menu-item> to disable it (not focusable, not clickable, dimmed).',
        ],
        [
            'name' => 'closeOnSelect',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Set on <x-ui.dropdown-menu-item> (true) — closes the menu after the item is chosen. On checkbox/radio items it defaults to false so the menu stays open while toggling.',
        ],
        [
            'name' => 'type',
            'type' => 'string',
            'default' => "'button'",
            'options' => ['button', 'submit'],
            'description' => 'Set on <x-ui.dropdown-menu-item>. Use submit to submit the surrounding <form> when the item is clicked.',
        ],
        [
            'name' => 'checked',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on <x-ui.dropdown-menu-checkbox-item> for its initial checked state.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'On <x-ui.dropdown-menu-radio-group> it is the initially selected value; on each <x-ui.dropdown-menu-radio-item> it is that option\'s value. The item whose value matches the group is shown as selected.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Compose the menu from <x-ui.dropdown-menu-trigger> and <x-ui.dropdown-menu-content>. The wrapper holds the shared open/focus state.',
        ],
        [
            'name' => 'trigger',
            'description' => 'Content of <x-ui.dropdown-menu-trigger> — the element (e.g. a button) that opens the menu.',
        ],
        [
            'name' => 'content',
            'description' => 'Content of <x-ui.dropdown-menu-content> — items, labels, separators, groups, checkbox/radio items, and submenus. Teleported to <body>.',
        ],
    ],

    'methods' => [
        [
            'name' => 'openMenu(focus)',
            'description' => 'Opens the menu. Pass \'first\' or \'last\' to focus that item (keyboard open), or omit to focus the menu container (pointer open).',
        ],
        [
            'name' => 'closeMenu(returnFocus = true)',
            'description' => 'Closes the menu and, unless returnFocus is false, restores focus to the trigger.',
        ],
        [
            'name' => 'toggleMenu()',
            'description' => 'Opens the menu if closed, otherwise closes it.',
        ],
    ],
];
