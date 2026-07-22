@props([
    'value' => 0,
    'min' => 0,
    'max' => 100,
    'label' => null,
    'tone' => null,        // good | warning | danger | default — overrides threshold logic
    'low' => null,         // lower bound of the "ok" middle band
    'high' => null,        // upper bound of the "ok" middle band
    'optimum' => null,     // the ideal value; decides which side reads as "good"
    'showValue' => true,
    'unit' => '%',         // appended to the value text, e.g. "%". Set to a space-prefixed unit or '' as needed.
])

@php
    $min = (float) $min;
    $max = (float) $max;
    // Guard against an empty/inverted range.
    if ($max <= $min) {
        $max = $min + 1;
    }

    $value = (float) $value;
    $clamped = max($min, min($max, $value));
    $pct = ($clamped - $min) / ($max - $min) * 100;

    // Resolve the tone. Explicit `tone` wins; otherwise derive it from the
    // low/high/optimum thresholds the same way the native <meter> element does.
    $resolved = $tone;
    if ($resolved === null && ($low !== null || $high !== null || $optimum !== null)) {
        $low = $low === null ? $min : (float) $low;
        $high = $high === null ? $max : (float) $high;
        // Keep the bands sane and inside the range.
        $low = max($min, min($low, $max));
        $high = max($low, min((float) $high, $max));

        // Which band does the current value fall into?
        if ($clamped < $low || $clamped > $high) {
            $band = 'out';   // outside the preferred middle band
        } else {
            $band = 'in';    // inside the preferred middle band
        }

        if ($optimum === null) {
            $resolved = $band === 'in' ? 'good' : 'warning';
        } else {
            $optimum = max($min, min((float) $optimum, $max));
            // Determine where the optimum sits, mirroring the HTML spec.
            if ($optimum < $low) {
                // Lower is better.
                $resolved = $clamped <= $low ? 'good' : ($clamped <= $high ? 'warning' : 'danger');
            } elseif ($optimum > $high) {
                // Higher is better.
                $resolved = $clamped >= $high ? 'good' : ($clamped >= $low ? 'warning' : 'danger');
            } else {
                // The middle band is best.
                $resolved = $band === 'in' ? 'good' : 'warning';
            }
        }
    }

    $tones = [
        'good' => 'bg-emerald-600',
        'warning' => 'bg-amber-500',
        'danger' => 'bg-destructive',
        'default' => 'bg-primary',
    ];
    $fill = $tones[$resolved] ?? $tones['default'];

    // Accessible name: prefer the explicit label, then any aria-label passed
    // through attributes, then a generic fallback.
    $accessibleName = $label ?? $attributes->get('aria-label') ?? 'Meter';

    // The visible value text, e.g. "72%" or "7.2 / 10".
    $valueText = rtrim(rtrim(number_format($value, 1, '.', ''), '0'), '.') . ($unit ?? '');
@endphp

<div
    data-slot="meter"
    {{ $attributes->except('aria-label')->twMerge('grid w-full gap-1.5') }}
>
    @if ($label !== null || $showValue)
        <div data-slot="meter-header" class="flex items-center justify-between gap-2 text-sm">
            @if ($label !== null)
                <span data-slot="meter-label" class="text-foreground font-medium">{{ $label }}</span>
            @else
                <span aria-hidden="true"></span>
            @endif

            @if ($showValue)
                <span data-slot="meter-value" class="text-muted-foreground tabular-nums">{{ $valueText }}</span>
            @endif
        </div>
    @endif

    <div
        data-slot="meter-track"
        role="meter"
        aria-label="{{ $accessibleName }}"
        aria-valuenow="{{ rtrim(rtrim(number_format($clamped, 2, '.', ''), '0'), '.') }}"
        aria-valuemin="{{ rtrim(rtrim(number_format($min, 2, '.', ''), '0'), '.') }}"
        aria-valuemax="{{ rtrim(rtrim(number_format($max, 2, '.', ''), '0'), '.') }}"
        aria-valuetext="{{ $valueText }}"
        class="bg-muted relative h-2 w-full overflow-hidden rounded-full"
    >
        <div
            data-slot="meter-fill"
            class="{{ $fill }} absolute inset-y-0 start-0 rounded-full transition-[width] duration-500 ease-out"
            style="width: {{ round($pct, 2) }}%"
        ></div>
    </div>
</div>
