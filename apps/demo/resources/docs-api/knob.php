<?php

// API metadata for the knob component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'When set, a hidden input mirrors the value so the knob submits with the form.',
        ],
        [
            'name' => 'value',
            'type' => 'number',
            'default' => '50',
            'description' => 'Initial value of the dial.',
        ],
        [
            'name' => 'min',
            'type' => 'number',
            'default' => '0',
            'description' => 'Lowest value, mapped to the start of the 270 degree arc.',
        ],
        [
            'name' => 'max',
            'type' => 'number',
            'default' => '100',
            'description' => 'Highest value, mapped to the end of the 270 degree arc.',
        ],
        [
            'name' => 'step',
            'type' => 'number',
            'default' => '1',
            'description' => 'Granularity for drag, scroll and arrow-key changes. Page Up/Down move by a larger amount.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Diameter of the dial and size of the centered value text.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Value'",
            'description' => 'Accessible label for the slider.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables interaction and dims the dial.',
        ],
    ],
];
