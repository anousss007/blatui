<?php

// API metadata for the signature-pad component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. Submits the signature as a PNG data URL in a hidden input (empty when the pad is blank).',
        ],
        [
            'name' => 'height',
            'type' => 'int',
            'default' => '200',
            'description' => 'Drawing height in CSS pixels. The width is fluid and fills the container.',
        ],
        [
            'name' => 'penColor',
            'type' => 'string',
            'description' => 'Any CSS color for the ink. Defaults to the theme foreground color, so the stroke tracks light/dark mode.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id applied to the hidden input.',
        ],
    ],

    'methods' => [
        [
            'name' => 'undo()',
            'description' => 'Removes the last completed stroke and repaints. Bound to the built-in Undo button.',
        ],
        [
            'name' => 'clear()',
            'description' => 'Erases the entire signature and resets the hidden field. Bound to the built-in Clear button.',
        ],
    ],
];
