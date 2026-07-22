<?php

// API metadata for the pagination component.

return [
    'slots' => [
        [
            'name' => 'default',
            'description' => 'The pager composition. Wrap items in <x-ui.pagination-content>, then one <x-ui.pagination-item> per control: <x-ui.pagination-previous href> and <x-ui.pagination-next href> for the arrows, <x-ui.pagination-link href> for page numbers (pass isActive on the current page), and <x-ui.pagination-ellipsis> for gaps. Page links accept a size of default, sm, lg or icon.',
        ],
    ],
];
