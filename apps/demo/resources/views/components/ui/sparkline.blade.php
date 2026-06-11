@props([
    'data' => [],         // array of numbers
    'width' => 100,
    'height' => 28,
    'area' => true,       // fill the area under the line
    'strokeWidth' => 1.5,
    'ariaLabel' => 'Trend',
])

@php
    $vals = array_values(array_map('floatval', (array) $data));
    $n = count($vals);
    $w = (float) $width;
    $h = (float) $height;
    $pad = (float) $strokeWidth; // keep the stroke inside the viewBox

    $line = '';
    $areaPath = '';

    if ($n >= 2) {
        $min = min($vals);
        $max = max($vals);
        $range = ($max - $min) ?: 1;
        $coords = [];
        foreach ($vals as $i => $v) {
            $x = $pad + ($i / ($n - 1)) * ($w - 2 * $pad);
            $y = $pad + (1 - ($v - $min) / $range) * ($h - 2 * $pad);
            $coords[] = round($x, 2).','.round($y, 2);
        }
        $line = 'M'.implode(' L', $coords);
        $firstX = explode(',', $coords[0])[0];
        $lastX = explode(',', $coords[$n - 1])[0];
        $areaPath = $line." L{$lastX},{$h} L{$firstX},{$h} Z";
    } elseif ($n === 1) {
        $mid = round($h / 2, 2);
        $line = "M{$pad},{$mid} L".($w - $pad).",{$mid}";
    }
@endphp

@if ($line)
    <svg
        data-slot="sparkline"
        role="img"
        aria-label="{{ $ariaLabel }}"
        width="{{ $width }}" height="{{ $height }}" viewBox="0 0 {{ $width }} {{ $height }}"
        fill="none" preserveAspectRatio="none"
        {{ $attributes->twMerge('text-primary inline-block align-middle') }}
    >
        @if ($area && $areaPath)
            <path d="{{ $areaPath }}" fill="currentColor" fill-opacity="0.12" stroke="none" />
        @endif
        <path d="{{ $line }}" fill="none" stroke="currentColor" stroke-width="{{ $strokeWidth }}" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
@endif
