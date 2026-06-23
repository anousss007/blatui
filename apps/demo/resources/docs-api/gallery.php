<?php

// API metadata for the gallery component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'images',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The images to display. Each item is either a plain URL string or an array describing the thumbnail and the full-size image opened in the lightbox.',
            'shape' => 'image',
        ],
        [
            'name' => 'columns',
            'type' => 'int',
            'default' => '3',
            'options' => ['1', '2', '3', '4', '5', '6'],
            'description' => 'Number of thumbnail columns in the grid. Clamped to the 1-6 range.',
        ],
        [
            'name' => 'rounded',
            'type' => 'string',
            'default' => "'rounded-lg'",
            'description' => 'Tailwind corner-rounding utility applied to each thumbnail.',
        ],
    ],

    'shapes' => [
        'image' => [
            'label' => 'Each image',
            'fields' => [
                [
                    'name' => 'src',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'URL of the full-size image shown in the lightbox.',
                ],
                [
                    'name' => 'thumb',
                    'type' => 'string',
                    'description' => 'URL of a smaller image for the grid thumbnail. Falls back to src when omitted.',
                ],
                [
                    'name' => 'alt',
                    'type' => 'string',
                    'default' => "''",
                    'description' => 'Description of the image, used for the thumbnail alt text and the accessible button label.',
                ],
            ],
        ],
    ],
];
