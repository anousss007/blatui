<?php

// API metadata for the toggle-group component.

return [
    'props' => [
        [
            'name' => 'type',
            'type' => 'string',
            'default' => "'single'",
            'options' => ['single', 'multiple'],
            'description' => 'Selection mode. "single" keeps one item active (value is a string or null); "multiple" allows many (value is an array).',
        ],
        [
            'name' => 'value',
            'type' => 'string|array',
            'description' => 'Initially selected item value(s). Pass a string in single mode, or an array in multiple mode.',
        ],
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'outline'],
            'description' => 'Visual style applied to every item. Set once on the group; items inherit it.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'sm', 'lg'],
            'description' => 'Control size applied to every item. Set once on the group; items inherit it.',
        ],
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Layout direction and arrow-key navigation axis for the group.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The group items, each an <x-ui.toggle-group-item value="…"> with an icon or label. Items inherit the group variant and size.',
        ],
    ],

    'methods' => [
        [
            'name' => 'toggle(v)',
            'description' => 'Toggles the item with value v on or off, respecting single vs multiple mode. Called when an item is clicked.',
        ],
        [
            'name' => 'isOn(v)',
            'description' => 'Returns whether the item with value v is currently selected.',
        ],
    ],
];
