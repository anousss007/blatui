<?php

// API metadata for the table component.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'card'],
            'description' => 'Container style. "card" wraps the table in a bordered, rounded surface on bg-card; "default" is a plain horizontally scrollable wrapper.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The table structure, composed from the sub-components: <x-ui.table-caption>, <x-ui.table-header>, <x-ui.table-body> and <x-ui.table-footer>, each holding <x-ui.table-row> with <x-ui.table-head> or <x-ui.table-cell> children.',
        ],
    ],
];
