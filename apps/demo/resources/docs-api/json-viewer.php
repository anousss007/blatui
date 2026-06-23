<?php

// API metadata for the json-viewer component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'data',
            'type' => 'array|object|string',
            'required' => true,
            'description' => 'The value to display. Accepts a PHP array or object, or a JSON string — all are normalized to a recursable value and rendered as a collapsible tree.',
        ],
        [
            'name' => 'expanded',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Seed the open state of collapsible nodes. Set false to render every object/array collapsed initially.',
        ],
        [
            'name' => 'rootLabel',
            'type' => 'string',
            'description' => 'Optional label shown in the header before the root node (e.g. "response"). Defaults to "JSON".',
        ],
    ],
];
