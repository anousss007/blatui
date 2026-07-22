<?php

// API metadata for the accordion component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'type',
            'type' => 'string',
            'default' => "'single'",
            'options' => ['single', 'multiple'],
            'description' => 'Whether only one item can be open at a time (single) or several at once (multiple).',
        ],
        [
            'name' => 'collapsible',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'In single mode, allow the open item to be closed by clicking it again (leaving all items closed). Ignored in multiple mode.',
        ],
        [
            'name' => 'value',
            'type' => 'string|array',
            'description' => 'The initially open item(s), matched against each item\'s value. A string in single mode, an array of values in multiple mode.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The accordion items. Compose one <x-ui.accordion-item value="..."> per row, each wrapping an <x-ui.accordion-trigger> (the header button) and an <x-ui.accordion-content> (the collapsible panel).',
        ],
    ],
];
