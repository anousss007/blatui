<?php

// API metadata for the data-table component.

return [
    'props' => [
        [
            'name' => 'columns',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The column definitions. The order here sets the column order, and each column reads its value from the matching key in every row.',
            'shape' => 'column',
        ],
        [
            'name' => 'rows',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The data rows as an array of associative arrays. Each row is keyed by the column keys (e.g. ["name" => "...", "email" => "..."]). Filtering, sorting and pagination all run client-side in Alpine.',
        ],
        [
            'name' => 'searchable',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the search input above the table.',
        ],
        [
            'name' => 'searchKey',
            'type' => 'string',
            'description' => 'Restrict searching to a single column key. When omitted, the search matches across all column keys.',
        ],
        [
            'name' => 'searchPlaceholder',
            'type' => 'string',
            'default' => "'Search...'",
            'description' => 'Placeholder text for the search input.',
        ],
        [
            'name' => 'selectable',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show row checkboxes plus a select-all checkbox in the header, and report the selected count in the footer.',
        ],
        [
            'name' => 'pageSize',
            'type' => 'int',
            'default' => '5',
            'description' => 'Number of rows shown per page.',
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
                    'description' => 'The header text. Defaults to the capitalized key.',
                ],
                [
                    'name' => 'sortable',
                    'type' => 'bool',
                    'default' => 'true',
                    'description' => 'Whether clicking the header sorts by this column (numeric when both values parse as numbers, otherwise locale string compare).',
                ],
                [
                    'name' => 'class',
                    'type' => 'string',
                    'description' => 'Extra CSS classes applied to this column\'s header and cells, e.g. "text-right".',
                ],
            ],
        ],
    ],
];
