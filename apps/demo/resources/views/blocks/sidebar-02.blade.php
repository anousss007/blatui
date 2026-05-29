@php
    $versions = ['1.0.1', '1.1.0-alpha', '2.0.0-beta1'];
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

<x-layouts.app title="Sidebar 02">
    <x-ui.sidebar-provider>
        <x-ui.sidebar>
            <x-ui.sidebar-header>
                <x-block.version-switcher :versions="$versions" />
                <x-block.search-form />
            </x-ui.sidebar-header>
            <x-ui.sidebar-content class="gap-0">
                @foreach ($navMain as $group)
                    <x-ui.collapsible :open="true" class="group/collapsible" ::data-state="open ? 'open' : 'closed'">
                        <x-ui.sidebar-group>
                            <x-ui.collapsible-trigger
                                class="group/label text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground ring-sidebar-ring flex h-8 w-full shrink-0 items-center rounded-md px-2 text-sm font-medium outline-none transition-[margin,opacity] duration-200 ease-linear focus-visible:ring-2 [&>svg]:size-4 [&>svg]:shrink-0">
                                {{ $group['title'] }}
                                <x-lucide-chevron-right class="ml-auto transition-transform group-data-[state=open]/collapsible:rotate-90" />
                            </x-ui.collapsible-trigger>
                            <x-ui.collapsible-content>
                                <x-ui.sidebar-group-content>
                                    <x-ui.sidebar-menu>
                                        @foreach ($group['items'] as $item)
                                            <x-ui.sidebar-menu-item>
                                                <x-ui.sidebar-menu-button href="#" :is-active="$item['isActive'] ?? false">
                                                    {{ $item['title'] }}
                                                </x-ui.sidebar-menu-button>
                                            </x-ui.sidebar-menu-item>
                                        @endforeach
                                    </x-ui.sidebar-menu>
                                </x-ui.sidebar-group-content>
                            </x-ui.collapsible-content>
                        </x-ui.sidebar-group>
                    </x-ui.collapsible>
                @endforeach
            </x-ui.sidebar-content>
            <x-ui.sidebar-rail />
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="bg-background sticky top-0 flex h-16 shrink-0 items-center gap-2 border-b px-4">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 h-4" />
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
                @for ($i = 0; $i < 24; $i++)
                    <div class="bg-muted/50 aspect-video h-12 w-full rounded-lg"></div>
                @endfor
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
