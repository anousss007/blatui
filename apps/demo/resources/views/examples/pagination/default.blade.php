<x-ui.pagination>
    <x-ui.pagination-content>
        <x-ui.pagination-item>
            <x-ui.pagination-previous href="#" />
        </x-ui.pagination-item>
        <x-ui.pagination-item>
            <x-ui.pagination-link href="#">1</x-ui.pagination-link>
        </x-ui.pagination-item>
        <x-ui.pagination-item>
            <x-ui.pagination-link href="#" :isActive="true">2</x-ui.pagination-link>
        </x-ui.pagination-item>
        <x-ui.pagination-item>
            <x-ui.pagination-link href="#">3</x-ui.pagination-link>
        </x-ui.pagination-item>
        <x-ui.pagination-item>
            <x-ui.pagination-ellipsis />
        </x-ui.pagination-item>
        <x-ui.pagination-item>
            <x-ui.pagination-next href="#" />
        </x-ui.pagination-item>
    </x-ui.pagination-content>
</x-ui.pagination>
