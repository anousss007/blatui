{{-- A nested object, expanded by default. Pass a PHP array or a JSON string. --}}
@php
    $payload = [
        'id' => 1042,
        'name' => 'Ada Lovelace',
        'active' => true,
        'roles' => ['admin', 'editor'],
        'profile' => [
            'age' => 36,
            'verified' => false,
            'website' => null,
        ],
    ];
@endphp

<x-ui.json-viewer :data="$payload" root-label="user" class="w-full max-w-md" />
