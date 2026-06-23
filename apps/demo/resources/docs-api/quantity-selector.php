<?php

// API metadata for the quantity-selector component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name submitted with the numeric value. Also used as the input\'s accessible name when no aria-label is provided.',
        ],
        [
            'name' => 'value',
            'type' => 'int',
            'default' => '1',
            'description' => 'The initial quantity. Pass null/empty to start with no value.',
        ],
        [
            'name' => 'min',
            'type' => 'int',
            'default' => '1',
            'description' => 'Minimum allowed quantity. The decrease button disables at this value; pass null for no lower bound.',
        ],
        [
            'name' => 'max',
            'type' => 'int',
            'description' => 'Maximum allowed quantity. The increase button disables at this value; omit for no upper bound.',
        ],
        [
            'name' => 'step',
            'type' => 'int',
            'default' => '1',
            'description' => 'Amount added or removed by the increase/decrease buttons.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Control height and field width.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable the whole control (both buttons and the input).',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'id attribute for the numeric input, e.g. to pair with an external <label for>.',
        ],
    ],

    'methods' => [
        [
            'name' => 'inc()',
            'description' => 'Increase the value by step, clamped to max. No-op when disabled or already at max.',
        ],
        [
            'name' => 'dec()',
            'description' => 'Decrease the value by step, clamped to min. No-op when disabled or already at min.',
        ],
    ],
];
