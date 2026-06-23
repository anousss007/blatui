<?php

// API metadata for the kanban component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'columns',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The board columns, each with its own list of cards. Drag-and-drop reordering is a client-side progressive enhancement and is not persisted.',
            'shape' => 'column',
        ],
    ],

    'shapes' => [
        'column' => [
            'label' => 'Each column',
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'string',
                    'description' => 'Unique column identifier used as the drag/drop key. Falls back to col-{index} when omitted.',
                ],
                [
                    'name' => 'title',
                    'type' => 'string',
                    'description' => 'The column heading shown above its cards. A live card count is appended automatically.',
                ],
                [
                    'name' => 'cards',
                    'type' => 'array',
                    'default' => '[]',
                    'description' => 'The cards in this column, in order.',
                    'shape' => 'card',
                ],
            ],
        ],
        'card' => [
            'label' => 'Each card',
            'fields' => [
                [
                    'name' => 'id',
                    'type' => 'string',
                    'description' => 'Unique card identifier used as the drag key. Falls back to card-{col}-{index} when omitted.',
                ],
                [
                    'name' => 'title',
                    'type' => 'string',
                    'description' => 'The card text shown as its main label.',
                ],
                [
                    'name' => 'tags',
                    'type' => 'array',
                    'description' => 'A list of short label strings rendered as badges under the title.',
                ],
                [
                    'name' => 'meta',
                    'type' => 'string',
                    'description' => 'Optional secondary line (e.g. an assignee or due date) shown at the bottom of the card.',
                ],
            ],
        ],
    ],
];
