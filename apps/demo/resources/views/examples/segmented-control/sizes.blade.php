@php
    $options = [
        ['value' => 'day', 'label' => 'Day'],
        ['value' => 'week', 'label' => 'Week'],
        ['value' => 'month', 'label' => 'Month'],
    ];
@endphp

<div class="flex flex-col items-start gap-3">
    <x-ui.segmented-control size="sm" value="week" :options="$options" />
    <x-ui.segmented-control value="week" :options="$options" />
    <x-ui.segmented-control size="lg" value="week" :options="$options" />
</div>
