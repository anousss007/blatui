{{-- Zebra striping via a row-targeting arbitrary variant on the table. --}}
<x-ui.table class="[&_tbody_tr:nth-child(odd)]:bg-muted/50">
    <x-ui.table-header>
        <x-ui.table-row>
            <x-ui.table-head>Name</x-ui.table-head>
            <x-ui.table-head>Email</x-ui.table-head>
            <x-ui.table-head>Role</x-ui.table-head>
            <x-ui.table-head class="text-right">Status</x-ui.table-head>
        </x-ui.table-row>
    </x-ui.table-header>
    <x-ui.table-body>
        <x-ui.table-row>
            <x-ui.table-cell class="font-medium">Olivia Martin</x-ui.table-cell>
            <x-ui.table-cell class="text-muted-foreground">olivia@example.com</x-ui.table-cell>
            <x-ui.table-cell>Owner</x-ui.table-cell>
            <x-ui.table-cell class="text-right">Active</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row>
            <x-ui.table-cell class="font-medium">Jackson Lee</x-ui.table-cell>
            <x-ui.table-cell class="text-muted-foreground">jackson@example.com</x-ui.table-cell>
            <x-ui.table-cell>Member</x-ui.table-cell>
            <x-ui.table-cell class="text-right">Active</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row>
            <x-ui.table-cell class="font-medium">Isabella Nguyen</x-ui.table-cell>
            <x-ui.table-cell class="text-muted-foreground">isabella@example.com</x-ui.table-cell>
            <x-ui.table-cell>Member</x-ui.table-cell>
            <x-ui.table-cell class="text-right">Invited</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row>
            <x-ui.table-cell class="font-medium">William Kim</x-ui.table-cell>
            <x-ui.table-cell class="text-muted-foreground">william@example.com</x-ui.table-cell>
            <x-ui.table-cell>Viewer</x-ui.table-cell>
            <x-ui.table-cell class="text-right">Suspended</x-ui.table-cell>
        </x-ui.table-row>
        <x-ui.table-row>
            <x-ui.table-cell class="font-medium">Sofia Davis</x-ui.table-cell>
            <x-ui.table-cell class="text-muted-foreground">sofia@example.com</x-ui.table-cell>
            <x-ui.table-cell>Member</x-ui.table-cell>
            <x-ui.table-cell class="text-right">Active</x-ui.table-cell>
        </x-ui.table-row>
    </x-ui.table-body>
</x-ui.table>
