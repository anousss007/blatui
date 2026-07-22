<?php

// API metadata for the banner component.

return [
    'props' => [
        [
            'name' => 'tone',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'primary', 'info', 'success', 'warning', 'danger'],
            'description' => 'Semantic colour of the announcement bar.',
        ],
        [
            'name' => 'dismissible',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show a close button that hides the banner.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Stable identifier used as the localStorage key when persist is enabled. Required for persistence to work.',
        ],
        [
            'name' => 'persist',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Remember the dismissal in localStorage so the banner stays closed on return. Requires id.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The announcement content, centered in the bar — e.g. a message and a link or button.',
        ],
    ],

    'methods' => [
        [
            'name' => 'dismiss()',
            'description' => 'Hides the banner and, when persist + id are set, records the dismissal in localStorage.',
        ],
    ],
];
