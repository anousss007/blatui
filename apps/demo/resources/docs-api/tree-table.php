<?php

// API metadata for the tree-table component.

return [
    'props' => [
        [
            'name' => 'columns',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The column definitions, in display order. The first column is the tree column: it carries the expand/collapse toggle and indents nested rows.',
            'shape' => 'column',
        ],
        [
            'name' => 'rows',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The hierarchical row data. Each row is keyed by the column keys and may carry a "children" array of rows with the same shape, nested to any depth.',
            'shape' => 'row',
        ],
    ],

    'shapes' => [
        'column' => [
            'label' => 'Each column',
            'fields' => [
                [
                    'name' => 'key',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The row-data key this column reads its cell value from.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'The header text for the column.',
                ],
                [
                    'name' => 'align',
                    'type' => 'string',
                    'default' => "'left'",
                    'options' => ['left', 'center', 'right'],
                    'description' => 'Horizontal alignment of the column\'s header and cells.',
                ],
            ],
        ],
        'row' => [
            'label' => 'Each row',
            'fields' => [
                [
                    'name' => 'children',
                    'type' => 'array',
                    'description' => 'Optional nested child rows, each with the same shape as a top-level row. Rows with children render an expand/collapse toggle in the tree column.',
                ],
                [
                    'name' => 'expanded',
                    'type' => 'bool',
                    'default' => 'false',
                    'description' => 'Start this branch expanded on first render. Only meaningful on a row that has children.',
                ],
            ],
        ],
    ],
];
