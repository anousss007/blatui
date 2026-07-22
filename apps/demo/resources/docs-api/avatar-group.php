<?php

// API metadata for the avatar-group component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'avatars',
            'type' => 'array',
            'default' => '[]',
            'required' => true,
            'description' => 'The people to display, in order. Each renders an overlapping avatar; missing or failed images fall back to initials derived from the name.',
            'shape' => 'avatar',
        ],
        [
            'name' => 'max',
            'type' => 'int',
            'default' => '4',
            'description' => 'Maximum number of avatars to render. Any remainder is collapsed into a trailing "+N" counter.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Avatar size, which also scales the overlap, ring width and initials text.',
        ],
    ],

    'shapes' => [
        'avatar' => [
            'label' => 'Each avatar',
            'fields' => [
                [
                    'name' => 'src',
                    'type' => 'string',
                    'description' => 'Image URL for the avatar. Omit it to render initials only.',
                ],
                [
                    'name' => 'name',
                    'type' => 'string',
                    'description' => 'Person name, used for the title tooltip and to derive up-to-two-letter initials (e.g. "Ada Lovelace" becomes "AL") when no image is shown.',
                ],
            ],
        ],
    ],
];
