<?php

// API metadata for the button-group component.

return [
    'props' => [
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Lay the buttons out in a row or a column. Adjacent corners and borders are collapsed so the group reads as one connected control.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The buttons (or other controls like selects and nested button-groups) to join. Place sibling x-ui.button elements here; their touching edges are merged automatically.',
        ],
    ],
];
