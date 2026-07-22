<?php

// API metadata for the comparison-table component.

return [
    'props' => [
        [
            'name' => 'tiers',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The column headers, one per plan or tier, e.g. ["Hobby", "Pro", "Enterprise"]. The values in each row line up with these by position.',
        ],
        [
            'name' => 'rows',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The feature rows. Each row pairs a feature name with one value per tier.',
            'shape' => 'row',
        ],
        [
            'name' => 'highlight',
            'type' => 'string|int',
            'description' => 'The tier to emphasise, given as a tier name (matched against tiers) or a 0-based column index. Its header is colored and its cells get a subtle background.',
        ],
        [
            'name' => 'featureLabel',
            'type' => 'string',
            'default' => "'Feature'",
            'description' => 'The header text for the leftmost (feature name) column.',
        ],
    ],

    'shapes' => [
        'row' => [
            'label' => 'Each row',
            'fields' => [
                [
                    'name' => 'feature',
                    'type' => 'string',
                    'description' => 'The feature name shown in the leftmost column (the row header).',
                ],
                [
                    'name' => 'values',
                    'type' => 'array',
                    'description' => 'One value per tier, in the same order as tiers. Use true for a check icon, false or null for a "not included" dash, or any string/number to render as-is.',
                ],
            ],
        ],
    ],
];
