@props(['items' => [], 'label' => 'Platform'])

<x-ui.sidebar-group>
    <x-ui.sidebar-group-label>{{ $label }}</x-ui.sidebar-group-label>
    <x-ui.sidebar-menu>
        @foreach ($items as $item)
            <x-ui.collapsible :open="$item['isActive'] ?? false" class="group/collapsible" ::data-state="open ? 'open' : 'closed'">
                <x-ui.sidebar-menu-item>
                    <x-ui.sidebar-menu-button x-on:click="open = !open" ::data-state="open ? 'open' : 'closed'">
                        @isset($item['icon'])
                            <x-dynamic-component :component="'lucide-'.$item['icon']" />
                        @endisset
                        <span>{{ $item['title'] }}</span>
                        <x-lucide-chevron-right class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                    </x-ui.sidebar-menu-button>
                    @if (!empty($item['items']))
                        <x-ui.collapsible-content>
                            <x-ui.sidebar-menu-sub>
                                @foreach ($item['items'] as $subItem)
                                    <x-ui.sidebar-menu-sub-item>
                                        <x-ui.sidebar-menu-sub-button href="#">
                                            <span>{{ $subItem['title'] }}</span>
                                        </x-ui.sidebar-menu-sub-button>
                                    </x-ui.sidebar-menu-sub-item>
                                @endforeach
                            </x-ui.sidebar-menu-sub>
                        </x-ui.collapsible-content>
                    @endif
                </x-ui.sidebar-menu-item>
            </x-ui.collapsible>
        @endforeach
    </x-ui.sidebar-menu>
</x-ui.sidebar-group>
