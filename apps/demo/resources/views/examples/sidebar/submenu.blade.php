<div class="bg-sidebar text-sidebar-foreground flex h-[420px] w-[260px] flex-col overflow-hidden rounded-lg border">
    <x-ui.sidebar-content>
        <x-ui.sidebar-group>
            <x-ui.sidebar-group-label>Platform</x-ui.sidebar-group-label>
            <x-ui.sidebar-group-content>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button><x-lucide-inbox /><span>Inbox</span></x-ui.sidebar-menu-button>
                        <x-ui.sidebar-menu-badge>12</x-ui.sidebar-menu-badge>
                    </x-ui.sidebar-menu-item>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button is-active><x-lucide-settings /><span>Settings</span></x-ui.sidebar-menu-button>
                        <x-ui.sidebar-menu-sub>
                            <x-ui.sidebar-menu-sub-item>
                                <x-ui.sidebar-menu-sub-button href="#">General</x-ui.sidebar-menu-sub-button>
                            </x-ui.sidebar-menu-sub-item>
                            <x-ui.sidebar-menu-sub-item>
                                <x-ui.sidebar-menu-sub-button href="#" is-active>Team</x-ui.sidebar-menu-sub-button>
                            </x-ui.sidebar-menu-sub-item>
                            <x-ui.sidebar-menu-sub-item>
                                <x-ui.sidebar-menu-sub-button href="#">Billing</x-ui.sidebar-menu-sub-button>
                            </x-ui.sidebar-menu-sub-item>
                        </x-ui.sidebar-menu-sub>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-group-content>
        </x-ui.sidebar-group>
    </x-ui.sidebar-content>
</div>
