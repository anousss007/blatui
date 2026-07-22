<?php

// API metadata for the command component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'Type a command or search...'",
            'description' => 'Set on <x-ui.command-input>. Placeholder text and accessible label for the search field.',
        ],
        [
            'name' => 'heading',
            'type' => 'string',
            'description' => 'Set on <x-ui.command-group>. Optional section heading shown above the group\'s items.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'Set on <x-ui.command-item>. The keyword the item filters on. Defaults to the item\'s text content when omitted.',
        ],
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'Set on <x-ui.command-item>. Renders the item as a link (<a>) to this URL instead of a div.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Set on <x-ui.command-item> to make it non-selectable and dimmed; it is also excluded from keyboard navigation.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Compose the palette: <x-ui.command-input>, then a <x-ui.command-list> containing <x-ui.command-empty>, <x-ui.command-group> sections, <x-ui.command-item> rows, and <x-ui.command-separator>.',
        ],
        [
            'name' => 'list',
            'description' => 'Content of <x-ui.command-list> — the scrollable listbox of groups and items.',
        ],
        [
            'name' => 'empty',
            'description' => 'Content of <x-ui.command-empty>, shown only when the query matches no items (e.g. "No results found.").',
        ],
        [
            'name' => 'item',
            'description' => 'Content of <x-ui.command-item> — typically an icon, a label, and an optional <x-ui.command-shortcut>.',
        ],
    ],

    'methods' => [
        [
            'name' => 'move(dir)',
            'description' => 'Moves the active option to the next (1) or previous (-1) visible item, wrapping around.',
        ],
        [
            'name' => 'edge(pos)',
            'description' => 'Jumps the active option to the first or last visible item. Pass \'first\' or \'last\'.',
        ],
        [
            'name' => 'selectActive()',
            'description' => 'Activates (clicks) the currently highlighted item, as the Enter key does.',
        ],
    ],
];
