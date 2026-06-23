<?php

// API metadata for the carousel component.

return [
    'props' => [
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Scroll axis. "vertical" needs a fixed height on <x-ui.carousel-content> (e.g. class="h-[240px]").',
        ],
        [
            'name' => 'swipe',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Enable touch/pen swipe to change slides. A mouse always uses the previous/next arrows, regardless of this setting.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The carousel parts, all sharing the root\'s Alpine scope: <x-ui.carousel-content> wrapping one <x-ui.carousel-item> per slide (set a basis class like basis-1/2 on an item to show multiple at once), plus <x-ui.carousel-previous> and <x-ui.carousel-next> arrow buttons.',
        ],
    ],

    'methods' => [
        [
            'name' => 'prev()',
            'description' => 'Move to the previous slide (no-op at the first slide).',
        ],
        [
            'name' => 'next()',
            'description' => 'Move to the next slide (no-op at the last slide).',
        ],
    ],
];
