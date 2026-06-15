<x-ui.tree-table
    class="max-w-2xl"
    :columns="[
        ['key' => 'name', 'label' => 'Department'],
        ['key' => 'owner', 'label' => 'Owner'],
        ['key' => 'headcount', 'label' => 'Headcount', 'align' => 'right'],
        ['key' => 'budget', 'label' => 'Budget', 'align' => 'right'],
    ]"
    :rows="[
        [
            'name' => 'Engineering',
            'owner' => 'A. Rivera',
            'headcount' => 48,
            'budget' => '$6.4M',
            'expanded' => true,
            'children' => [
                [
                    'name' => 'Platform',
                    'owner' => 'J. Okafor',
                    'headcount' => 18,
                    'budget' => '$2.5M',
                    'expanded' => true,
                    'children' => [
                        ['name' => 'Infrastructure', 'owner' => 'M. Lind', 'headcount' => 9, 'budget' => '$1.3M'],
                        ['name' => 'Developer Tools', 'owner' => 'S. Park', 'headcount' => 9, 'budget' => '$1.2M'],
                    ],
                ],
                [
                    'name' => 'Product',
                    'owner' => 'D. Mehta',
                    'headcount' => 30,
                    'budget' => '$3.9M',
                    'children' => [
                        ['name' => 'Web', 'owner' => 'L. Chen', 'headcount' => 16, 'budget' => '$2.1M'],
                        ['name' => 'Mobile', 'owner' => 'R. Boateng', 'headcount' => 14, 'budget' => '$1.8M'],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Sales',
            'owner' => 'P. Nguyen',
            'headcount' => 26,
            'budget' => '$3.1M',
            'children' => [
                ['name' => 'Enterprise', 'owner' => 'K. Adebayo', 'headcount' => 12, 'budget' => '$1.7M'],
                ['name' => 'SMB', 'owner' => 'T. Wallace', 'headcount' => 14, 'budget' => '$1.4M'],
            ],
        ],
        [
            'name' => 'Operations',
            'owner' => 'C. Bianchi',
            'headcount' => 11,
            'budget' => '$1.2M',
        ],
    ]"
/>
