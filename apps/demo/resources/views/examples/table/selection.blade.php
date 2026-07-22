<x-ui.table>
    <x-ui.table-header>
        <x-ui.table-row>
            <x-ui.table-head class="w-10"><x-ui.checkbox aria-label="Select all rows" /></x-ui.table-head>
            <x-ui.table-head>Customer</x-ui.table-head>
            <x-ui.table-head>Status</x-ui.table-head>
            <x-ui.table-head class="text-right">Amount</x-ui.table-head>
        </x-ui.table-row>
    </x-ui.table-header>
    <x-ui.table-body>
        <x-ui.table-row data-state="selected">
            <x-ui.table-cell><x-ui.checkbox checked aria-label="Select Sofia Carter" /></x-ui.table-cell>
            <x-ui.table-cell class="font-medium">Sofia Carter</x-ui.table-cell>
            <x-ui.table-cell><x-ui.badge variant="secondary">Paid</x-ui.badge></x-ui.table-cell>
            <x-ui.table-cell class="text-right">$250.00</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row>
            <x-ui.table-cell><x-ui.checkbox aria-label="Select Jackson Doe" /></x-ui.table-cell>
            <x-ui.table-cell class="font-medium">Jackson Doe</x-ui.table-cell>
            <x-ui.table-cell><x-ui.badge variant="outline">Pending</x-ui.badge></x-ui.table-cell>
            <x-ui.table-cell class="text-right">$150.00</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row data-state="selected">
            <x-ui.table-cell><x-ui.checkbox checked aria-label="Select Amelia Bell" /></x-ui.table-cell>
            <x-ui.table-cell class="font-medium">Amelia Bell</x-ui.table-cell>
            <x-ui.table-cell><x-ui.badge variant="secondary">Paid</x-ui.badge></x-ui.table-cell>
            <x-ui.table-cell class="text-right">$450.00</x-ui.table-cell>
        </x-ui.table-row>
    </x-ui.table-body>
</x-ui.table>
