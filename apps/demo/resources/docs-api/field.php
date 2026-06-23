<?php

// API metadata for the field component.

return [
    'props' => [
        [
            'name' => 'orientation',
            'type' => 'string',
            'default' => "'vertical'",
            'options' => ['vertical', 'horizontal', 'responsive'],
            'description' => 'Layout of the label/control/description. "vertical" stacks them, "horizontal" places the control beside the content, and "responsive" stacks on small screens and goes horizontal at the @md breakpoint of a field-group container.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The field contents — typically an x-ui.field-label, the form control, and an x-ui.field-description or x-ui.field-error. Wrap label and description in x-ui.field-content when using horizontal orientation.',
        ],
    ],
];
