<?php

// API metadata for the rating component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'number',
            'default' => '0',
            'description' => 'The initial rating, from 0 to max. Drives which icons are filled.',
        ],
        [
            'name' => 'max',
            'type' => 'int',
            'default' => '5',
            'description' => 'The number of icons rendered, i.e. the highest possible rating.',
        ],
        [
            'name' => 'readonly',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render a non-interactive display rating. Buttons are disabled and removed from the tab order.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Icon size.',
        ],
        [
            'name' => 'icon',
            'type' => 'string',
            'default' => "'star'",
            'description' => 'Any Lucide icon name to use for each rating unit (e.g. star, heart).',
        ],
        [
            'name' => 'color',
            'type' => 'string',
            'default' => "'text-amber-500'",
            'description' => 'Tailwind text-color class applied to filled icons. Empty icons use a muted tone.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'When set, renders a hidden input with this name so the current value submits with a form. Also used as the group aria-label.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id for the hidden input, applied only when name is set.',
        ],
    ],
];
