<?php

// API metadata for the button component.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'destructive', 'outline', 'secondary', 'ghost', 'link'],
            'description' => 'Visual style of the button.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['default', 'xs', 'sm', 'lg', 'icon', 'icon-xs', 'icon-sm', 'icon-lg'],
            'description' => 'Height and padding. The icon-* sizes make a square button sized for a single icon.',
        ],
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'When set, the button renders as an <a> with this href (unless overridden by as).',
        ],
        [
            'name' => 'type',
            'type' => 'string',
            'default' => "'button'",
            'description' => 'The HTML type attribute, emitted only when the element is a real <button> (e.g. submit).',
        ],
        [
            'name' => 'as',
            'type' => 'string',
            'description' => 'Force a specific HTML tag (e.g. label, div). Overrides the automatic a-vs-button choice.',
        ],
        [
            'name' => 'color',
            'type' => 'string',
            'description' => 'Any CSS color that recolors the button by overriding the primary/secondary/ring tokens on this element only.',
        ],
        [
            'name' => 'colorForeground',
            'type' => 'string',
            'default' => "'#ffffff'",
            'description' => 'Label color paired with color. Defaults to white when color is set.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The button label and any inline icons. SVGs are auto-sized and spaced via the gap.',
        ],
        [
            'name' => 'before',
            'description' => 'Icon or content hoisted to the start of the label, before the default slot.',
        ],
        [
            'name' => 'after',
            'description' => 'Icon or content appended to the end of the label, after the default slot.',
        ],
    ],
];
