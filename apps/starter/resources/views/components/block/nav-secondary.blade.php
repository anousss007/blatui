@props(['items' => []])

<x-ui.sidebar-group {{ $attributes }}>
    <x-ui.sidebar-group-content>
        <x-ui.sidebar-menu>
            @foreach ($items as $item)
                <x-ui.sidebar-menu-item>
                    <x-ui.sidebar-menu-button href="#" size="sm">
                        <x-dynamic-component :component="'lucide-'.$item['icon']" />
                        <span>{{ $item['title'] }}</span>
                    </x-ui.sidebar-menu-button>
                </x-ui.sidebar-menu-item>
            @endforeach
        </x-ui.sidebar-menu>
    </x-ui.sidebar-group-content>
</x-ui.sidebar-group>
