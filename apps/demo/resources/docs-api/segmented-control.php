<?php

// API metadata for the segmented-control component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'options',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The segments to render. Each entry may be a plain string (used as both value and label) or an associative array with value, label, and an optional icon.',
            'shape' => 'option',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'The value of the segment that starts selected, matched against each option\'s value.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name for the underlying radio group; the selection submits with a form. A random name is generated when omitted.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Height and padding of the control.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables every segment so the selection cannot change.',
        ],
    ],

    'shapes' => [
        'option' => [
            'label' => 'Each option',
            'fields' => [
                [
                    'name' => 'value',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The submitted value for this segment. Falls back to label when omitted.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'Visible text for the segment. Falls back to value when omitted.',
                ],
                [
                    'name' => 'icon',
                    'type' => 'string',
                    'description' => 'Optional Lucide icon name (e.g. "list") shown before the label.',
                ],
            ],
        ],
    ],
];
