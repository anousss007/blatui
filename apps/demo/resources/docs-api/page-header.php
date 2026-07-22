<?php

// API metadata for the page-header component.

return [
    'props' => [
        [
            'name' => 'title',
            'type' => 'string',
            'description' => 'The page title. May also be supplied through the default slot instead of this prop.',
        ],
        [
            'name' => 'description',
            'type' => 'string',
            'description' => 'Supporting copy shown under the title. May also be supplied through the description named slot.',
        ],
        [
            'name' => 'separator',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'When true, draws a bottom border with padding under the header to divide it from the page content.',
        ],
        [
            'name' => 'as',
            'type' => 'string',
            'default' => "'h1'",
            'options' => ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            'description' => 'Heading level used to render the title element.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Alternative way to provide the title content (used when the title prop is omitted).',
        ],
        [
            'name' => 'description',
            'description' => 'Alternative way to provide the supporting copy (used when the description prop is omitted).',
        ],
        [
            'name' => 'breadcrumb',
            'description' => 'Optional breadcrumb trail rendered above the title row, e.g. a <x-ui.breadcrumb>.',
        ],
        [
            'name' => 'actions',
            'description' => 'Action buttons aligned to the end of the title row (right on wide screens, below the title on mobile).',
        ],
    ],
];
