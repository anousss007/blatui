<?php

// API metadata for the aurora component.

return [
    'props' => [
        [
            'name' => 'colors',
            'type' => 'array',
            'description' => 'CSS colour strings for the drifting aurora blobs, overriding the default cyan/violet/emerald/magenta palette. The list is cycled if there are more blob positions than colours. When overriding, bring your own scrim in the slot to keep overlaid text legible.',
        ],
        [
            'name' => 'blur',
            'type' => 'number',
            'default' => '60',
            'description' => 'Blur radius in pixels applied to the aurora layer. Higher values make the colours softer and more diffuse.',
        ],
        [
            'name' => 'speed',
            'type' => 'number',
            'default' => '12',
            'description' => 'Seconds for one full drift and rotation cycle. The drift is disabled under prefers-reduced-motion.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The foreground content shown over the aurora, inside padded container. The decorative aurora layer is aria-hidden, so only this content is read by assistive tech.',
        ],
    ],
];
