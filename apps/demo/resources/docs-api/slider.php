<?php

// API metadata for the slider component.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. Single mode submits one hidden input; range mode submits "{name}[min]" and "{name}[max]".',
        ],
        [
            'name' => 'value',
            'type' => 'int|array',
            'default' => '0',
            'description' => 'Current value. In range mode pass a two-element array [low, high].',
        ],
        [
            'name' => 'min',
            'type' => 'int',
            'default' => '0',
            'description' => 'Minimum selectable value.',
        ],
        [
            'name' => 'max',
            'type' => 'int',
            'default' => '100',
            'description' => 'Maximum selectable value.',
        ],
        [
            'name' => 'step',
            'type' => 'int',
            'default' => '1',
            'description' => 'Increment the value snaps to when dragging or using the keyboard.',
        ],
        [
            'name' => 'range',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Enable two thumbs for a min–max range. When true, pass value as [low, high].',
        ],
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'horizontal'",
            'options' => ['horizontal', 'vertical'],
            'description' => 'Layout direction. Vertical mode needs a height on the slider (defaults to h-40).',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disable interaction and dim the control.',
        ],
        [
            'name' => 'ariaLabel',
            'type' => 'string',
            'default' => "'Value'",
            'description' => 'Accessible label for the thumb(s). In range mode it is suffixed with "minimum"/"maximum".',
        ],
    ],
];
