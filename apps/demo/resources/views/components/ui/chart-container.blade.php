@props([
    'config' => [],
    'id' => null,
])

@php
    $chartId = $id ?? 'chart-'.\Illuminate\Support\Str::random(8);
    $styleVars = collect($config)
        ->filter(fn ($v) => is_array($v) && isset($v['color']))
        ->map(fn ($v, $k) => "--color-{$k}: {$v['color']};")
        ->implode(' ');
@endphp

<div
    data-slot="chart"
    data-chart="{{ $chartId }}"
    style="{{ $styleVars }}"
    {{ $attributes->twMerge("[&_.recharts-cartesian-axis-tick_text]:fill-muted-foreground [&_.recharts-cartesian-grid_line[stroke='#ccc']]:stroke-border/50 [&_.recharts-curve.recharts-tooltip-cursor]:stroke-border [&_.recharts-polar-grid_[stroke='#ccc']]:stroke-border [&_.recharts-radial-bar-background-sector]:fill-muted [&_.recharts-rectangle.recharts-tooltip-cursor]:fill-muted [&_.recharts-reference-line_[stroke='#ccc']]:stroke-border flex aspect-video justify-center text-xs [&_.recharts-dot[stroke='#fff']]:stroke-transparent [&_.recharts-layer]:outline-none [&_.recharts-sector]:outline-none [&_.recharts-sector[stroke='#fff']]:stroke-transparent [&_.recharts-surface]:outline-none") }}
>
    {{ $slot }}
</div>
