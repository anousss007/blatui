{{-- Pill variant via `variant="pills"` — rounded, filled active tab. --}}
<x-ui.tabs value="all" class="w-full max-w-md">
    <x-ui.tabs-list variant="pills">
        <x-ui.tabs-trigger value="all">All</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="active">Active</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="archived">Archived</x-ui.tabs-trigger>
    </x-ui.tabs-list>
    <x-ui.tabs-content value="all" class="text-muted-foreground pt-3 text-sm">Every item in your workspace.</x-ui.tabs-content>
    <x-ui.tabs-content value="active" class="text-muted-foreground pt-3 text-sm">Items currently in progress.</x-ui.tabs-content>
    <x-ui.tabs-content value="archived" class="text-muted-foreground pt-3 text-sm">Items you've put away.</x-ui.tabs-content>
</x-ui.tabs>
