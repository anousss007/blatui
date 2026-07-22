<?php

// API metadata for the input-otp component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Name of the hidden input, so the entered code is submitted with the form.',
        ],
        [
            'name' => 'maxlength',
            'type' => 'int',
            'default' => '6',
            'description' => 'Total number of characters the code accepts. Should match the number of input-otp-slot children you render.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'description' => 'Initial code value.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the field and dims it.',
        ],
        [
            'name' => 'alphanumeric',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Accept letters and digits (text inputmode). When false the field is numeric-only.',
        ],
        [
            'name' => 'ariaLabel',
            'type' => 'string',
            'default' => "'One-time password'",
            'description' => 'Accessible label announced for the code field.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The visible slot cells. Compose with x-ui.input-otp-group wrapping x-ui.input-otp-slot (each given an :index), optionally split by x-ui.input-otp-separator. The real input is hidden and overlays these cells.',
        ],
    ],
];
