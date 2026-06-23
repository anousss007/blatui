<?php

// API metadata for the terminal component.

return [
    'props' => [
        [
            'name' => 'title',
            'type' => 'string',
            'description' => 'Optional label shown in the title bar, e.g. "~/app — zsh".',
        ],
        [
            'name' => 'buttons',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Show the red/amber/green traffic-light dots in the title bar.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The terminal body — your prompt and output lines. Helper classes are available on descendants: .prompt and .ok (emerald), .dim (muted), .path (cyan), .warn (amber). The window is dark in both light and dark themes.',
        ],
    ],
];
