@props([
    'tiers' => [],          // column headers, e.g. ['Hobby', 'Pro', 'Enterprise']
    'rows' => [],           // [['feature' => 'Projects', 'values' => ['3', 'Unlimited', 'Unlimited']], ...]
    'highlight' => null,    // tier name or 0-based index to emphasise
    'featureLabel' => 'Feature',
])

@php
    $tiers = array_values($tiers);
    $hl = is_int($highlight) ? $highlight : array_search($highlight, $tiers, true);
@endphp

<div data-slot="comparison-table" {{ $attributes->twMerge('w-full overflow-x-auto rounded-xl border') }}>
    <table class="w-full text-sm">
        <caption class="sr-only">{{ $featureLabel }} comparison across {{ implode(', ', $tiers) }}</caption>
        <thead>
            <tr class="bg-muted/40 border-b">
                <th scope="col" class="text-muted-foreground px-4 py-3 text-left font-medium">{{ $featureLabel }}</th>
                @foreach ($tiers as $i => $tier)
                    <th scope="col" @class([
                        'px-4 py-3 text-center font-semibold',
                        'text-primary' => $i === $hl,
                    ])>{{ $tier }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr class="border-b last:border-0">
                    <th scope="row" class="px-4 py-3 text-left font-medium">{{ $row['feature'] ?? '' }}</th>
                    @foreach (array_values($row['values'] ?? []) as $i => $val)
                        <td @class([
                            'px-4 py-3 text-center',
                            'bg-muted/30' => $i === $hl,
                        ])>
                            @if ($val === true)
                                <x-lucide-check class="text-primary mx-auto size-4" aria-label="Included" />
                            @elseif ($val === false || $val === null)
                                <x-lucide-minus class="text-muted-foreground/40 mx-auto size-4" aria-label="Not included" />
                            @else
                                <span class="tabular-nums">{{ $val }}</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
