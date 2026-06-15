@props([
    'variant' => 'default',
    'tone' => null,
])

@php
    $base = "relative w-full rounded-lg border px-4 py-3 text-sm grid has-[>svg]:grid-cols-[calc(var(--spacing)*4)_1fr] grid-cols-[0_1fr] has-[>svg]:gap-x-3 gap-y-0.5 items-start [&>svg]:size-4 [&>svg]:translate-y-0.5 [&>svg]:text-current";

    $variants = [
        'default' => 'bg-card text-card-foreground',
        'destructive' => 'text-destructive bg-card [&>svg]:text-current *:data-[slot=alert-description]:text-destructive',
    ];

    // Semantic status tones — soft tinted callouts. Literal strings for the scanner.
    $tones = [
        'success' => 'border-success/20 bg-success/10 text-success [&>svg]:text-success *:data-[slot=alert-description]:text-success',
        'warning' => 'border-warning/20 bg-warning/10 text-warning [&>svg]:text-warning *:data-[slot=alert-description]:text-warning',
        'danger' => 'border-destructive/20 bg-destructive/10 text-destructive [&>svg]:text-destructive *:data-[slot=alert-description]:text-destructive',
        'info' => 'border-info/20 bg-info/10 text-info [&>svg]:text-info *:data-[slot=alert-description]:text-info',
        'neutral' => 'border-border bg-muted text-foreground [&>svg]:text-foreground *:data-[slot=alert-description]:text-muted-foreground',
    ];

    if ($tone && isset($tones[$tone])) {
        $classes = $base.' '.$tones[$tone];
    } else {
        $classes = $base.' '.($variants[$variant] ?? $variants['default']);
    }
@endphp

<div data-slot="alert" role="alert" {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
</div>
