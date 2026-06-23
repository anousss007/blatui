<?php

// API metadata for the citation component.

return [
    'props' => [
        [
            'name' => 'index',
            'type' => 'int',
            'default' => '1',
            'description' => 'The source number shown inside the inline marker and in its accessible label.',
        ],
        [
            'name' => 'title',
            'type' => 'string',
            'description' => 'The source title shown at the top of the hover/focus popover.',
        ],
        [
            'name' => 'url',
            'type' => 'string',
            'description' => 'The source link. The popover shows the cleaned host (www stripped) as an external link.',
        ],
        [
            'name' => 'snippet',
            'type' => 'string',
            'description' => 'A short excerpt or note shown beneath the link in the popover.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Extra markup appended inside the popover, below the title, link and snippet.',
        ],
    ],
];
