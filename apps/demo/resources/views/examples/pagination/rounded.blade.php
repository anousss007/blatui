{{-- Fully rounded (pill) pagination buttons. --}}
<x-ui.pagination>
    <x-ui.pagination-content>
        <x-ui.pagination-item><x-ui.pagination-previous href="#" class="rounded-full" /></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-link href="#" class="rounded-full">1</x-ui.pagination-link></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-link href="#" :isActive="true" class="rounded-full">2</x-ui.pagination-link></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-link href="#" class="rounded-full">3</x-ui.pagination-link></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-ellipsis /></x-ui.pagination-item>
        <x-ui.pagination-item><x-ui.pagination-next href="#" class="rounded-full" /></x-ui.pagination-item>
    </x-ui.pagination-content>
</x-ui.pagination>
