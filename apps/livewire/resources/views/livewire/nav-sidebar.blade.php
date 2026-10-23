<div class="contents">
    <x-ui.sidebar>
        <x-ui.sidebar-header>
            <span data-testid="sidebar-renders">{{ $renders }}</span>
            <x-ui.button size="sm" wire:click="refresh" data-testid="sidebar-refresh">Refresh</x-ui.button>
        </x-ui.sidebar-header>
        <x-ui.sidebar-content persist data-testid="sidebar-list">
            <x-ui.sidebar-group>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button :href="$base" current="exact" wire:navigate>Overview</x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                    @foreach (range(1, 6) as $g)
                        <x-ui.collapsible data-testid="group-{{ $g }}">
                            <x-ui.sidebar-menu-item>
                                <x-ui.collapsible-trigger>
                                    <x-ui.sidebar-menu-button>Group {{ $g }}</x-ui.sidebar-menu-button>
                                </x-ui.collapsible-trigger>
                                <x-ui.collapsible-content>
                                    <x-ui.sidebar-menu-sub>
                                        @foreach (range(($g - 1) * 3 + 1, $g * 3) as $n)
                                            <x-ui.sidebar-menu-sub-item>
                                                <x-ui.sidebar-menu-sub-button :href="$base.'/'.$n" current wire:navigate>Sub {{ $n }}</x-ui.sidebar-menu-sub-button>
                                            </x-ui.sidebar-menu-sub-item>
                                        @endforeach
                                    </x-ui.sidebar-menu-sub>
                                </x-ui.collapsible-content>
                            </x-ui.sidebar-menu-item>
                        </x-ui.collapsible>
                    @endforeach
                    @foreach (range(19, 60) as $n)
                        <x-ui.sidebar-menu-item>
                            <x-ui.sidebar-menu-button :href="$base.'/'.$n" current wire:navigate>Page {{ $n }}</x-ui.sidebar-menu-button>
                        </x-ui.sidebar-menu-item>
                    @endforeach
                </x-ui.sidebar-menu>
            </x-ui.sidebar-group>
        </x-ui.sidebar-content>
    </x-ui.sidebar>
</div>
