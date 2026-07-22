<x-ui.empty class="w-full max-w-md">
    <x-ui.empty-header>
        <x-ui.empty-media variant="icon"><x-lucide-search /></x-ui.empty-media>
        <x-ui.empty-title>No results found</x-ui.empty-title>
        <x-ui.empty-description>We couldn't find anything matching your search. Try a different term.</x-ui.empty-description>
    </x-ui.empty-header>
    <x-ui.empty-content>
        <div class="flex w-full max-w-xs items-center gap-2">
            <x-ui.input placeholder="Search again..." aria-label="Search" />
            <x-ui.button variant="outline">Search</x-ui.button>
        </div>
    </x-ui.empty-content>
</x-ui.empty>
