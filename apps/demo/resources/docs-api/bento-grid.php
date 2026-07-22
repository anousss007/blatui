<?php

// API metadata for the bento-grid component.

return [
    'props' => [
        [
            'name' => 'columns',
            'type' => 'int',
            'default' => '3',
            'options' => ['2', '3', '4'],
            'description' => 'Number of columns at the largest breakpoint. The grid is always single-column on mobile and steps up responsively to this count.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The grid cells — typically <x-ui.bento-item> components, which control their own col/row span. You may also place any element with your own grid-span classes.',
        ],
    ],
];
