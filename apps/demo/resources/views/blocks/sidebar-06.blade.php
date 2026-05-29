@php
    $navMain = [
        ['title' => 'Getting Started', 'items' => [
            ['title' => 'Installation'], ['title' => 'Project Structure'],
        ]],
        ['title' => 'Build Your Application', 'items' => [
            ['title' => 'Routing'], ['title' => 'Data Fetching', 'isActive' => true],
            ['title' => 'Rendering'], ['title' => 'Caching'], ['title' => 'Styling'],
            ['title' => 'Optimizing'], ['title' => 'Configuring'], ['title' => 'Testing'],
            ['title' => 'Authentication'], ['title' => 'Deploying'], ['title' => 'Upgrading'],
            ['title' => 'Examples'],
        ]],
        ['title' => 'API Reference', 'items' => [
            ['title' => 'Components'], ['title' => 'File Conventions'], ['title' => 'Functions'],
            ['title' => 'next.config.js Options'], ['title' => 'CLI'], ['title' => 'Edge Runtime'],
        ]],
        ['title' => 'Architecture', 'items' => [
            ['title' => 'Accessibility'], ['title' => 'Fast Refresh'], ['title' => 'Next.js Compiler'],
            ['title' => 'Supported Browsers'], ['title' => 'Turbopack'],
        ]],
    ];
@endphp

<x-layouts.app title="Sidebar 06">
    <x-ui.sidebar-provider>
        <x-ui.sidebar>
            <x-ui.sidebar-header>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button size="lg" href="#">
                            <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                                <x-lucide-gallery-vertical-end class="size-4" />
                            </div>
                            <div class="flex flex-col gap-0.5 leading-none">
                                <span class="font-medium">Documentation</span>
                                <span>v1.0.0</span>
                            </div>
                        </x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group>
                    <x-ui.sidebar-menu>
                        @foreach ($navMain as $group)
                            <x-ui.dropdown-menu>
                                <x-ui.sidebar-menu-item>
                                    <x-ui.dropdown-menu-trigger>
                                        <x-ui.sidebar-menu-button class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground" ::data-state="open ? 'open' : 'closed'">
                                            {{ $group['title'] }}
                                            <x-lucide-more-horizontal class="ml-auto" />
                                        </x-ui.sidebar-menu-button>
                                    </x-ui.dropdown-menu-trigger>
                                    @if (!empty($group['items']))
                                        <x-ui.dropdown-menu-content side="right" align="start" class="min-w-56 rounded-lg">
                                            @foreach ($group['items'] as $item)
                                                <x-ui.dropdown-menu-item href="#">{{ $item['title'] }}</x-ui.dropdown-menu-item>
                                            @endforeach
                                        </x-ui.dropdown-menu-content>
                                    @endif
                                </x-ui.sidebar-menu-item>
                            </x-ui.dropdown-menu>
                        @endforeach
                    </x-ui.sidebar-menu>
                </x-ui.sidebar-group>
            </x-ui.sidebar-content>
            <x-ui.sidebar-footer>
                <div class="p-1">
                    <x-ui.card class="gap-2 py-4 shadow-none">
                        <x-ui.card-header class="px-4">
                            <x-ui.card-title class="text-sm">Subscribe to our newsletter</x-ui.card-title>
                            <x-ui.card-description>Opt-in to receive updates and news about the sidebar.</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content class="px-4">
                            <form>
                                <div class="grid gap-2.5">
                                    <x-ui.sidebar-input type="email" placeholder="Email" />
                                    <x-ui.button class="w-full bg-sidebar-primary text-sidebar-primary-foreground shadow-none" size="sm">
                                        Subscribe
                                    </x-ui.button>
                                </div>
                            </form>
                        </x-ui.card-content>
                    </x-ui.card>
                </div>
            </x-ui.sidebar-footer>
            <x-ui.sidebar-rail />
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="flex h-16 shrink-0 items-center gap-2 border-b px-4">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                <x-ui.breadcrumb>
                    <x-ui.breadcrumb-list>
                        <x-ui.breadcrumb-item class="hidden md:block">
                            <x-ui.breadcrumb-link href="#">Build Your Application</x-ui.breadcrumb-link>
                        </x-ui.breadcrumb-item>
                        <x-ui.breadcrumb-separator class="hidden md:block" />
                        <x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-page>Data Fetching</x-ui.breadcrumb-page>
                        </x-ui.breadcrumb-item>
                    </x-ui.breadcrumb-list>
                </x-ui.breadcrumb>
            </header>
            <div class="flex flex-1 flex-col gap-4 p-4">
                <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                    <div class="bg-muted/50 aspect-video rounded-xl"></div>
                    <div class="bg-muted/50 aspect-video rounded-xl"></div>
                    <div class="bg-muted/50 aspect-video rounded-xl"></div>
                </div>
                <div class="bg-muted/50 min-h-[100vh] flex-1 rounded-xl md:min-h-min"></div>
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
