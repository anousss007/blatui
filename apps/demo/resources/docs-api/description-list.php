<?php

// API metadata for the description-list component.

return [
    'props' => [
        [
            'name' => 'layout',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Row layout. "horizontal" puts the term and value side by side (a grid from the sm breakpoint up); "vertical" stacks the value under the term. Each <x-ui.description-item> inherits this automatically.',
        ],
        [
            'name' => 'bordered',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Wrap the list in a bordered card surface with dividers between rows. When false, rows simply stack with a vertical gap.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'One <x-ui.description-item term="..."> per row. Each item exposes a "term" prop (or a term slot for richer markup) and renders its value from the default slot. Items inherit the list\'s layout and bordered props, so you set those once on the list.',
        ],
    ],
];
