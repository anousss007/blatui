@props([
    'type' => 'line',
    'series' => [],
    'options' => [],
    'colors' => [],
    'config' => [],
    'labels' => [],
    'height' => 250,
])

@php
    // shadcn-style config: ['key' => ['label' => '...', 'color' => 'var(--chart-1)']]
    // Derive the colors array + the --color-<key> CSS vars used by labels/legends.
    $resolvedColors = $colors;
    if (empty($resolvedColors) && ! empty($config)) {
        $resolvedColors = array_values(array_filter(array_map(fn ($c) => $c['color'] ?? null, $config)));
    }

    $styleVars = collect($config)
        ->filter(fn ($v) => is_array($v) && isset($v['color']))
        ->map(fn ($v, $k) => "--color-{$k}: {$v['color']};")
        ->implode(' ');

    $payload = [
        'type' => $type,
        'series' => $series,
        'options' => $options,
        'colors' => $resolvedColors,
        'height' => (int) $height,
    ];
    if (! empty($labels)) {
        $payload['labels'] = $labels;
    }
@endphp

<div
    data-slot="chart"
    style="{{ $styleVars }}"
    x-data="shadcnChart({{ \Illuminate\Support\Js::from($payload) }})"
    {{ $attributes->twMerge('flex aspect-video justify-center text-xs w-full [&_.apexcharts-tooltip]:!rounded-lg [&_.apexcharts-tooltip]:!border [&_.apexcharts-tooltip]:!border-border [&_.apexcharts-tooltip]:!bg-popover [&_.apexcharts-tooltip]:!text-popover-foreground [&_.apexcharts-tooltip]:!shadow-xl') }}
>
    <div x-ref="canvas" class="w-full" style="min-height: {{ (int) $height }}px"></div>
</div>
