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
        ['title' => 'Community', 'items' => [
            ['title' => 'Contribution Guide'],
        ]],
    ];
@endphp

<x-layouts.app title="Sidebar 04">
    <x-ui.sidebar-provider style="--sidebar-width: 19rem">
        <x-ui.sidebar variant="floating">
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
                    <x-ui.sidebar-menu class="gap-2">
                        @foreach ($navMain as $group)
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button href="#" class="font-medium">
                                    {{ $group['title'] }}
                                </x-ui.sidebar-menu-button>
                                @if (!empty($group['items']))
                                    <x-ui.sidebar-menu-sub class="ml-0 border-l-0 px-1.5">
                                        @foreach ($group['items'] as $item)
                                            <x-ui.sidebar-menu-sub-item>
                                                <x-ui.sidebar-menu-sub-button href="#" :is-active="$item['isActive'] ?? false">
                                                    {{ $item['title'] }}
                                                </x-ui.sidebar-menu-sub-button>
                                            </x-ui.sidebar-menu-sub-item>
                                        @endforeach
                                    </x-ui.sidebar-menu-sub>
                                @endif
                            </x-ui.sidebar-menu-item>
                        @endforeach
                    </x-ui.sidebar-menu>
                </x-ui.sidebar-group>
            </x-ui.sidebar-content>
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="flex h-16 shrink-0 items-center gap-2 px-4">
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
            <div class="flex flex-1 flex-col gap-4 p-4 pt-0">
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
