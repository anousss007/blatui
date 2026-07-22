@php
    // `expanded => true` seeds a parent open on first render. Deeply nested
    // branches can be opened independently.
    $items = [
        [
            'label' => 'app',
            'expanded' => true,
            'children' => [
                [
                    'label' => 'Http',
                    'expanded' => true,
                    'children' => [
                        [
                            'label' => 'Controllers',
                            'expanded' => true,
                            'children' => [
                                ['label' => 'HomeController.php', 'icon' => 'file-code'],
                                ['label' => 'UserController.php', 'icon' => 'file-code'],
                            ],
                        ],
                        ['label' => 'Middleware'],
                    ],
                ],
                [
                    'label' => 'Models',
                    'expanded' => true,
                    'children' => [
                        ['label' => 'User.php', 'icon' => 'file-code'],
                    ],
                ],
            ],
        ],
        [
            'label' => 'config',
            'children' => [
                ['label' => 'app.php', 'icon' => 'file-code'],
            ],
        ],
    ];
@endphp

<x-ui.tree :items="$items" aria-label="Application source" class="w-72" />
