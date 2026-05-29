@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];
    $navMain = [
        ['title' => 'Playground', 'icon' => 'square-terminal', 'isActive' => true, 'items' => [
            ['title' => 'History'], ['title' => 'Starred'], ['title' => 'Settings'],
        ]],
        ['title' => 'Models', 'icon' => 'bot', 'items' => [
            ['title' => 'Genesis'], ['title' => 'Explorer'], ['title' => 'Quantum'],
        ]],
        ['title' => 'Documentation', 'icon' => 'book-open', 'items' => [
            ['title' => 'Introduction'], ['title' => 'Get Started'], ['title' => 'Tutorials'], ['title' => 'Changelog'],
        ]],
        ['title' => 'Settings', 'icon' => 'settings-2', 'items' => [
            ['title' => 'General'], ['title' => 'Team'], ['title' => 'Billing'], ['title' => 'Limits'],
        ]],
    ];
    $navSecondary = [
        ['title' => 'Support', 'icon' => 'life-buoy'],
        ['title' => 'Feedback', 'icon' => 'send'],
    ];
    $projects = [
        ['name' => 'Design Engineering', 'icon' => 'frame'],
        ['name' => 'Sales & Marketing', 'icon' => 'pie-chart'],
        ['name' => 'Travel', 'icon' => 'map'],
    ];
@endphp

<x-layouts.app title="Sidebar 08">
    <x-ui.sidebar-provider>
        <x-ui.sidebar variant="inset">
            <x-ui.sidebar-header>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button size="lg" href="#">
                            <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                                <x-lucide-command class="size-4" />
                            </div>
                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-medium">Acme Inc</span>
                                <span class="truncate text-xs">Enterprise</span>
                            </div>
                        </x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>Platform</x-ui.sidebar-group-label>
                    <x-ui.sidebar-menu>
                        @foreach ($navMain as $item)
                            <x-ui.collapsible :open="$item['isActive'] ?? false">
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button x-on:click="open = !open" ::data-state="open ? 'open' : 'closed'" class="cursor-pointer">
                                        <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                        <span>{{ $item['title'] }}</span>
                                    </x-ui.sidebar-menu-button>
                                    @if (!empty($item['items']))
                                        <x-ui.sidebar-menu-action class="data-[state=open]:rotate-90" x-on:click="open = !open" ::data-state="open ? 'open' : 'closed'">
                                            <x-lucide-chevron-right />
                                            <span class="sr-only">Toggle</span>
                                        </x-ui.sidebar-menu-action>
                                        <x-ui.collapsible-content>
                                            <x-ui.sidebar-menu-sub>
                                                @foreach ($item['items'] as $subItem)
                                                    <x-ui.sidebar-menu-sub-item>
                                                        <x-ui.sidebar-menu-sub-button href="#">
                                                            <span>{{ $subItem['title'] }}</span>
                                                        </x-ui.sidebar-menu-sub-button>
                                                    </x-ui.sidebar-menu-sub-item>
                                                @endforeach
                                            </x-ui.sidebar-menu-sub>
                                        </x-ui.collapsible-content>
                                    @endif
                                </x-ui.sidebar-menu-item>
                            </x-ui.collapsible>
                        @endforeach
                    </x-ui.sidebar-menu>
                </x-ui.sidebar-group>
                <x-block.nav-projects :projects="$projects" />
                <x-block.nav-secondary :items="$navSecondary" class="mt-auto" />
            </x-ui.sidebar-content>
            <x-ui.sidebar-footer>
                <x-block.nav-user :name="$user['name']" :email="$user['email']" :avatar="$user['avatar']" />
            </x-ui.sidebar-footer>
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="flex h-16 shrink-0 items-center gap-2">
                <div class="flex items-center gap-2 px-4">
                    <x-ui.sidebar-trigger class="-ml-1" />
                    <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                    <x-ui.breadcrumb>
                        <x-ui.breadcrumb-list>
                            <x-ui.breadcrumb-item class="hidden md:block">
                                <x-ui.breadcrumb-link href="#">Building Your Application</x-ui.breadcrumb-link>
                            </x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-separator class="hidden md:block" />
                            <x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-page>Data Fetching</x-ui.breadcrumb-page>
                            </x-ui.breadcrumb-item>
                        </x-ui.breadcrumb-list>
                    </x-ui.breadcrumb>
                </div>
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
