<?php

// API metadata for the autosize-textarea component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Name of the textarea, used for form submission.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Placeholder shown while the field is empty.',
        ],
        [
            'name' => 'minRows',
            'type' => 'int',
            'default' => '2',
            'description' => 'Initial number of visible text rows; the field never shrinks below this.',
        ],
        [
            'name' => 'maxRows',
            'type' => 'int',
            'description' => 'Maximum rows the field grows to before it stops expanding and scrolls. Unlimited when not set.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Minimum height, padding and text size; matches the textarea component.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the field and dims it.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'id attribute of the textarea, for associating an external label.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'Initial text content. Takes precedence over slot text when set.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Initial text content, used as a fallback when the value prop is not set.',
        ],
    ],
];
