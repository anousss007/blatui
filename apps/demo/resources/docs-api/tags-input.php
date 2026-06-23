<?php

// API metadata for the tags-input component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. Each tag is submitted as a hidden input named "{name}[]", so the value arrives as an array.',
        ],
        [
            'name' => 'value',
            'type' => 'array',
            'default' => '[]',
            'description' => 'Initial tags to prefill. Duplicate values are ignored when adding new tags.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'Add tag…'",
            'description' => 'Placeholder text shown in the text field while it is empty.',
        ],
        [
            'name' => 'max',
            'type' => 'int',
            'description' => 'Maximum number of tags allowed. Once reached, the input is disabled until a tag is removed. No limit when omitted.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable the whole control: no tags can be added or removed.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id applied to the inner text field, for pairing with an external label.',
        ],
    ],

    'methods' => [
        [
            'name' => 'add()',
            'description' => 'Commits the current draft as a tag (trimmed). No-op when empty, a duplicate, or at the max. Also fired on Enter, comma, and blur.',
        ],
        [
            'name' => 'remove(i)',
            'description' => 'Removes the tag at index i. Ignored when the control is disabled.',
        ],
    ],
];
