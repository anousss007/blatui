<x-ui.table>
    <x-ui.table-header>
        <x-ui.table-row>
            <x-ui.table-head>Invoice</x-ui.table-head>
            <x-ui.table-head>Status</x-ui.table-head>
            <x-ui.table-head class="text-right">Amount</x-ui.table-head>
            <x-ui.table-head class="w-10"><span class="sr-only">Actions</span></x-ui.table-head>
        </x-ui.table-row>
    </x-ui.table-header>
    <x-ui.table-body>
        @foreach ([['INV001', 'Paid', '$250.00', 'secondary'], ['INV002', 'Pending', '$150.00', 'outline'], ['INV003', 'Unpaid', '$350.00', 'destructive']] as [$id, $status, $amount, $variant])
            <x-ui.table-row>
                <x-ui.table-cell class="font-medium">{{ $id }}</x-ui.table-cell>
                <x-ui.table-cell><x-ui.badge :variant="$variant">{{ $status }}</x-ui.badge></x-ui.table-cell>
                <x-ui.table-cell class="text-right tabular-nums">{{ $amount }}</x-ui.table-cell>
                <x-ui.table-cell class="text-right">
                    <x-ui.dropdown-menu>
                        <x-ui.dropdown-menu-trigger>
                            <x-ui.button variant="ghost" size="icon-sm" aria-label="Actions for {{ $id }}">
                                <x-lucide-more-horizontal aria-hidden="true" />
                            </x-ui.button>
                        </x-ui.dropdown-menu-trigger>
                        <x-ui.dropdown-menu-content align="end">
                            <x-ui.dropdown-menu-item>View invoice</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-item>Edit</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-separator />
                            <x-ui.dropdown-menu-item variant="destructive">Delete</x-ui.dropdown-menu-item>
                        </x-ui.dropdown-menu-content>
                    </x-ui.dropdown-menu>
                </x-ui.table-cell>
            </x-ui.table-row>
        @endforeach
    </x-ui.table-body>
</x-ui.table>
