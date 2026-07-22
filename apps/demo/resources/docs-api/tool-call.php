<?php

// API metadata for the tool-call component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'default' => "'tool'",
            'description' => 'The tool name shown in the header, rendered in a monospace font.',
        ],
        [
            'name' => 'status',
            'type' => 'string',
            'default' => "'success'",
            'options' => ['pending', 'running', 'success', 'error'],
            'description' => 'Execution state. Drives the header icon and label; an invalid value falls back to success.',
        ],
        [
            'name' => 'args',
            'type' => 'string|array',
            'description' => 'The arguments passed to the tool. Arrays/objects are pretty-printed as JSON; other values are cast to string.',
        ],
        [
            'name' => 'result',
            'type' => 'string|array',
            'description' => 'The tool result. Arrays/objects are pretty-printed as JSON; other values are cast to string. Rendered in red when status is error.',
        ],
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the arguments/result body is expanded on first render.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Optional identifier emitted as a data-tool-id attribute on the trigger for targeting from scripts.',
        ],
    ],
];
