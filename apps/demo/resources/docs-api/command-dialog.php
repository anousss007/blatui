<?php

// API metadata for the command-dialog component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'title',
            'type' => 'string',
            'default' => "'Command Palette'",
            'description' => 'Accessible name for the dialog, rendered visually hidden and used as the dialog\'s aria-labelledby heading.',
        ],
        [
            'name' => 'description',
            'type' => 'string',
            'default' => "'Search for a command to run...'",
            'description' => 'Visually hidden description for the dialog, used as its accessible description.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The dialog body — place a <x-ui.command> palette here. It is teleported to <body> and shown in a modal overlay when open.',
        ],
        [
            'name' => 'trigger',
            'description' => 'Optional <x-slot:trigger> holding the element that opens the dialog (e.g. a search button). Often paired with a global keyboard shortcut. Omit it to open the dialog only programmatically.',
        ],
    ],

    'methods' => [
        [
            'name' => 'open',
            'description' => 'Reactive boolean on the dialog\'s Alpine scope. Set open = true to show the palette (e.g. from a ⌘K key handler) and open = false to close it.',
        ],
    ],
];
