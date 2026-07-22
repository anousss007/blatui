{{-- Jump-to-first / jump-to-last buttons alongside prev/next. --}}
<x-ui.pagination>
    <x-ui.pagination-content>
        <x-ui.pagination-item>
            <x-ui.pagination-link href="#" aria-label="Go to first page" class="gap-1 px-2.5"><x-lucide-chevron-first class="size-4" /></x-ui.pagination-link>
        </x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-previous href="#" /></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-link href="#">4</x-ui.pagination-link></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-link href="#" :isActive="true">5</x-ui.pagination-link></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-link href="#">6</x-ui.pagination-link></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-next href="#" /></x-ui.pagination-item>
        <x-ui.pagination-item>
            <x-ui.pagination-link href="#" aria-label="Go to last page" class="gap-1 px-2.5"><x-lucide-chevron-last class="size-4" /></x-ui.pagination-link>
        </x-ui.pagination-item>
    </x-ui.pagination-content>
</x-ui.pagination>
