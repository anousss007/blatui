<?php

// API metadata for the chat component.

return [
    'slots' => [
        [
            'name' => 'default',
            'description' => 'The message thread. Drop <x-ui.chat-message> children here. The container is a scrollable, keyboard-focusable region with role="log" and aria-live="polite", so new messages are announced. Set its height (e.g. class="h-80") to enable scrolling.',
        ],
    ],
];
