{{--
    Map — a keyless OpenStreetMap embed (no API key, no tokens).
      lat / lon  coordinates of the point to centre on (defaults to Brussels)
      zoom       OSM zoom level — drives how tight the bounding box is (default 14)
      label      human name of the place; used in the iframe title + larger-map link
      marker     drop a pin at lat,lon (default true)
      height     fixed pixel height of the frame (default 320) — used when no ratio
      ratio      optional CSS aspect-ratio (e.g. "16 / 9"); overrides height when set
    A11y: the <iframe> carries a descriptive title and loading="lazy"; a real
    "View larger map" <a> opens openstreetmap.org in a new tab with an icon + sr text.
--}}
@props([
    'lat' => null,
    'lon' => null,
    'zoom' => 14,
    'label' => 'Location',
    'marker' => true,
    'height' => 320,
    'ratio' => null,
])

@php
    // Sensible default: Brussels, Belgium.
    $lat = $lat === null ? 50.8467 : (float) $lat;
    $lon = $lon === null ? 4.3499 : (float) $lon;
    $zoom = max(1, min(19, (int) $zoom));

    // Derive a small bbox around the point. Higher zoom => smaller delta.
    // ~ degrees spanned halves with each zoom step; tuned to feel right at z14.
    $delta = 360 / pow(2, $zoom);
    $minLon = $lon - $delta;
    $maxLon = $lon + $delta;
    $minLat = $lat - $delta / 2;
    $maxLat = $lat + $delta / 2;

    $bbox = implode(',', [
        number_format($minLon, 6, '.', ''),
        number_format($minLat, 6, '.', ''),
        number_format($maxLon, 6, '.', ''),
        number_format($maxLat, 6, '.', ''),
    ]);

    $embed = 'https://www.openstreetmap.org/export/embed.html?bbox=' . $bbox . '&layer=mapnik';
    if ($marker) {
        $embed .= '&marker=' . number_format($lat, 6, '.', '') . ',' . number_format($lon, 6, '.', '');
    }

    $larger = 'https://www.openstreetmap.org/?mlat=' . number_format($lat, 6, '.', '')
        . '&mlon=' . number_format($lon, 6, '.', '')
        . '#map=' . $zoom . '/' . number_format($lat, 6, '.', '') . '/' . number_format($lon, 6, '.', '');

    $frameStyle = $ratio !== null ? 'aspect-ratio: ' . $ratio . ';' : 'height: ' . (int) $height . 'px;';
@endphp

<div data-slot="map" {{ $attributes->twMerge('w-full') }}>
    <div class="bg-muted relative w-full overflow-hidden rounded-xl border" style="{{ $frameStyle }}">
        <iframe
            title="Map of {{ $label }}"
            src="{{ $embed }}"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            class="absolute inset-0 size-full border-0"
        ></iframe>
    </div>

    <a
        href="{{ $larger }}"
        target="_blank"
        rel="noopener noreferrer"
        class="text-muted-foreground hover:text-foreground mt-2 inline-flex items-center gap-1 text-xs underline-offset-4 hover:underline"
    >
        <span>View larger map</span>
        <x-lucide-external-link class="size-3 shrink-0 rtl:-scale-x-100" aria-hidden="true" />
        <span class="sr-only">(opens openstreetmap.org in a new tab)</span>
    </a>
</div>
