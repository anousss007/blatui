<?php

// API metadata for the icon component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'required' => true,
            'description' => 'The Lucide icon name (without the "lucide-" prefix), e.g. "arrow-right". Renders the matching <x-lucide-*> component. Directional arrow/chevron/caret icons with a left/right direction are auto-mirrored under RTL.',
        ],
    ],
];
