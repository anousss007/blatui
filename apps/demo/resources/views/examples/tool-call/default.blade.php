@php
    $args = [
        'location' => 'San Francisco, CA',
        'units' => 'celsius',
    ];

    $result = [
        'temperature' => 18,
        'conditions' => 'Partly cloudy',
        'humidity' => '64%',
    ];
@endphp

<x-ui.tool-call
    name="get_weather"
    status="success"
    :args="$args"
    :result="$result"
    class="w-full max-w-md"
/>
