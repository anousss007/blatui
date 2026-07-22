<?php

// API metadata for the meter component.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'number',
            'default' => '0',
            'required' => true,
            'description' => 'The current measured value. Clamped into the min/max range for display.',
        ],
        [
            'name' => 'min',
            'type' => 'number',
            'default' => '0',
            'description' => 'The lower bound of the scale.',
        ],
        [
            'name' => 'max',
            'type' => 'number',
            'default' => '100',
            'description' => 'The upper bound of the scale. Forced above min if an empty or inverted range is passed.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'description' => 'Visible label and accessible name. When omitted, an aria-label attribute or "Meter" is used instead.',
        ],
        [
            'name' => 'tone',
            'type' => 'string',
            'options' => ['good', 'warning', 'danger', 'default'],
            'description' => 'Forces the fill color. When set it overrides the low/high/optimum threshold logic.',
        ],
        [
            'name' => 'low',
            'type' => 'number',
            'description' => 'Lower bound of the preferred middle band. Used with high/optimum to auto-pick the tone like the native <meter>.',
        ],
        [
            'name' => 'high',
            'type' => 'number',
            'description' => 'Upper bound of the preferred middle band. Used with low/optimum to auto-pick the tone.',
        ],
        [
            'name' => 'optimum',
            'type' => 'number',
            'description' => 'The ideal value. Its position relative to low/high decides which side reads as "good".',
        ],
        [
            'name' => 'showValue',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the formatted value text in the header row.',
        ],
        [
            'name' => 'unit',
            'type' => 'string',
            'default' => "'%'",
            'description' => 'Suffix appended to the value text, e.g. "%". Use a space-prefixed unit or "" as needed.',
        ],
    ],
];
