@php
    $tiers = ['Hobby', 'Pro', 'Enterprise'];
    $rows = [
        ['Projects', '3', 'Unlimited', 'Unlimited'],
        ['Custom domains', true, true, true],
        ['Preview deploys', true, true, true],
        ['Team seats', '1', '5', 'Unlimited'],
        ['Rollbacks', '3 days', 'Unlimited', 'Unlimited'],
        ['SSO / SAML', false, false, true],
        ['Audit logs', false, false, true],
        ['SLA', false, '99.9%', '99.99%'],
    ];
@endphp

<x-ui.table class="w-full max-w-2xl">
    <x-ui.table-header>
        <x-ui.table-row>
            <x-ui.table-head>Feature</x-ui.table-head>
            @foreach ($tiers as $i => $tier)
                <x-ui.table-head class="text-center {{ $i === 1 ? 'text-primary font-semibold' : '' }}">{{ $tier }}</x-ui.table-head>
            @endforeach
        </x-ui.table-row>
    </x-ui.table-header>
    <x-ui.table-body>
        @foreach ($rows as $row)
            <x-ui.table-row>
                <x-ui.table-cell class="font-medium">{{ $row[0] }}</x-ui.table-cell>
                @foreach (array_slice($row, 1) as $cell)
                    <x-ui.table-cell class="text-center">
                        @if ($cell === true)
                            <x-lucide-check class="text-primary mx-auto size-4" aria-label="Included" />
                        @elseif ($cell === false)
                            <x-lucide-minus class="text-muted-foreground/40 mx-auto size-4" aria-label="Not included" />
                        @else
                            <span class="tabular-nums">{{ $cell }}</span>
                        @endif
                    </x-ui.table-cell>
                @endforeach
            </x-ui.table-row>
        @endforeach
    </x-ui.table-body>
</x-ui.table>
