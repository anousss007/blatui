{{-- Underline ("line") variant: a transparent list with an active bottom border. --}}
<x-ui.tabs value="overview" class="w-full max-w-md">
    <x-ui.tabs-list class="h-auto w-full justify-start gap-4 rounded-none border-b bg-transparent p-0">
        <x-ui.tabs-trigger
            value="overview"
            class="flex-none rounded-none border-0 border-b-2 border-transparent bg-transparent px-1 pb-2.5 shadow-none data-[state=active]:border-primary data-[state=active]:bg-transparent data-[state=active]:text-foreground data-[state=active]:shadow-none"
        >Overview</x-ui.tabs-trigger>
        <x-ui.tabs-trigger
            value="analytics"
            class="flex-none rounded-none border-0 border-b-2 border-transparent bg-transparent px-1 pb-2.5 shadow-none data-[state=active]:border-primary data-[state=active]:bg-transparent data-[state=active]:text-foreground data-[state=active]:shadow-none"
        >Analytics</x-ui.tabs-trigger>
        <x-ui.tabs-trigger
            value="reports"
            class="flex-none rounded-none border-0 border-b-2 border-transparent bg-transparent px-1 pb-2.5 shadow-none data-[state=active]:border-primary data-[state=active]:bg-transparent data-[state=active]:text-foreground data-[state=active]:shadow-none"
        >Reports</x-ui.tabs-trigger>
    </x-ui.tabs-list>
    <x-ui.tabs-content value="overview" class="text-muted-foreground pt-3 text-sm">Your store overview and key metrics at a glance.</x-ui.tabs-content>
    <x-ui.tabs-content value="analytics" class="text-muted-foreground pt-3 text-sm">Detailed analytics and traffic insights.</x-ui.tabs-content>
    <x-ui.tabs-content value="reports" class="text-muted-foreground pt-3 text-sm">Generate and download reports.</x-ui.tabs-content>
</x-ui.tabs>
