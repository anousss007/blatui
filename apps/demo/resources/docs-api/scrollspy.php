<?php

// API metadata for the scrollspy component.

return [
    'props' => [
        [
            'name' => 'items',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The table-of-contents entries to render. Each links to a page section by id; an IntersectionObserver highlights the entry whose section is currently in view.',
            'shape' => 'item',
        ],
    ],

    'shapes' => [
        'item' => [
            'label' => 'Each item',
            'fields' => [
                [
                    'name' => 'href',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'A hash selector for the target section (e.g. "#installation"). Used both as the anchor href and, with the leading hash stripped, to match the observed element id.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The visible link text shown in the table of contents.',
                ],
                [
                    'name' => 'level',
                    'type' => 'int',
                    'default' => '1',
                    'description' => 'Heading depth. A level of 2 or more renders with an extra inline-start indent to convey nesting.',
                ],
            ],
        ],
    ],
];
