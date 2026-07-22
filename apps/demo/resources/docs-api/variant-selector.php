<?php

// API metadata for the variant-selector component.

return [
    'props' => [
        [
            'name' => 'options',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The selectable variants, rendered as an accessible radio group. Pass a flat list of strings, or arrays for per-option labels, swatch colors, and disabling.',
            'shape' => 'option',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'The value of the option that is initially checked. Matched against each option\'s value (string comparison).',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'The name attribute shared by the radio inputs, so the selection submits with a form. Defaults to a generated unique name when omitted.',
        ],
        [
            'name' => 'type',
            'type' => 'string',
            'default' => "'pill'",
            'options' => ['pill', 'color'],
            'description' => 'Visual style of the options. "pill" renders labelled chips; "color" renders round swatches tinted by each option\'s color with a checkmark on the selected one.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'Variant'",
            'description' => 'The visible group label, which also names the radio group for assistive tech. Pass an empty/false value to hide it.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables every option in the group. Individual options can also be disabled via their own disabled key.',
        ],
    ],

    'shapes' => [
        'option' => [
            'label' => 'Each option',
            'fields' => [
                [
                    'name' => 'value',
                    'type' => 'string',
                    'description' => 'The submitted value for this option. Falls back to label when omitted. When the option is a plain string, that string is used as both value and label.',
                ],
                [
                    'name' => 'label',
                    'type' => 'string',
                    'description' => 'The text shown on the pill (or the accessible name / tooltip of a color swatch). Falls back to value when omitted.',
                ],
                [
                    'name' => 'color',
                    'type' => 'string',
                    'description' => 'Any CSS color used to fill the swatch. Only applies when type is "color".',
                ],
                [
                    'name' => 'disabled',
                    'type' => 'bool',
                    'default' => 'false',
                    'description' => 'Makes just this option unselectable.',
                ],
            ],
        ],
    ],
];
