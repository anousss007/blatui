@php
    $org = [
        'name' => 'Avery Quinn',
        'title' => 'Chief Executive Officer',
        'children' => [
            [
                'name' => 'Jordan Lee',
                'title' => 'VP, Engineering',
                'children' => [
                    ['name' => 'Sam Rivera', 'title' => 'Eng Manager'],
                    ['name' => 'Priya Nair', 'title' => 'Staff Engineer'],
                ],
            ],
            [
                'name' => 'Morgan Diaz',
                'title' => 'VP, Product',
                'children' => [
                    ['name' => 'Chris Park', 'title' => 'Product Manager'],
                ],
            ],
            [
                'name' => 'Riley Chen',
                'title' => 'VP, Operations',
                'children' => [
                    ['name' => 'Dana Cole', 'title' => 'Ops Lead'],
                    ['name' => 'Noah Kim', 'title' => 'Finance Lead'],
                ],
            ],
        ],
    ];
@endphp

<x-ui.org-chart :root="$org" />
