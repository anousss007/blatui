@props([
    'value' => 0,
    'indeterminate' => false,
    'ariaLabel' => 'Progress',
    'circular' => false,   // true → render a circular ring instead of a linear bar
    'size' => 64,          // circular only: diameter in px
    'thickness' => 6,      // circular only: ring stroke width in px
    'showValue' => false,  // circular only: render the % in the centre
])

@php
    $pct = max(0.0, min(100.0, (float) $value));
@endphp

@if ($circular)
    @php
        $r = ((float) $size - (float) $thickness) / 2;
        $circ = 2 * M_PI * $r;
        $offset = $indeterminate ? $circ * 0.65 : $circ * (1 - $pct / 100);
        $center = (float) $size / 2;
    @endphp
    <div
        data-slot="progress"
        role="progressbar"
        aria-label="{{ $ariaLabel }}"
        aria-valuemin="0"
        aria-valuemax="100"
        @unless ($indeterminate)
            aria-valuenow="{{ (int) round($pct) }}"
            aria-valuetext="{{ (int) round($pct) }}%"
        @endunless
        style="width: {{ $size }}px; height: {{ $size }}px;"
        {{ $attributes->twMerge('text-primary relative inline-grid shrink-0 place-items-center') }}
    >
        <svg
            width="{{ $size }}" height="{{ $size }}" viewBox="0 0 {{ $size }} {{ $size }}" fill="none" aria-hidden="true"
            class="{{ $indeterminate ? 'animate-spin' : '-rotate-90' }}"
        >
            <circle cx="{{ $center }}" cy="{{ $center }}" r="{{ $r }}" stroke="currentColor" stroke-opacity="0.2" stroke-width="{{ $thickness }}" />
            <circle
                cx="{{ $center }}" cy="{{ $center }}" r="{{ $r }}"
                stroke="currentColor" stroke-width="{{ $thickness }}" stroke-linecap="round"
                stroke-dasharray="{{ $circ }}" stroke-dashoffset="{{ $offset }}"
                class="transition-[stroke-dashoffset] duration-500 ease-out"
            />
        </svg>
        @if ($showValue && ! $indeterminate)
            <span data-slot="progress-value" class="absolute text-sm font-semibold tabular-nums">{{ (int) round($pct) }}%</span>
        @endif
    </div>
@else
    <div
        data-slot="progress"
        role="progressbar"
        aria-label="{{ $ariaLabel }}"
        aria-valuemin="0"
        aria-valuemax="100"
        @unless ($indeterminate)
            aria-valuenow="{{ (int) round($pct) }}"
            aria-valuetext="{{ (int) round($pct) }}%"
        @endunless
        {{ $attributes->twMerge('bg-primary/20 relative h-2 w-full overflow-hidden rounded-full') }}
    >
        @if ($indeterminate)
            <div
                data-slot="progress-indicator"
                class="bg-primary animate-progress-indeterminate absolute inset-y-0 w-2/5 rounded-full"
            ></div>
        @else
            <div
                data-slot="progress-indicator"
                class="bg-primary h-full w-full flex-1 transition-all"
                style="transform: translateX(-{{ 100 - $pct }}%)"
            ></div>
        @endif
    </div>
@endif
