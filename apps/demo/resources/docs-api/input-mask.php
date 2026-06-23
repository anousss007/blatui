<?php

// API metadata for the input-mask component.

return [
    'props' => [
        [
            'name' => 'mask',
            'type' => 'string',
            'default' => "''",
            'required' => true,
            'description' => 'The mask pattern. Use 9 for a digit, a for a letter, * for an alphanumeric character; any other character is a fixed literal inserted as the user types (e.g. "99/99/9999", "(999) 999-9999").',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'description' => 'Initial value. It is run through the mask once on init so the field starts formatted.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'The id attribute, e.g. to pair the field with a label.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'The form field name submitted with the (masked) value.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Placeholder text shown when the field is empty.',
        ],
        [
            'name' => 'inputmode',
            'type' => 'string',
            'description' => 'The HTML inputmode hint for the on-screen keyboard (e.g. "numeric" for digit-only masks).',
        ],
    ],

    'methods' => [
        [
            'name' => 'apply()',
            'description' => 'Reformats the current field value against the mask. Runs automatically on init and on every input event.',
        ],
    ],
];
