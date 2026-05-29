@php
    $changes = [
        ['file' => 'README.md', 'state' => 'M'],
        ['file' => 'api/hello/route.ts', 'state' => 'U'],
        ['file' => 'app/layout.tsx', 'state' => 'M'],
    ];
    $tree = [
        ['app', ['api', ['hello', ['route.ts']], 'page.tsx', 'layout.tsx', ['blog', ['page.tsx']]]],
        ['components', ['ui', 'button.tsx', 'card.tsx'], 'header.tsx', 'footer.tsx'],
        ['lib', ['util.ts']],
        ['public', 'favicon.ico', 'vercel.svg'],
        '.eslintrc.json',
        '.gitignore',
        'next.config.js',
        'tailwind.config.js',
        'package.json',
        'README.md',
    ];
@endphp

<x-layouts.app title="Sidebar 11">
    <x-ui.sidebar-provider>
        <x-ui.sidebar>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>Changes</x-ui.sidebar-group-label>
                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>
                            @foreach ($changes as $item)
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button>
                                        <x-lucide-file />
                                        {{ $item['file'] }}
                                    </x-ui.sidebar-menu-button>
                                    <x-ui.sidebar-menu-badge>{{ $item['state'] }}</x-ui.sidebar-menu-badge>
                                </x-ui.sidebar-menu-item>
                            @endforeach
                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>
                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>Files</x-ui.sidebar-group-label>
                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>
                            @foreach ($tree as $item)
                                <x-block.file-tree :item="$item" />
                            @endforeach
                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>
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
                            <x-ui.breadcrumb-link href="#">components</x-ui.breadcrumb-link>
                        </x-ui.breadcrumb-item>
                        <x-ui.breadcrumb-separator class="hidden md:block" />
                        <x-ui.breadcrumb-item class="hidden md:block">
                            <x-ui.breadcrumb-link href="#">ui</x-ui.breadcrumb-link>
                        </x-ui.breadcrumb-item>
                        <x-ui.breadcrumb-separator class="hidden md:block" />
                        <x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-page>button.tsx</x-ui.breadcrumb-page>
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
