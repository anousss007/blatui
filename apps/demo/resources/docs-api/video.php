<?php

// API metadata for the video component.

return [
    'props' => [
        [
            'name' => 'src',
            'type' => 'string',
            'description' => 'Video file URL. Alternatively pass your own <source>/<track> elements through the slot.',
        ],
        [
            'name' => 'poster',
            'type' => 'string',
            'description' => 'Image shown before playback begins, behind the play overlay.',
        ],
        [
            'name' => 'aspect',
            'type' => 'string',
            'default' => "'video'",
            'options' => ['video', 'square'],
            'description' => 'Aspect ratio of the frame: "video" is 16/9 and "square" is 1/1. Any other value is treated as a custom CSS ratio such as "4/3".',
        ],
        [
            'name' => 'controls',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the browser\'s native video controls, revealed once playback starts.',
        ],
        [
            'name' => 'autoplay',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Start playing on load. When on, the poster play overlay is omitted.',
        ],
        [
            'name' => 'loop',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Restart the video automatically when it reaches the end.',
        ],
        [
            'name' => 'muted',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Start with audio muted (commonly required alongside autoplay).',
        ],
        [
            'name' => 'rounded',
            'type' => 'string',
            'default' => "'rounded-xl'",
            'description' => 'Tailwind corner-rounding utility applied to the video frame.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Optional <source> and <track> elements placed inside the <video>, used instead of (or in addition to) the src prop.',
        ],
    ],
];
