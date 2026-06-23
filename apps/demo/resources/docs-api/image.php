<?php

// API metadata for the image component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'src',
            'type' => 'string',
            'required' => true,
            'description' => 'URL of the image to display. The image lazy-loads and fades in once decoded.',
        ],
        [
            'name' => 'alt',
            'type' => 'string',
            'default' => "''",
            'description' => 'Alternative text for the image. Also shown as a label inside the error fallback when loading fails.',
        ],
        [
            'name' => 'ratio',
            'type' => 'string',
            'description' => 'A CSS aspect-ratio value (e.g. "16/9" or "1/1") applied to the frame so it reserves space before the image loads. Leave unset to size by the image itself.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'URL of a tiny low-resolution image shown blurred while the full image loads. When omitted, an animated skeleton box is used instead.',
        ],
        [
            'name' => 'rounded',
            'type' => 'string',
            'default' => "'rounded-lg'",
            'description' => 'Tailwind corner-rounding utility for the frame. Pass another rounding class to override, or rounded-none for square corners.',
        ],
        [
            'name' => 'fit',
            'type' => 'string',
            'default' => "'cover'",
            'options' => ['cover', 'contain'],
            'description' => 'How the image fills the frame. cover crops to fill; contain fits the whole image inside, leaving padding if the ratios differ.',
        ],
    ],
];
