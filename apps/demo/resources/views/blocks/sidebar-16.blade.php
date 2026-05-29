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

<x-layouts.app title="Sidebar 16">
    <div class="[--header-height:calc(--spacing(14))]">
        <x-ui.sidebar-provider class="flex flex-col">
            <header class="bg-background sticky top-0 z-50 flex w-full items-center border-b">
                <div class="flex h-(--header-height) w-full items-center gap-2 px-4">
                    <x-ui.button class="h-8 w-8" variant="ghost" size="icon" x-on:click="toggle()">
                        <x-lucide-sidebar />
                    </x-ui.button>
                    <x-ui.separator orientation="vertical" class="mr-2 h-4" />
                    <x-ui.breadcrumb class="hidden sm:block">
                        <x-ui.breadcrumb-list>
                            <x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-link href="#">Build Your Application</x-ui.breadcrumb-link>
                            </x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-separator />
                            <x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-page>Data Fetching</x-ui.breadcrumb-page>
                            </x-ui.breadcrumb-item>
                        </x-ui.breadcrumb-list>
                    </x-ui.breadcrumb>
                    <form class="w-full sm:ml-auto sm:w-auto">
                        <div class="relative">
                            <x-ui.label for="search" class="sr-only">Search</x-ui.label>
                            <x-ui.sidebar-input id="search" placeholder="Type to search..." class="h-8 pl-7" />
                            <x-lucide-search class="pointer-events-none absolute top-1/2 left-2 size-4 -translate-y-1/2 opacity-50 select-none" />
                        </div>
                    </form>
                </div>
            </header>
            <div class="flex flex-1">
                <x-ui.sidebar class="top-(--header-height) h-[calc(100svh-var(--header-height))]!">
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

                        <x-ui.sidebar-group class="group-data-[collapsible=icon]:hidden">
                            <x-ui.sidebar-group-label>Projects</x-ui.sidebar-group-label>
                            <x-ui.sidebar-menu>
                                @foreach ($projects as $project)
                                    <x-ui.sidebar-menu-item>
                                        <x-ui.sidebar-menu-button href="#">
                                            <x-dynamic-component :component="'lucide-'.$project['icon']" />
                                            <span>{{ $project['name'] }}</span>
                                        </x-ui.sidebar-menu-button>
                                        <x-ui.dropdown-menu>
                                            <x-ui.dropdown-menu-trigger>
                                                <x-ui.sidebar-menu-action :show-on-hover="true">
                                                    <x-lucide-more-horizontal />
                                                    <span class="sr-only">More</span>
                                                </x-ui.sidebar-menu-action>
                                            </x-ui.dropdown-menu-trigger>
                                            <x-ui.dropdown-menu-content class="w-48" side="right" align="start">
                                                <x-ui.dropdown-menu-item><x-lucide-folder class="text-muted-foreground" /><span>View Project</span></x-ui.dropdown-menu-item>
                                                <x-ui.dropdown-menu-item><x-lucide-share class="text-muted-foreground" /><span>Share Project</span></x-ui.dropdown-menu-item>
                                                <x-ui.dropdown-menu-separator />
                                                <x-ui.dropdown-menu-item><x-lucide-trash-2 class="text-muted-foreground" /><span>Delete Project</span></x-ui.dropdown-menu-item>
                                            </x-ui.dropdown-menu-content>
                                        </x-ui.dropdown-menu>
                                    </x-ui.sidebar-menu-item>
                                @endforeach
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button>
                                        <x-lucide-more-horizontal />
                                        <span>More</span>
                                    </x-ui.sidebar-menu-button>
                                </x-ui.sidebar-menu-item>
                            </x-ui.sidebar-menu>
                        </x-ui.sidebar-group>

                        <x-block.nav-secondary :items="$navSecondary" class="mt-auto" />
                    </x-ui.sidebar-content>
                    <x-ui.sidebar-footer>
                        <x-block.nav-user :name="$user['name']" :email="$user['email']" :avatar="$user['avatar']" />
                    </x-ui.sidebar-footer>
                </x-ui.sidebar>

                <x-ui.sidebar-inset>
                    <div class="flex flex-1 flex-col gap-4 p-4">
                        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                            <div class="bg-muted/50 aspect-video rounded-xl"></div>
                            <div class="bg-muted/50 aspect-video rounded-xl"></div>
                            <div class="bg-muted/50 aspect-video rounded-xl"></div>
                        </div>
                        <div class="bg-muted/50 min-h-[100vh] flex-1 rounded-xl md:min-h-min"></div>
                    </div>
                </x-ui.sidebar-inset>
            </div>
        </x-ui.sidebar-provider>
    </div>
</x-layouts.app>
