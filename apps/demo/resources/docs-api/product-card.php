<?php

// API metadata for the product-card component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'title',
            'type' => 'string',
            'required' => true,
            'description' => 'The product name shown as the card heading. Also used as the image alt text when imageAlt is omitted.',
        ],
        [
            'name' => 'image',
            'type' => 'string',
            'required' => true,
            'description' => 'URL of the product image rendered in the square media area.',
        ],
        [
            'name' => 'imageAlt',
            'type' => 'string',
            'default' => "''",
            'description' => 'Alt text for the image. Falls back to the title when empty so the image is never unlabelled.',
        ],
        [
            'name' => 'href',
            'type' => 'string',
            'description' => 'Optional link for the product. When set, the title becomes an anchor to this URL.',
        ],
        [
            'name' => 'price',
            'type' => 'number',
            'description' => 'Current price. When set, a <x-ui.price> block renders; omit to hide pricing entirely.',
        ],
        [
            'name' => 'compareAt',
            'type' => 'number',
            'description' => 'Original (strikethrough) price. When greater than price, the card shows the sale styling and discount badge.',
        ],
        [
            'name' => 'currency',
            'type' => 'string',
            'default' => "'$'",
            'description' => 'Currency symbol prefixed to the price and compare-at price.',
        ],
        [
            'name' => 'badge',
            'type' => 'string',
            'description' => 'Corner badge label over the image. Its tone is inferred from the text: "sale"/"off"/"%" read as danger, "new" as success, otherwise neutral.',
        ],
        [
            'name' => 'category',
            'type' => 'string',
            'description' => 'Small muted label shown above the title (e.g. "Audio").',
        ],
        [
            'name' => 'rating',
            'type' => 'number',
            'description' => 'Star rating out of 5, shown read-only above the price. Omit to hide the rating row.',
        ],
        [
            'name' => 'reviews',
            'type' => 'int',
            'description' => 'Review count shown in parentheses next to the rating. Only rendered when rating is set.',
        ],
        [
            'name' => 'wishlist',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Show a toggleable heart button in the top corner of the image.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Custom action area at the bottom of the card (e.g. your own add-to-cart form). When empty, a default "Add to cart" button is rendered.',
        ],
    ],
];
