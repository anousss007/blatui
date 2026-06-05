<div class="bg-sidebar text-sidebar-foreground flex h-[460px] w-[260px] flex-col overflow-hidden rounded-lg border">
    <x-ui.sidebar-header>
        <div class="flex items-center gap-2 px-2 py-1">
            <span class="bg-sidebar-primary text-sidebar-primary-foreground flex size-8 items-center justify-center rounded-lg">
                <x-lucide-component class="size-4" aria-hidden="true" />
            </span>
            <div class="text-sm leading-tight">
                <div class="font-semibold">Acme Inc</div>
                <div class="text-muted-foreground text-xs">Enterprise</div>
            </div>
        </div>
    </x-ui.sidebar-header>
    <x-ui.sidebar-content>
        <x-ui.sidebar-group>
            <x-ui.sidebar-group-label>Application</x-ui.sidebar-group-label>
            <x-ui.sidebar-group-content>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button is-active><x-lucide-house /><span>Home</span></x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button><x-lucide-inbox /><span>Inbox</span></x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button><x-lucide-calendar /><span>Calendar</span></x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-group-content>
        </x-ui.sidebar-group>
    </x-ui.sidebar-content>
    <x-ui.sidebar-footer>
        <div class="flex items-center gap-2 px-2 py-1">
            <x-ui.avatar class="size-8"><x-ui.avatar-fallback>SC</x-ui.avatar-fallback></x-ui.avatar>
            <div class="text-sm leading-tight">
                <div class="font-medium">Sofia Carter</div>
                <div class="text-muted-foreground text-xs">sofia@acme.com</div>
            </div>
        </div>
    </x-ui.sidebar-footer>
</div>
