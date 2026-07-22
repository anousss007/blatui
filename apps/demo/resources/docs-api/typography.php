<?php

// API metadata for the typography component.

return [
    'props' => [
        [
            'name' => 'variant',
            'type' => 'string',
            'default' => "'p'",
            'options' => ['h1', 'h2', 'h3', 'h4', 'p', 'lead', 'large', 'small', 'muted', 'blockquote', 'inline-code', 'list', 'gradient'],
            'description' => 'The text style to apply. Each variant maps to a sensible default HTML tag (e.g. h1-h4 to headings, p/lead/muted to paragraphs, list to a ul, inline-code to a code element, gradient to an h1 with a gradient clip).',
        ],
        [
            'name' => 'as',
            'type' => 'string',
            'description' => 'Override the rendered HTML tag for the chosen variant. Useful for keeping a style while fixing the document outline (e.g. variant="h1" with as="h2"), or to render list content as an ol.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'The text content to render with the variant\'s styling. For the list variant, pass <li> items.',
        ],
    ],
];
