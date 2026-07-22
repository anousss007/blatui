<?php

// API metadata for the avatar component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'slots' => [
        [
            'name' => 'default',
            'description' => 'The avatar content. Compose an <x-ui.avatar-image src alt /> for the photo and an <x-ui.avatar-fallback> with initials; the fallback shows automatically while the image loads or if it fails. Size and shape are set with utility classes (e.g. size-12, rounded-lg).',
        ],
    ],
];
