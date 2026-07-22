<?php

// API metadata for the comparison-slider component.

return [
    'props' => [
        [
            'name' => 'after',
            'type' => 'string',
            'required' => true,
            'description' => 'Image src for the "after" side. This is the full base layer rendered underneath.',
        ],
        [
            'name' => 'before',
            'type' => 'string',
            'required' => true,
            'description' => 'Image src for the "before" side. This layer is clipped on top, revealed up to the divider position.',
        ],
        [
            'name' => 'beforeLabel',
            'type' => 'string',
            'description' => 'Optional caption shown in the top corner of the "before" side (e.g. "Before").',
        ],
        [
            'name' => 'afterLabel',
            'type' => 'string',
            'description' => 'Optional caption shown in the top corner of the "after" side (e.g. "After").',
        ],
        [
            'name' => 'beforeAlt',
            'type' => 'string',
            'default' => "''",
            'description' => 'Alt text for the before image.',
        ],
        [
            'name' => 'afterAlt',
            'type' => 'string',
            'default' => "''",
            'description' => 'Alt text for the after image.',
        ],
        [
            'name' => 'value',
            'type' => 'int',
            'default' => '50',
            'description' => 'Initial divider position as a percentage from 0 to 100.',
        ],
    ],
];
