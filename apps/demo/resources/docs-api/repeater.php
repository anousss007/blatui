<?php

// API metadata for the repeater component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'default' => "'items'",
            'description' => 'Base form field name. Rows submit as name[index][key] (e.g. items[0][value], items[1][value]).',
        ],
        [
            'name' => 'fields',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Column schema describing the inputs in each row. Defaults to a single text column keyed "value" when omitted.',
            'shape' => 'field',
        ],
        [
            'name' => 'value',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Seed rows: an array of associative arrays keyed by the field keys (e.g. [["name"=>"Ada","email"=>"ada@example.com"]]). Padded up to "min" rows.',
        ],
        [
            'name' => 'min',
            'type' => 'int',
            'default' => '1',
            'description' => 'Minimum number of rows. Remove is disabled once this floor is reached.',
        ],
        [
            'name' => 'max',
            'type' => 'int',
            'description' => 'Maximum number of rows. Add is disabled at this ceiling and a count badge is shown. Defaults to unlimited.',
        ],
        [
            'name' => 'addLabel',
            'type' => 'string',
            'default' => "'Add row'",
            'description' => 'Text on the Add button.',
        ],
    ],

    'shapes' => [
        'field' => [
            'label' => 'Each field (column)',
            'fields' => [
                [
                    'name' => 'key',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Key used in the submitted name (name[index][key]) and to read/write the value on each row.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'Column label, shown above the first row and used as the aria-label on later rows. Defaults to a headline of the key.',
                ],
                [
                    'name' => 'placeholder',
                    'type' => 'string',
                    'default' => "''",
                    'description' => 'Placeholder for the column input.',
                ],
                [
                    'name' => 'type',
                    'type' => 'string',
                    'default' => "'text'",
                    'description' => 'Input type. Use "textarea" for a multi-line field; any other value is passed through as an <input type> (text, email, number, url…).',
                ],
            ],
        ],
    ],

    'methods' => [
        [
            'name' => 'add()',
            'description' => 'Appends a blank row and focuses its first input. No-op when at "max".',
        ],
        [
            'name' => 'remove(index)',
            'description' => 'Removes the row at the given index. No-op when at "min".',
        ],
    ],
];
