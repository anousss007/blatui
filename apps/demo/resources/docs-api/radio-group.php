<?php

// API metadata for the radio-group component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Form field name. When set, a hidden input mirrors the selected value so the group submits with a form.',
        ],
        [
            'name' => 'value',
            'type' => 'string',
            'description' => 'The initially selected option, matched against each item\'s value. Leave unset for no default selection.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The radio items — place one or more <x-ui.radio-group-item> (typically paired with an <x-ui.label>) here. They share the group\'s Alpine scope, which drives selection and roving arrow-key focus.',
        ],
    ],
];
