@php
    $columns = [
        [
            'id' => 'todo',
            'title' => 'To Do',
            'cards' => [
                ['id' => 't1', 'title' => 'Design the empty state', 'tags' => ['Design'], 'meta' => 'Due in 3 days'],
                ['id' => 't2', 'title' => 'Write release notes', 'tags' => ['Docs', 'Low']],
                ['id' => 't3', 'title' => 'Audit colour contrast', 'tags' => ['A11y']],
            ],
        ],
        [
            'id' => 'doing',
            'title' => 'In Progress',
            'cards' => [
                ['id' => 'd1', 'title' => 'Build the kanban board', 'tags' => ['Feature'], 'meta' => 'Anas'],
                ['id' => 'd2', 'title' => 'Fix drag-and-drop on Safari', 'tags' => ['Bug', 'High']],
            ],
        ],
        [
            'id' => 'done',
            'title' => 'Done',
            'cards' => [
                ['id' => 'p1', 'title' => 'Set up the theme tokens', 'tags' => ['Chore']],
                ['id' => 'p2', 'title' => 'Ship the badge component', 'meta' => 'Merged'],
            ],
        ],
    ];
@endphp

<x-ui.kanban :columns="$columns" class="max-w-3xl" />
