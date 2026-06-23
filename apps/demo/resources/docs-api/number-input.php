<?php

// API metadata for the number-input component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Name of the underlying input, used for form submission and as the fallback accessible label.',
        ],
        [
            'name' => 'value',
            'type' => 'number',
            'default' => '0',
            'description' => 'Initial numeric value. Pass null or an empty string to start the field empty.',
        ],
        [
            'name' => 'min',
            'type' => 'number',
            'description' => 'Lowest allowed value. Clamps on blur and disables the decrease button at the floor.',
        ],
        [
            'name' => 'max',
            'type' => 'number',
            'description' => 'Highest allowed value. Clamps on blur and disables the increase button at the ceiling.',
        ],
        [
            'name' => 'step',
            'type' => 'number',
            'default' => '1',
            'description' => 'Amount each increase/decrease button adds or subtracts.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Control height and text size; matches the input component so fields line up in a form.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the field and both stepper buttons.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'id attribute of the underlying input, for associating an external label.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Placeholder shown while the field is empty.',
        ],
    ],
];
