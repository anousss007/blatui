@php
    $args = [
        'query' => 'SELECT * FROM orders WHERE status = ? LIMIT 50',
        'bindings' => ['pending'],
    ];
@endphp

<x-ui.tool-call
    name="run_query"
    status="running"
    :args="$args"
    :open="true"
    class="w-full max-w-md"
/>
