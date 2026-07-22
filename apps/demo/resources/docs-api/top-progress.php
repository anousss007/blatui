<?php

// API metadata for the top-progress component.

return [
    'props' => [
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'Bar color, any CSS color. Defaults to the primary token (var(--color-primary)).',
        ],
        [
            'name' => 'height',
            'type' => 'int',
            'default' => '2',
            'description' => 'Bar thickness in pixels.',
        ],
        [
            'name' => 'demo',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render the bar in-flow (relative, not fixed) for docs previews. Leave false in production so the bar is fixed to the top of the viewport.',
        ],
    ],

    'methods' => [
        [
            'name' => 'start()',
            'description' => 'Show the bar and begin trickling its width toward ~90%. Also driven by the window event top-progress:start.',
        ],
        [
            'name' => 'set(p)',
            'description' => 'Set the width to the fraction p (0..1). Also driven by top-progress:set with detail.value.',
        ],
        [
            'name' => 'done()',
            'description' => 'Jump to 100%, then fade out and reset. Also driven by the window event top-progress:done.',
        ],
    ],
];
