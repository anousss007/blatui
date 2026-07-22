<?php

// API metadata for the menubar component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'align',
            'type' => 'string',
            'default' => "'start'",
            'options' => ['start', 'center', 'end'],
            'description' => 'Set on <x-ui.menubar-content>. Aligns the dropdown along the trigger edge it is anchored to.',
        ],
        [
            'name' => 'side',
            'type' => 'string',
            'default' => "'bottom'",
            'options' => ['top', 'right', 'bottom', 'left'],
            'description' => 'Set on <x-ui.menubar-content>. Which edge of the trigger the dropdown opens from.',
        ],
        [
            'name' => 'sideOffset',
            'type' => 'int',
            'default' => '8',
            'description' => 'Set on <x-ui.menubar-content>. Gap in pixels between the trigger and the dropdown.',
        ],
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'Set on <x-ui.menubar-item>. Renders the item as a link (<a>) to this URL instead of a button.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'destructive'],
            'description' => 'Set on <x-ui.menubar-item>. Use destructive to style dangerous actions in the destructive color.',
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
            'description' => 'Set on <x-ui.menubar-item> to disable it (not focusable, not clickable, dimmed).',
        ],
        [
            'name' => 'checked',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on <x-ui.menubar-checkbox-item> for its initial checked state.',
        ],
        [
            'name' => 'closeOnSelect',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on a checkbox/radio item to close the menu after toggling (defaults to false so the menu stays open).',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'On <x-ui.menubar-radio-group> it is the initially selected value; on each <x-ui.menubar-radio-item> it is that option\'s value. The matching item is shown as selected.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'A row of <x-ui.menubar-menu> blocks. The menubar holds shared roving-focus state across all triggers.',
        ],
        [
            'name' => 'menu',
            'description' => 'Each <x-ui.menubar-menu> pairs one <x-ui.menubar-trigger> with its <x-ui.menubar-content> and owns that menu\'s id.',
        ],
        [
            'name' => 'trigger',
            'description' => 'Content of <x-ui.menubar-trigger> — the top-level label that opens its menu.',
        ],
        [
            'name' => 'content',
            'description' => 'Content of <x-ui.menubar-content> — items, separators, checkbox/radio items, and submenus. Teleported to <body>.',
        ],
    ],

    'methods' => [
        [
            'name' => 'openMenu(id, focusFirst = true)',
            'description' => 'Opens the menu with the given id and, by default, focuses its first item.',
        ],
        [
            'name' => 'toggleMenu(id)',
            'description' => 'Opens the menu with the given id if closed, otherwise closes it.',
        ],
        [
            'name' => 'closeMenu(returnFocus = true)',
            'description' => 'Closes the open menu and, unless returnFocus is false, restores focus to its trigger.',
        ],
        [
            'name' => 'moveTrigger(dir, fromId)',
            'description' => 'Moves between top-level triggers (dir 1 = next, -1 = previous), switching the open menu when one is already open.',
        ],
    ],
];
