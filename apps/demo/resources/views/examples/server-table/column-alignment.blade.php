@php($invoices = [
    ['id' => 'INV-001', 'client' => 'Acme Corp', 'status' => 'Paid', 'amount' => '$1,200.00'],
    ['id' => 'INV-002', 'client' => 'Globex', 'status' => 'Pending', 'amount' => '$840.50'],
    ['id' => 'INV-003', 'client' => 'Initech', 'status' => 'Overdue', 'amount' => '$2,100.00'],
])

{{--
    Per-column `align` (left | center | right) and a fixed `width`. Numeric / money columns read
    best right-aligned. rowKey points at a non-"id" primary key here ("id" is a string invoice no.).
--}}
<x-ui.server-table
    class="w-full max-w-2xl"
    row-key="id"
    :columns="[
        ['key' => 'id', 'label' => 'Invoice', 'width' => '8rem'],
        ['key' => 'client', 'label' => 'Client'],
        ['key' => 'status', 'label' => 'Status', 'align' => 'center'],
        ['key' => 'amount', 'label' => 'Amount', 'align' => 'right'],
    ]"
    :rows="$invoices"
/>
