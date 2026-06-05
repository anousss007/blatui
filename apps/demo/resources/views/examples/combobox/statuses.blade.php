<x-ui.combobox
    placeholder="+ Set status"
    searchPlaceholder="Change status..."
    empty="No status found."
    width="w-[220px]"
    :options="[
        ['value' => 'backlog', 'label' => 'Backlog'],
        ['value' => 'todo', 'label' => 'Todo'],
        ['value' => 'in-progress', 'label' => 'In Progress'],
        ['value' => 'done', 'label' => 'Done'],
        ['value' => 'canceled', 'label' => 'Canceled'],
    ]"
/>
