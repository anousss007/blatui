{{-- The card variant wraps the table in a bordered, rounded surface. --}}
<x-ui.table variant="card" class="[&_tbody_tr:last-child]:border-0">
    <x-ui.table-header>
        <x-ui.table-row class="[&>th]:px-4">
            <x-ui.table-head>Invoice</x-ui.table-head>
            <x-ui.table-head>Status</x-ui.table-head>
            <x-ui.table-head>Method</x-ui.table-head>
            <x-ui.table-head class="text-right">Amount</x-ui.table-head>
        </x-ui.table-row>
    </x-ui.table-header>
    <x-ui.table-body>
        <x-ui.table-row class="[&>td]:px-4">
            <x-ui.table-cell class="font-medium">INV001</x-ui.table-cell>
            <x-ui.table-cell>Paid</x-ui.table-cell>
            <x-ui.table-cell>Credit Card</x-ui.table-cell>
            <x-ui.table-cell class="text-right">$250.00</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row class="[&>td]:px-4">
            <x-ui.table-cell class="font-medium">INV002</x-ui.table-cell>
            <x-ui.table-cell>Pending</x-ui.table-cell>
            <x-ui.table-cell>PayPal</x-ui.table-cell>
            <x-ui.table-cell class="text-right">$150.00</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row class="[&>td]:px-4">
            <x-ui.table-cell class="font-medium">INV003</x-ui.table-cell>
            <x-ui.table-cell>Unpaid</x-ui.table-cell>
            <x-ui.table-cell>Bank Transfer</x-ui.table-cell>
            <x-ui.table-cell class="text-right">$350.00</x-ui.table-cell>
        </x-ui.table-row>
    </x-ui.table-body>
</x-ui.table>
