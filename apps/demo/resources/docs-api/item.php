<?php

// API metadata for the item component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'outline', 'muted'],
            'description' => 'Visual style of the row container.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'sm'],
            'description' => 'Padding and inner gap density of the row.',
        ],
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'When set, the row renders as an <a> link (with hover affordance) instead of a <div>.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Row contents, composed from the item sub-components: <x-ui.item-media> (leading icon/avatar/image, variant default|icon|image), <x-ui.item-content> (wrapping <x-ui.item-title> and <x-ui.item-description>), and <x-ui.item-actions> (trailing controls). Wrap multiple items in <x-ui.item-group> and separate them with <x-ui.item-separator>.',
        ],
    ],
];
