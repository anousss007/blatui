<?php

// API metadata for the stack component.

return [
    'props' => [
        [
            'name' => 'direction',
            'type' => 'string',
            'default' => "'col'",
            'options' => ['col', 'row'],
            'description' => 'Flex direction: stack children vertically (col) or horizontally (row).',
        ],
        [
            'name' => 'gap',
            'type' => 'string|int',
            'default' => "'4'",
            'options' => ['0', '1', '2', '3', '4', '5', '6', '8', '10', '12'],
            'description' => 'Space between children, mapped to a Tailwind gap utility (in 0.25rem units).',
        ],
        [
            'name' => 'align',
            'type' => 'string',
            'options' => ['start', 'center', 'end', 'stretch', 'baseline'],
            'description' => 'Cross-axis alignment of children (align-items).',
        ],
        [
            'name' => 'justify',
            'type' => 'string',
            'options' => ['start', 'center', 'end', 'between', 'around', 'evenly'],
            'description' => 'Main-axis distribution of children (justify-content).',
        ],
        [
            'name' => 'wrap',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Allow children to wrap onto multiple lines (flex-wrap).',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The items to lay out as a flex stack.',
        ],
    ],
];
