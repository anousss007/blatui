<?php

// API metadata for the password-strength component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'default' => "'password'",
            'description' => 'The name attribute of the password input, so it submits with a form.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Password'",
            'description' => 'Accessible label for the field, rendered visually hidden.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'••••••••'",
            'description' => 'Placeholder text for the empty field.',
        ],
        [
            'name' => 'showChecklist',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the live requirements checklist (length, mixed case, number, symbol) below the meter.',
        ],
        [
            'name' => 'minLength',
            'type' => 'int',
            'default' => '8',
            'description' => 'Minimum character count for the length requirement and the strength score.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Field height and typography.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id for the input. Defaults to the name when omitted.',
        ],
    ],
];
