@props([
    'name' => 'shadcn',
    'email' => 'm@example.com',
    'avatar' => '',
    'fallback' => 'CN',
    'align' => 'end',
])

<x-ui.sidebar-menu>
    <x-ui.sidebar-menu-item>
        <x-ui.dropdown-menu>
            <x-ui.dropdown-menu-trigger class="w-full">
                <x-ui.sidebar-menu-button size="lg"
                    class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
                    ::data-state="open ? 'open' : 'closed'">
                    <x-ui.avatar class="h-8 w-8 rounded-lg">
                        @if ($avatar)
                            <x-ui.avatar-image src="{{ $avatar }}" alt="{{ $name }}" />
                        @endif
                        <x-ui.avatar-fallback class="rounded-lg">{{ $fallback }}</x-ui.avatar-fallback>
                    </x-ui.avatar>
                    <div class="grid flex-1 text-left text-sm leading-tight">
                        <span class="truncate font-medium">{{ $name }}</span>
                        <span class="truncate text-xs">{{ $email }}</span>
                    </div>
                    <x-lucide-chevrons-up-down class="ml-auto size-4" />
                </x-ui.sidebar-menu-button>
            </x-ui.dropdown-menu-trigger>
            <x-ui.dropdown-menu-content class="w-(--radix-dropdown-menu-trigger-width) min-w-56 rounded-lg" side="right" :align="$align" :side-offset="4">
                <x-ui.dropdown-menu-label class="p-0 font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                        <x-ui.avatar class="h-8 w-8 rounded-lg">
                            @if ($avatar)
                                <x-ui.avatar-image src="{{ $avatar }}" alt="{{ $name }}" />
                            @endif
                            <x-ui.avatar-fallback class="rounded-lg">{{ $fallback }}</x-ui.avatar-fallback>
                        </x-ui.avatar>
                        <div class="grid flex-1 text-left text-sm leading-tight">
                            <span class="truncate font-medium">{{ $name }}</span>
                            <span class="truncate text-xs">{{ $email }}</span>
                        </div>
                    </div>
                </x-ui.dropdown-menu-label>
                <x-ui.dropdown-menu-separator />
                <x-ui.dropdown-menu-group>
                    <x-ui.dropdown-menu-item>
                        <x-lucide-sparkles />
                        Upgrade to Pro
                    </x-ui.dropdown-menu-item>
                </x-ui.dropdown-menu-group>
                <x-ui.dropdown-menu-separator />
                <x-ui.dropdown-menu-group>
                    <x-ui.dropdown-menu-item>
                        <x-lucide-badge-check />
                        Account
                    </x-ui.dropdown-menu-item>
                    <x-ui.dropdown-menu-item>
                        <x-lucide-credit-card />
                        Billing
                    </x-ui.dropdown-menu-item>
                    <x-ui.dropdown-menu-item>
                        <x-lucide-bell />
                        Notifications
                    </x-ui.dropdown-menu-item>
                </x-ui.dropdown-menu-group>
                <x-ui.dropdown-menu-separator />
                <x-ui.dropdown-menu-item>
                    <x-lucide-log-out />
                    Log out
                </x-ui.dropdown-menu-item>
            </x-ui.dropdown-menu-content>
        </x-ui.dropdown-menu>
    </x-ui.sidebar-menu-item>
</x-ui.sidebar-menu>
