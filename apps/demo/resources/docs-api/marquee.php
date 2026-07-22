<?php

// API metadata for the marquee component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'direction',
            'type' => 'string',
            'default' => "'left'",
            'options' => ['left', 'right', 'up', 'down'],
            'description' => 'Scroll direction. The vertical directions (up, down) require a fixed height on the element.',
        ],
        [
            'name' => 'duration',
            'type' => 'string',
            'default' => "'40s'",
            'description' => 'CSS time for one full loop. Larger values scroll more slowly.',
        ],
        [
            'name' => 'gap',
            'type' => 'string',
            'default' => "'1rem'",
            'description' => 'CSS length for the spacing between items and between the two repeated groups.',
        ],
        [
            'name' => 'pauseOnHover',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Pause the scroll while the pointer is over the marquee.',
        ],
        [
            'name' => 'fade',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Fade the leading and trailing edges with a CSS mask.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The items to scroll (logos, testimonials, badges). The content is duplicated for a seamless loop; the duplicate is aria-hidden so screen readers read it once. Animation is disabled under prefers-reduced-motion.',
        ],
    ],
];
