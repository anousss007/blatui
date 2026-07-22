<?php

// API metadata for the number-ticker component.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'number',
            'default' => '0',
            'required' => true,
            'description' => 'The target number to count up to. Counting starts the first time the element scrolls into view.',
        ],
        [
            'name' => 'from',
            'type' => 'number',
            'default' => '0',
            'description' => 'The starting number the count animates up (or down) from.',
        ],
        [
            'name' => 'duration',
            'type' => 'int',
            'default' => '1500',
            'description' => 'The count animation length in milliseconds. Set to 0 to show the final value immediately.',
        ],
        [
            'name' => 'decimals',
            'type' => 'int',
            'default' => '0',
            'description' => 'How many decimal places to display.',
        ],
        [
            'name' => 'prefix',
            'type' => 'string',
            'default' => "''",
            'description' => 'Text shown before the number (e.g. a currency symbol).',
        ],
        [
            'name' => 'suffix',
            'type' => 'string',
            'default' => "''",
            'description' => 'Text shown after the number (e.g. "%" or "+").',
        ],
        [
            'name' => 'separator',
            'type' => 'string',
            'default' => "','",
            'description' => 'The thousands separator inserted into the integer part.',
        ],
    ],
];
