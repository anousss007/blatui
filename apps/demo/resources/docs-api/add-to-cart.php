<?php

// API metadata for the add-to-cart component.

return [
    'props' => [
        [
            'name' => 'label',
            'type' => 'string|bool',
            'default' => "'Add to cart'",
            'description' => 'The idle button text. Pass false for an icon-only button (combine with an aria-label and size="icon"). The default slot, when filled, overrides this.',
        ],
        [
            'name' => 'addedLabel',
            'type' => 'string',
            'default' => "'Added'",
            'description' => 'The text shown briefly in the success state after the item is added.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'sm', 'lg', 'icon', 'icon-sm', 'icon-lg'],
            'description' => 'Button size, mirroring the button component. Use an icon-* size together with :label="false" for a compact icon-only button.',
        ],
        [
            'name' => 'icon',
            'type' => 'string',
            'default' => "'shopping-cart'",
            'description' => 'The Lucide icon name shown in the idle state (without the "lucide-" prefix).',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Optional custom label content for the idle state. When provided, it replaces the label prop text.',
        ],
    ],

    'methods' => [
        [
            'name' => 'add()',
            'description' => 'Triggers the idle to adding transition. The demo simulates a request with a timeout; replace it with your own request and call done() or reset() when it resolves.',
        ],
        [
            'name' => 'done()',
            'description' => 'Switches to the success ("added") state, then auto-resets to idle. Call this when your request succeeds.',
        ],
        [
            'name' => 'reset()',
            'description' => 'Returns the button to the idle state. Call this when your request fails.',
        ],
    ],
];
