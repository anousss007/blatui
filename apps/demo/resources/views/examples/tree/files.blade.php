@php
    // Leaf items get a lucide `icon`; parents auto-render folder / folder-open.
    $items = [
        [
            'label' => 'src',
            'expanded' => true,
            'children' => [
                [
                    'label' => 'components',
                    'children' => [
                        ['label' => 'Button.vue', 'icon' => 'file-code'],
                        ['label' => 'Modal.vue', 'icon' => 'file-code'],
                    ],
                ],
                ['label' => 'app.js', 'icon' => 'file-code'],
                ['label' => 'styles.css', 'icon' => 'file-type'],
            ],
        ],
        [
            'label' => 'public',
            'children' => [
                ['label' => 'logo.svg', 'icon' => 'file-image'],
                ['label' => 'favicon.ico', 'icon' => 'file-image'],
            ],
        ],
        ['label' => 'package.json', 'icon' => 'file-json'],
        ['label' => 'README.md', 'icon' => 'file-text'],
    ];
@endphp

<x-ui.tree :items="$items" aria-label="Project files" class="w-64" />
