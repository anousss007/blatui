<?php

// API metadata for the mention-input component.

return [
    'props' => [
        [
            'name' => 'mentions',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The people (or items) that can be mentioned. Accepts plain strings or associative arrays; each becomes a suggestion in the popup.',
            'shape' => 'mention',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name for the underlying textarea.',
        ],
        [
            'name' => 'trigger',
            'type' => 'string',
            'default' => "'@'",
            'description' => 'Character that opens the suggestion popup when typed at the start of a word.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'Type @ to mention…'",
            'description' => 'Placeholder text for the textarea while it is empty.',
        ],
        [
            'name' => 'rows',
            'type' => 'int',
            'default' => '3',
            'description' => 'Initial visible row count of the textarea. It also auto-grows with content.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'Prefilled textarea content. May also be provided via the default slot.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id applied to the textarea, for pairing with an external label. A random id is generated when omitted.',
        ],
    ],

    'shapes' => [
        'mention' => [
            'label' => 'Each mention',
            'fields' => [
                [
                    'name' => 'value',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The token inserted into the text after the trigger character (e.g. "@ada"). Falls back to label when omitted.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Display name shown in the suggestion list. Falls back to value when omitted.',
                ],
                [
                    'name' => 'sub',
                    'type' => 'string',
                    'description' => 'Secondary line shown under the label (e.g. a team or role).',
                ],
                [
                    'name' => 'avatar',
                    'type' => 'string',
                    'description' => 'Image URL for the avatar. When omitted, the first letter of the label is shown in a circle.',
                ],
            ],
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Optional prefilled textarea content (alternative to the value attribute).',
        ],
    ],
];
