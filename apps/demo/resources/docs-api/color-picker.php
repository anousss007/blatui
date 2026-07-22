<?php

// API metadata for the color-picker component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "'#6366f1'",
            'description' => 'The initial colour as a hex string (#rgb or #rrggbb). Normalized to lower-case #rrggbb on init.',
        ],
        [
            'name' => 'swatches',
            'type' => 'array',
            'description' => 'Preset hex colours shown in the swatch grid. Falls back to a built-in 10-colour palette when omitted.',
        ],
        [
            'name' => 'inline',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Render the picker panel inline (always visible) instead of inside a popover with a trigger button.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable the trigger button (popover mode) so the panel cannot be opened.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'When set, renders a hidden input with this name so the selected hex submits with a form.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id for the hex text field. A random id is generated when omitted.',
        ],
    ],

    'methods' => [
        [
            'name' => 'pick(hex)',
            'description' => 'Select a colour by hex string (ignored when it does not parse). Used by the swatch buttons.',
        ],
        [
            'name' => 'setHue(h)',
            'description' => 'Set the colour from a hue value (0–360) using the hue slider.',
        ],
        [
            'name' => 'commit(value)',
            'description' => 'Validate and commit a typed hex value; only applied when it parses.',
        ],
    ],
];
