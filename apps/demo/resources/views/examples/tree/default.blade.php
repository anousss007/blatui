@php
    $items = [
        [
            'label' => 'Documents',
            'expanded' => true,
            'children' => [
                [
                    'label' => 'Work',
                    'children' => [
                        ['label' => 'Q3 Report'],
                        ['label' => 'Roadmap'],
                    ],
                ],
                ['label' => 'Personal'],
            ],
        ],
        [
            'label' => 'Pictures',
            'children' => [
                ['label' => 'Vacation'],
                ['label' => 'Screenshots'],
            ],
        ],
        ['label' => 'README.txt'],
    ];
@endphp

<x-ui.tree :items="$items" aria-label="File navigator" class="w-64" />
