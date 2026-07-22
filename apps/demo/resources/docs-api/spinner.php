<?php

// API metadata for the spinner component.

return [
    'props' => [
        [
            'name' => 'icon',
            'type' => 'string',
            'default' => "'loader-circle'",
            'description' => 'Any Lucide icon name to spin (e.g. loader-circle, rotate-cw, loader-pinwheel). The icon is rendered with animate-spin and an aria-label of "Loading".',
        ],
    ],
];
