<?php

// API metadata for the price component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'amount',
            'type' => 'number',
            'default' => '0',
            'description' => 'The current price, formatted with two decimals and the currency symbol.',
        ],
        [
            'name' => 'compareAt',
            'type' => 'number',
            'description' => 'Original price. When greater than amount, it is shown struck through and the price switches to the on-sale styling.',
        ],
        [
            'name' => 'currency',
            'type' => 'string',
            'default' => "'$'",
            'description' => 'Currency symbol prefixed to both prices.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Type scale of the price. The compare-at price renders one step smaller.',
        ],
        [
            'name' => 'showDiscount',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show a "-NN%" savings badge when on sale. The percentage is computed from amount and compareAt.',
        ],
    ],
];
