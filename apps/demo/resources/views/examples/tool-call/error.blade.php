@php
    $args = [
        'path' => '/etc/app/config.json',
        'mode' => 'r',
    ];

    $result = [
        'error' => 'ENOENT',
        'message' => 'No such file or directory: /etc/app/config.json',
    ];
@endphp

<x-ui.tool-call
    name="read_file"
    status="error"
    :args="$args"
    :result="$result"
    :open="true"
    class="w-full max-w-md"
/>
