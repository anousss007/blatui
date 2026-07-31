<form {{ $attributes }}>
    <x-ui.sidebar-group class="py-0">
        <x-ui.sidebar-group-content class="relative">
            <x-ui.label for="search" class="sr-only">Search</x-ui.label>
            <x-ui.sidebar-input id="search" placeholder="Search the docs..." class="pl-8" />
            <x-lucide-search class="pointer-events-none absolute top-1/2 left-2 size-4 -translate-y-1/2 opacity-50 select-none" />
        </x-ui.sidebar-group-content>
    </x-ui.sidebar-group>
</form>
