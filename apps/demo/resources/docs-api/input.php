<?php

// API metadata for the input component.

return [
    'props' => [
        [
            'name' => 'type',
            'type' => 'string',
            'default' => "'text'",
            'description' => 'The HTML input type (text, email, password, file, number, etc.). A password type gets a built-in show/hide toggle.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Height, padding and font size of the field.',
        ],
        [
            'name' => 'toggle',
            'type' => 'bool',
            'description' => 'Controls the show/hide eye button on password fields. Pass false to disable it; it is on by default for type="password".',
        ],
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'Any CSS color that brands the focus ring and text selection locally by overriding the ring/primary tokens.',
        ],
    ],

    'slots' => [
        [
            'name' => 'leading',
            'description' => 'Icon or content pinned inside the start edge of the field. The input is padded so text never sits under it.',
        ],
        [
            'name' => 'trailing',
            'description' => 'Icon or content pinned inside the end edge of the field. Ignored on password fields, which use that space for the eye toggle.',
        ],
    ],
];
