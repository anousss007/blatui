<?php

// API metadata for the quote component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'author',
            'type' => 'string',
            'description' => 'Name of the person quoted, shown in the attribution and used as the avatar alt text.',
        ],
        [
            'name' => 'role',
            'type' => 'string',
            'description' => 'The author\'s title or company, shown under the name.',
        ],
        [
            'name' => 'avatar',
            'type' => 'string',
            'description' => 'URL of the author\'s photo, shown as a round thumbnail beside the attribution.',
        ],
        [
            'name' => 'cite',
            'type' => 'string',
            'description' => 'URL the quote is sourced from. Sets the cite attribute on the <blockquote>.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The quote text rendered inside the <blockquote>. The attribution figcaption only appears when author, role or avatar is set.',
        ],
    ],
];
