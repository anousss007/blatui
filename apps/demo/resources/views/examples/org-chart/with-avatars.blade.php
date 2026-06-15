@php
    $org = [
        'name' => 'Avery Quinn',
        'title' => 'Chief Executive Officer',
        'avatar' => 'https://picsum.photos/seed/avery/96/96',
        'children' => [
            [
                'name' => 'Jordan Lee',
                'title' => 'VP, Engineering',
                'avatar' => 'https://picsum.photos/seed/jordan/96/96',
                'children' => [
                    ['name' => 'Sam Rivera', 'title' => 'Eng Manager', 'avatar' => 'https://picsum.photos/seed/sam/96/96'],
                    ['name' => 'Priya Nair', 'title' => 'Staff Engineer', 'avatar' => 'https://picsum.photos/seed/priya/96/96'],
                ],
            ],
            [
                'name' => 'Morgan Diaz',
                'title' => 'VP, Design',
                'avatar' => 'https://picsum.photos/seed/morgan/96/96',
                'children' => [
                    ['name' => 'Chris Park', 'title' => 'Design Lead', 'avatar' => 'https://picsum.photos/seed/chris/96/96'],
                ],
            ],
        ],
    ];
@endphp

<x-ui.org-chart :data="$org" />
