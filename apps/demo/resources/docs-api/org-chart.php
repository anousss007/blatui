<?php

// API metadata for the org-chart component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'root',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The single root node of the hierarchy. Children nest recursively to any depth, each drawn as a centered card joined by connector lines.',
            'shape' => 'node',
        ],
        [
            'name' => 'data',
            'type' => 'array',
            'description' => 'Alias for root. When both are set and non-empty, data wins.',
            'shape' => 'node',
        ],
    ],

    'shapes' => [
        'node' => [
            'label' => 'Each node',
            'fields' => [
                [
                    'name' => 'name',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Person or unit name shown on the card. Its first two words seed the initials fallback when no avatar is given.',
                ],
                [
                    'name' => 'title',
                    'type' => 'string',
                    'description' => 'Optional role or subtitle shown under the name.',
                ],
                [
                    'name' => 'avatar',
                    'type' => 'string',
                    'description' => 'Optional avatar image URL. Falls back to the name initials when omitted.',
                ],
                [
                    'name' => 'children',
                    'type' => 'array',
                    'description' => 'Optional list of child nodes (same shape), laid out in a row beneath this card.',
                    'shape' => 'node',
                ],
            ],
        ],
    ],
];
