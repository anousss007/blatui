<?php

// API metadata for the phone-input component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Name of the phone-number input. When set, two extra hidden inputs (<name>_country and <name>_dial) are submitted alongside it.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'id attribute of the phone-number input, for associating an external label.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'description' => 'Initial national phone number (the part after the dial code).',
        ],
        [
            'name' => 'country',
            'type' => 'string',
            'default' => "'US'",
            'description' => 'ISO 3166 alpha-2 code of the country selected by default. Must match one of the built-in countries (US, GB, CA, AU, FR, DE, ES, IT, NL, BE, IN, JP, BR, MX, MA, AE).',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'default' => "'Phone number'",
            'description' => 'Placeholder shown in the number field while empty.',
        ],
    ],
];
