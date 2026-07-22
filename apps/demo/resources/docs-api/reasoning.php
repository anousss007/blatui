<?php

// API metadata for the reasoning component.

return [
    'props' => [
        [
            'name' => 'open',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Whether the reasoning content is expanded on first render.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Reasoning'",
            'description' => 'Text shown on the toggle button. Ignored when a duration is set.',
        ],
        [
            'name' => 'duration',
            'type' => 'string',
            'description' => 'When set, the trigger reads "Thought for {duration}" instead of the label (e.g. "12s").',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Explicit id for the collapsible content region. Defaults to an auto-generated id used for aria-controls.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The reasoning text or markup revealed when the disclosure is expanded.',
        ],
    ],
];
