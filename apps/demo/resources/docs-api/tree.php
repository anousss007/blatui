<?php

// API metadata for the tree component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'items',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The top-level tree nodes. Nodes are rendered recursively; arrow keys move focus across visible rows and Enter/Space toggle a parent.',
            'shape' => 'node',
        ],
    ],

    'shapes' => [
        'node' => [
            'label' => 'Each node',
            'fields' => [
                [
                    'name' => 'label',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The text shown for the node and its accessible name.',
                ],
                [
                    'name' => 'icon',
                    'type' => 'string',
                    'description' => 'A lucide icon name for a leaf node. Ignored for parents, which show folder / folder-open icons automatically.',
                ],
                [
                    'name' => 'children',
                    'type' => 'array',
                    'description' => 'Child nodes (same shape). Presence of children makes the node an expandable parent.',
                    'shape' => 'node',
                ],
                [
                    'name' => 'expanded',
                    'type' => 'bool',
                    'default' => 'false',
                    'description' => 'Seed the open state for a parent node so it renders expanded on first paint.',
                ],
            ],
        ],
    ],
];
