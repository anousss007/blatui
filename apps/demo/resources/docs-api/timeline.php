<?php

// API metadata for the timeline component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'item',
            'type' => 'props',
            'description' => 'The timeline itself takes no props — it is composed by nesting <x-ui.timeline-item> in the default slot. Each item accepts the props below.',
            'shape' => 'item',
        ],
    ],

    'shapes' => [
        'item' => [
            'label' => 'Each <x-ui.timeline-item>',
            'fields' => [
                [
                    'name' => 'icon',
                    'type' => 'string',
                    'description' => 'A lucide icon name shown inside the marker dot. Omit for a small solid dot instead.',
                ],
                [
                    'name' => 'time',
                    'type' => 'string',
                    'description' => 'Optional timestamp or eyebrow text shown above the title.',
                ],
                [
                    'name' => 'title',
                    'type' => 'string',
                    'description' => 'Optional bold title for the event. Free-form content can also go in the item slot.',
                ],
                [
                    'name' => 'active',
                    'type' => 'bool',
                    'default' => 'false',
                    'description' => 'Highlights the marker dot in the primary colour to mark the current or latest event.',
                ],
            ],
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'One <x-ui.timeline-item> per event, in order. The connector line is automatically hidden under the last item.',
        ],
    ],
];
