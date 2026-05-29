@php
    $versions = ['1.0.1', '1.1.0-alpha', '2.0.0-beta1'];
    $navMain = [
        ['title' => 'Getting Started', 'items' => [
            ['title' => 'Installation'],
            ['title' => 'Project Structure'],
        ]],
        ['title' => 'Build Your Application', 'items' => [
            ['title' => 'Routing'],
            ['title' => 'Data Fetching', 'isActive' => true],
            ['title' => 'Rendering'],
            ['title' => 'Caching'],
            ['title' => 'Styling'],
            ['title' => 'Optimizing'],
            ['title' => 'Configuring'],
            ['title' => 'Testing'],
            ['title' => 'Authentication'],
            ['title' => 'Deploying'],
            ['title' => 'Upgrading'],
            ['title' => 'Examples'],
        ]],
        ['title' => 'API Reference', 'items' => [
            ['title' => 'Components'],
            ['title' => 'File Conventions'],
            ['title' => 'Functions'],
            ['title' => 'next.config.js Options'],
            ['title' => 'CLI'],
            ['title' => 'Edge Runtime'],
        ]],
        ['title' => 'Architecture', 'items' => [
            ['title' => 'Accessibility'],
            ['title' => 'Fast Refresh'],
            ['title' => 'Next.js Compiler'],
            ['title' => 'Supported Browsers'],
            ['title' => 'Turbopack'],
        ]],
    ];
@endphp

<x-layouts.app title="Sidebar 01">
    <x-ui.sidebar-provider>
        <x-ui.sidebar>
            <x-ui.sidebar-header>
                <x-block.version-switcher :versions="$versions" />
                <x-block.search-form />
            </x-ui.sidebar-header>

            <x-ui.sidebar-content>
                @foreach ($navMain as $group)
                    <x-ui.sidebar-group>
                        <x-ui.sidebar-group-label>{{ $group['title'] }}</x-ui.sidebar-group-label>
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
                    </x-ui.sidebar-group>
                @endforeach
            </x-ui.sidebar-content>
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
