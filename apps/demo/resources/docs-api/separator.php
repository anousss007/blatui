<?php

// API metadata for the separator component.

return [
    'props' => [
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Direction of the divider. Horizontal draws a full-width 1px line; vertical draws a full-height 1px line (give the parent a height for it to show).',
        ],
        [
            'name' => 'decorative',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'When true the line is purely visual and hidden from assistive tech. Set false when the divider conveys meaning, so it exposes role="separator" with the orientation.',
        ],
    ],
];
