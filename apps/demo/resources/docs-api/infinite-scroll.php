<?php

// API metadata for the infinite-scroll component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'threshold',
            'type' => 'int',
            'default' => '200',
            'description' => 'Distance in pixels before the sentinel reaches the scroll edge at which loadMore() fires. Mapped to the IntersectionObserver rootMargin so loading begins a little ahead of the actual edge.',
        ],
    ],

    'slots' => [
        [
            'name' => 'default',
            'description' => 'Your initial items. The component appends a loading indicator, a "Load more" button (keyboard / no-JS fallback) and an invisible sentinel after the slot content.',
        ],
    ],

    'methods' => [
        [
            'name' => 'loadMore()',
            'description' => 'Sets the loading state and dispatches a cancelable "load-more" event. Listen for it (Livewire / fetch) to append rows, then call detail.loaded() / detail.done() or dispatch "load-more-done" on the root. No-op while already loading or finished.',
        ],
        [
            'name' => 'loaded()',
            'description' => 'Clears the loading state after a batch of items has been appended, re-arming the observer for the next page.',
        ],
        [
            'name' => 'finish()',
            'description' => 'Marks the list complete: hides the sentinel and Load more button and shows the end-of-list message.',
        ],
    ],
];
