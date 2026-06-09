{{-- Long content scrolls inside the drawer while the header and footer stay fixed. --}}
<x-ui.drawer>
    <x-ui.drawer-trigger>
        <x-ui.button variant="outline">Open scrollable drawer</x-ui.button>
    </x-ui.drawer-trigger>
    <x-ui.drawer-content>
        <div class="mx-auto flex w-full max-w-sm flex-col overflow-hidden">
            <x-ui.drawer-header>
                <x-ui.drawer-title>Terms of Service</x-ui.drawer-title>
                <x-ui.drawer-description>Please read these terms before continuing.</x-ui.drawer-description>
            </x-ui.drawer-header>
            <div class="text-muted-foreground space-y-4 overflow-y-auto px-4 text-sm">
                @foreach (range(1, 10) as $i)
                    <p><span class="text-foreground font-medium">{{ $i }}.</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                @endforeach
            </div>
            <x-ui.drawer-footer>
                <x-ui.button>Accept</x-ui.button>
                <x-ui.drawer-close>
                    <x-ui.button variant="outline" class="w-full">Decline</x-ui.button>
                </x-ui.drawer-close>
            </x-ui.drawer-footer>
        </div>
    </x-ui.drawer-content>
</x-ui.drawer>
