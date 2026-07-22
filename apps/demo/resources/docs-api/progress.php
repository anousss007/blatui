<?php

// API metadata for the progress component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'number',
            'default' => '0',
            'description' => 'Current progress, clamped to the 0-100 range. Ignored when indeterminate is true.',
        ],
        [
            'name' => 'indeterminate',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show an animated indeterminate state (no aria-valuenow) for work of unknown duration.',
        ],
        [
            'name' => 'ariaLabel',
            'type' => 'string',
            'default' => "'Progress'",
            'description' => 'Accessible name for the progressbar role.',
        ],
        [
            'name' => 'circular',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render a circular ring instead of the default linear bar.',
        ],
        [
            'name' => 'size',
            'type' => 'int',
            'default' => '64',
            'description' => 'Circular only: ring diameter in pixels.',
        ],
        [
            'name' => 'thickness',
            'type' => 'int',
            'default' => '6',
            'description' => 'Circular only: ring stroke width in pixels.',
        ],
        [
            'name' => 'showValue',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Circular only: render the percentage in the centre of the ring (hidden while indeterminate).',
        ],
    ],
];
