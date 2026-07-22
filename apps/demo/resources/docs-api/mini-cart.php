<?php

// API metadata for the mini-cart component.

return [
    'props' => [
        [
            'name' => 'items',
            'type' => 'array',
            'default' => '[]',
            'description' => 'The line items shown in the cart panel. Each item renders a thumbnail, name, variant, price, a quantity stepper, and a line total.',
            'shape' => 'item',
        ],
        [
            'name' => 'currency',
            'type' => 'string',
            'default' => "'$'",
            'description' => 'The currency symbol prepended to all formatted prices.',
        ],
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the cart panel starts open. Mainly for demos and reviews; in normal use leave it closed and let the trigger toggle it.',
        ],
    ],

    'shapes' => [
        'item' => [
            'label' => 'Each item',
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The product name shown on the line item.',
                ],
                [
                    'name' => 'price',
                    'type' => 'number',
                    'required' => true,
                    'description' => 'The unit price. The line total and cart subtotal are computed from price times quantity.',
                ],
                [
                    'name' => 'qty',
                    'type' => 'int',
                    'default' => '1',
                    'description' => 'The starting quantity. Clamped to a minimum of 1; decrementing below 1 removes the item.',
                ],
                [
                    'name' => 'variant',
                    'type' => 'string',
                    'description' => 'An optional variant line (e.g. size or color) shown under the name.',
                ],
                [
                    'name' => 'image',
                    'type' => 'string',
                    'description' => 'An optional thumbnail URL. A placeholder icon is shown when omitted.',
                ],
            ],
        ],
    ],

    'methods' => [
        [
            'name' => 'toggle()',
            'description' => 'Opens the cart panel when closed, or closes it when open.',
        ],
        [
            'name' => 'openPanel()',
            'description' => 'Opens the cart panel and moves focus into it.',
        ],
        [
            'name' => 'close(returnFocus = true)',
            'description' => 'Closes the panel. Returns focus to the trigger button unless called with false.',
        ],
        [
            'name' => 'inc(item)',
            'description' => 'Increases the given item\'s quantity by one.',
        ],
        [
            'name' => 'dec(item)',
            'description' => 'Decreases the item\'s quantity by one, removing the item when it would drop below one.',
        ],
        [
            'name' => 'remove(id)',
            'description' => 'Removes the line item with the given id from the cart.',
        ],
    ],
];
