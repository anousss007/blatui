<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third-party registries
    |--------------------------------------------------------------------------
    |
    | Map a namespace to a registry-item URL template (must contain {name}).
    | Then install from it: `php artisan blatui:add @acme/fancy-button`.
    | The official `@blatui` namespace is built in. You can always install from
    | a full URL without configuring anything:
    |
    |   php artisan blatui:add https://acme.test/r/fancy-button.json
    |
    */

    'registries' => [
        // '@acme' => 'https://acme.test/r/{name}.json',
    ],

];
