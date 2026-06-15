{{-- Start fully collapsed with :expanded="false"; click any node to drill in. --}}
@php
    $config = [
        'theme' => 'dark',
        'features' => [
            'search' => true,
            'analytics' => false,
        ],
        'limits' => [
            'maxUploads' => 25,
            'sizeMb' => 10.5,
        ],
    ];
@endphp

<x-ui.json-viewer :data="$config" :expanded="false" root-label="config.json" class="w-full max-w-md" />
