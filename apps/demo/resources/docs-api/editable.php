<?php

// API metadata for the editable component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'value',
            'type' => 'string',
            'default' => "''",
            'description' => 'The current value shown in display mode and seeded into the editor.',
        ],
        [
            'name' => 'as',
            'type' => 'string',
            'default' => "'input'",
            'options' => ['input', 'textarea'],
            'description' => 'Editor field type — a single-line input or a multi-line textarea.',
        ],
        [
            'name' => 'label',
            'type' => 'string',
            'default' => "'value'",
            'description' => 'Accessible label used for the editor field and the "Edit {label}" trigger.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Text shown when the value is empty (in both display and editing states).',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Field padding and typography.',
        ],
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'When set, renders a hidden input with this name so the committed value submits with a form.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'Id for the hidden input, applied only when name is set.',
        ],
    ],

    'methods' => [
        [
            'name' => 'edit()',
            'description' => 'Enter editing mode, copy the value into the draft, and focus/select the field.',
        ],
        [
            'name' => 'save()',
            'description' => 'Commit the draft to the value and return to display mode.',
        ],
        [
            'name' => 'cancel()',
            'description' => 'Discard the draft and return to display mode.',
        ],
    ],
];
