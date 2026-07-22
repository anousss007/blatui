<?php

// API metadata for the sonner component.

return [
    'props' => [
        [
            'name' => 'position',
            'type' => 'string',
            'default' => "'bottom-right'",
            'options' => ['top-left', 'top-center', 'top-right', 'bottom-left', 'bottom-center', 'bottom-right'],
            'description' => 'Where the toast stack is anchored on screen.',
        ],
        [
            'name' => 'expand',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Keep toasts always expanded as a list. When false the toasts collapse into a stack that fans out on hover or focus.',
        ],
    ],

    'methods' => [
        [
            'name' => 'window.toast(opts)',
            'description' => 'Show a toast. Pass a string (the title) or an options object: { title, description, type, duration, action: { label, onClick } }. type is one of default, success, error, warning, info, loading; duration is ms (Infinity to keep it until dismissed).',
        ],
        [
            'name' => 'window.toast.success(msg)',
            'description' => 'Shortcut for a success toast. Also available: toast.error, toast.warning, toast.info, toast.loading.',
        ],
        [
            'name' => 'window.toast.promise(p, opts)',
            'description' => 'Show a loading toast that resolves to success or error when the promise settles. opts is { loading, success, error }.',
        ],
    ],
];
