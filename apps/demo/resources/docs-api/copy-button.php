<?php

// API metadata for the copy-button component.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'description' => 'The string written to the clipboard when the button is clicked.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Copy'",
            'description' => 'Accessible label for the button. It becomes "Copied" for 1.5s after a successful copy.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Optional visible text label rendered next to the copy/check icon. Omit it for an icon-only button.',
        ],
    ],

    'methods' => [
        [
            'name' => 'copy()',
            'description' => 'Writes value to the clipboard, flips the icon to a check, and resets after 1.5 seconds.',
        ],
    ],
];
