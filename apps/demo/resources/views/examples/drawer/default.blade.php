<x-ui.drawer>
    <x-ui.drawer-trigger>
        <x-ui.button variant="outline">Open Drawer</x-ui.button>
    </x-ui.drawer-trigger>
    <x-ui.drawer-content>
        <div class="mx-auto w-full max-w-sm">
            <x-ui.drawer-header>
                <x-ui.drawer-title>Move Goal</x-ui.drawer-title>
                <x-ui.drawer-description>Set your daily activity goal.</x-ui.drawer-description>
            </x-ui.drawer-header>
            <div class="p-4 pb-0">
                <div class="flex items-center justify-center space-x-2">
                    <x-ui.button variant="outline" size="icon" class="size-8 shrink-0 rounded-full">
                        <x-lucide-minus />
                        <span class="sr-only">Decrease</span>
                    </x-ui.button>
                    <div class="flex-1 text-center">
                        <div class="text-5xl font-bold tracking-tighter">350</div>
                        <div class="text-muted-foreground text-xs uppercase">Calories/day</div>
                    </div>
                    <x-ui.button variant="outline" size="icon" class="size-8 shrink-0 rounded-full">
                        <x-lucide-plus />
                        <span class="sr-only">Increase</span>
                    </x-ui.button>
                </div>
            </div>
            <x-ui.drawer-footer>
                <x-ui.button>Submit</x-ui.button>
                <x-ui.drawer-close>
                    <x-ui.button variant="outline" class="w-full">Cancel</x-ui.button>
                </x-ui.drawer-close>
            </x-ui.drawer-footer>
        </div>
    </x-ui.drawer-content>
</x-ui.drawer>
