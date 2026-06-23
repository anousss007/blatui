<?php

// API metadata for the code-block component.

return [
    'props' => [
        [
            'name' => 'filename',
            'type' => 'string',
            'description' => 'Optional file name shown in a header bar above the code, alongside a file icon and the copy button. When omitted, the copy button floats in the top corner and appears on hover instead.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The code to display. Wrap it in @verbatim ... @endverbatim if it contains Blade or component syntax so it renders literally. The slot is trimmed and the copy button copies its rendered text.',
        ],
    ],

    'methods' => [
        [
            'name' => 'copy()',
            'description' => 'Copies the code pane text to the clipboard and flips the icon to a check for ~1.6s. Wired to the built-in copy button; rarely called directly.',
        ],
    ],
];
