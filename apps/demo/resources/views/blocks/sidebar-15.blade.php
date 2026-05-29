@php
    $teams = [
        ['name' => 'Acme Inc', 'logo' => 'command', 'plan' => 'Enterprise'],
        ['name' => 'Acme Corp.', 'logo' => 'audio-waveform', 'plan' => 'Startup'],
        ['name' => 'Evil Corp.', 'logo' => 'command', 'plan' => 'Free'],
    ];
    $navMain = [
        ['title' => 'Search', 'icon' => 'search'],
        ['title' => 'Ask AI', 'icon' => 'sparkles'],
        ['title' => 'Home', 'icon' => 'home', 'isActive' => true],
        ['title' => 'Inbox', 'icon' => 'inbox', 'badge' => '10'],
    ];
    $navSecondary = [
        ['title' => 'Calendar', 'icon' => 'calendar'],
        ['title' => 'Settings', 'icon' => 'settings-2'],
        ['title' => 'Templates', 'icon' => 'blocks'],
        ['title' => 'Trash', 'icon' => 'trash-2'],
        ['title' => 'Help', 'icon' => 'message-circle-question'],
    ];
    $favorites = [
        ['name' => 'Project Management & Task Tracking', 'emoji' => '📊'],
        ['name' => 'Family Recipe Collection & Meal Planning', 'emoji' => '🍳'],
        ['name' => 'Fitness Tracker & Workout Routines', 'emoji' => '💪'],
        ['name' => 'Book Notes & Reading List', 'emoji' => '📚'],
        ['name' => 'Sustainable Gardening Tips & Plant Care', 'emoji' => '🌱'],
        ['name' => 'Language Learning Progress & Resources', 'emoji' => '🗣️'],
        ['name' => 'Home Renovation Ideas & Budget Tracker', 'emoji' => '🏠'],
        ['name' => 'Personal Finance & Investment Portfolio', 'emoji' => '💰'],
        ['name' => 'Movie & TV Show Watchlist with Reviews', 'emoji' => '🎬'],
        ['name' => 'Daily Habit Tracker & Goal Setting', 'emoji' => '✅'],
    ];
    $workspaces = [
        ['name' => 'Personal Life Management', 'emoji' => '🏠', 'pages' => [
            ['name' => 'Daily Journal & Reflection', 'emoji' => '📔'],
            ['name' => 'Health & Wellness Tracker', 'emoji' => '🍏'],
            ['name' => 'Personal Growth & Learning Goals', 'emoji' => '🌟'],
        ]],
        ['name' => 'Professional Development', 'emoji' => '💼', 'pages' => [
            ['name' => 'Career Objectives & Milestones', 'emoji' => '🎯'],
            ['name' => 'Skill Acquisition & Training Log', 'emoji' => '🧠'],
            ['name' => 'Networking Contacts & Events', 'emoji' => '🤝'],
        ]],
        ['name' => 'Creative Projects', 'emoji' => '🎨', 'pages' => [
            ['name' => 'Writing Ideas & Story Outlines', 'emoji' => '✍️'],
            ['name' => 'Art & Design Portfolio', 'emoji' => '🖼️'],
            ['name' => 'Music Composition & Practice Log', 'emoji' => '🎵'],
        ]],
        ['name' => 'Home Management', 'emoji' => '🏡', 'pages' => [
            ['name' => 'Household Budget & Expense Tracking', 'emoji' => '💰'],
            ['name' => 'Home Maintenance Schedule & Tasks', 'emoji' => '🔧'],
            ['name' => 'Family Calendar & Event Planning', 'emoji' => '📅'],
        ]],
        ['name' => 'Travel & Adventure', 'emoji' => '🧳', 'pages' => [
            ['name' => 'Trip Planning & Itineraries', 'emoji' => '🗺️'],
            ['name' => 'Travel Bucket List & Inspiration', 'emoji' => '🌎'],
            ['name' => 'Travel Journal & Photo Gallery', 'emoji' => '📸'],
        ]],
    ];
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];
    $calendars = [
        ['name' => 'My Calendars', 'items' => ['Personal', 'Work', 'Family']],
        ['name' => 'Favorites', 'items' => ['Holidays', 'Birthdays']],
        ['name' => 'Other', 'items' => ['Travel', 'Reminders', 'Deadlines']],
    ];
@endphp

<x-layouts.app title="Sidebar 15">
    <x-ui.sidebar-provider>
        <x-ui.sidebar class="border-r-0">
            <x-ui.sidebar-header>
                <x-ui.sidebar-menu x-data="{ active: 0 }">
                    <x-ui.sidebar-menu-item>
                        <x-ui.dropdown-menu>
                            <x-ui.dropdown-menu-trigger>
                                <x-ui.sidebar-menu-button class="w-fit px-1.5">
                                    <div class="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-5 items-center justify-center rounded-md">
                                        @foreach ($teams as $i => $team)
                                            <span x-show="active === {{ $i }}"><x-dynamic-component :component="'lucide-'.$team['logo']" class="size-3" /></span>
                                        @endforeach
                                    </div>
                                    <span class="truncate font-medium" x-text="{{ \Illuminate\Support\Js::from(array_column($teams, 'name')) }}[active]"></span>
                                    <x-lucide-chevron-down class="opacity-50" />
                                </x-ui.sidebar-menu-button>
                            </x-ui.dropdown-menu-trigger>
                            <x-ui.dropdown-menu-content class="w-64 rounded-lg" align="start" side="bottom" :side-offset="4">
                                <x-ui.dropdown-menu-label class="text-muted-foreground text-xs">Teams</x-ui.dropdown-menu-label>
                                @foreach ($teams as $i => $team)
                                    <x-ui.dropdown-menu-item x-on:click="active = {{ $i }}" class="gap-2 p-2">
                                        <div class="flex size-6 items-center justify-center rounded-xs border">
                                            <x-dynamic-component :component="'lucide-'.$team['logo']" class="size-4 shrink-0" />
                                        </div>
                                        {{ $team['name'] }}
                                        <x-ui.dropdown-menu-shortcut>⌘{{ $i + 1 }}</x-ui.dropdown-menu-shortcut>
                                    </x-ui.dropdown-menu-item>
                                @endforeach
                                <x-ui.dropdown-menu-separator />
                                <x-ui.dropdown-menu-item class="gap-2 p-2">
                                    <div class="bg-background flex size-6 items-center justify-center rounded-md border">
                                        <x-lucide-plus class="size-4" />
                                    </div>
                                    <div class="text-muted-foreground font-medium">Add team</div>
                                </x-ui.dropdown-menu-item>
                            </x-ui.dropdown-menu-content>
                        </x-ui.dropdown-menu>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
                <x-ui.sidebar-menu>
                    @foreach ($navMain as $item)
                        <x-ui.sidebar-menu-item>
                            <x-ui.sidebar-menu-button href="#" :is-active="$item['isActive'] ?? false">
                                <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                <span>{{ $item['title'] }}</span>
                            </x-ui.sidebar-menu-button>
                        </x-ui.sidebar-menu-item>
                    @endforeach
                </x-ui.sidebar-menu>
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group class="group-data-[collapsible=icon]:hidden">
                    <x-ui.sidebar-group-label>Favorites</x-ui.sidebar-group-label>
                    <x-ui.sidebar-menu>
                        @foreach ($favorites as $item)
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button href="#" title="{{ $item['name'] }}">
                                    <span>{{ $item['emoji'] }}</span>
                                    <span>{{ $item['name'] }}</span>
                                </x-ui.sidebar-menu-button>
                                <x-ui.dropdown-menu>
                                    <x-ui.dropdown-menu-trigger>
                                        <x-ui.sidebar-menu-action :show-on-hover="true">
                                            <x-lucide-more-horizontal />
                                            <span class="sr-only">More</span>
                                        </x-ui.sidebar-menu-action>
                                    </x-ui.dropdown-menu-trigger>
                                    <x-ui.dropdown-menu-content class="w-56 rounded-lg" side="right" align="start">
                                        <x-ui.dropdown-menu-item><x-lucide-star-off class="text-muted-foreground" /><span>Remove from Favorites</span></x-ui.dropdown-menu-item>
                                        <x-ui.dropdown-menu-separator />
                                        <x-ui.dropdown-menu-item><x-lucide-link class="text-muted-foreground" /><span>Copy Link</span></x-ui.dropdown-menu-item>
                                        <x-ui.dropdown-menu-item><x-lucide-arrow-up-right class="text-muted-foreground" /><span>Open in New Tab</span></x-ui.dropdown-menu-item>
                                        <x-ui.dropdown-menu-separator />
                                        <x-ui.dropdown-menu-item><x-lucide-trash-2 class="text-muted-foreground" /><span>Delete</span></x-ui.dropdown-menu-item>
                                    </x-ui.dropdown-menu-content>
                                </x-ui.dropdown-menu>
                            </x-ui.sidebar-menu-item>
                        @endforeach
                        <x-ui.sidebar-menu-item>
                            <x-ui.sidebar-menu-button class="text-sidebar-foreground/70">
                                <x-lucide-more-horizontal />
                                <span>More</span>
                            </x-ui.sidebar-menu-button>
                        </x-ui.sidebar-menu-item>
                    </x-ui.sidebar-menu>
                </x-ui.sidebar-group>

                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>Workspaces</x-ui.sidebar-group-label>
                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>
                            @foreach ($workspaces as $workspace)
                                <x-ui.collapsible>
                                    <x-ui.sidebar-menu-item>
                                        <x-ui.sidebar-menu-button href="#">
                                            <span>{{ $workspace['emoji'] }}</span>
                                            <span>{{ $workspace['name'] }}</span>
                                        </x-ui.sidebar-menu-button>
                                        <x-ui.sidebar-menu-action class="bg-sidebar-accent text-sidebar-accent-foreground left-2 data-[state=open]:rotate-90" :show-on-hover="true" x-on:click="open = !open" ::data-state="open ? 'open' : 'closed'">
                                            <x-lucide-chevron-right />
                                        </x-ui.sidebar-menu-action>
                                        <x-ui.sidebar-menu-action :show-on-hover="true">
                                            <x-lucide-plus />
                                        </x-ui.sidebar-menu-action>
                                        <x-ui.collapsible-content>
                                            <x-ui.sidebar-menu-sub>
                                                @foreach ($workspace['pages'] as $page)
                                                    <x-ui.sidebar-menu-sub-item>
                                                        <x-ui.sidebar-menu-sub-button href="#">
                                                            <span>{{ $page['emoji'] }}</span>
                                                            <span>{{ $page['name'] }}</span>
                                                        </x-ui.sidebar-menu-sub-button>
                                                    </x-ui.sidebar-menu-sub-item>
                                                @endforeach
                                            </x-ui.sidebar-menu-sub>
                                        </x-ui.collapsible-content>
                                    </x-ui.sidebar-menu-item>
                                </x-ui.collapsible>
                            @endforeach
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button class="text-sidebar-foreground/70">
                                    <x-lucide-more-horizontal />
                                    <span>More</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>
                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>

                <x-ui.sidebar-group class="mt-auto">
                    <x-ui.sidebar-group-content>
                        <x-ui.sidebar-menu>
                            @foreach ($navSecondary as $item)
                                <x-ui.sidebar-menu-item>
                                    <x-ui.sidebar-menu-button href="#">
                                        <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                        <span>{{ $item['title'] }}</span>
                                    </x-ui.sidebar-menu-button>
                                </x-ui.sidebar-menu-item>
                            @endforeach
                        </x-ui.sidebar-menu>
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>
            </x-ui.sidebar-content>
            <x-ui.sidebar-rail />
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="bg-background sticky top-0 flex h-14 shrink-0 items-center gap-2">
                <div class="flex flex-1 items-center gap-2 px-3">
                    <x-ui.sidebar-trigger />
                    <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                    <x-ui.breadcrumb>
                        <x-ui.breadcrumb-list>
                            <x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-page class="line-clamp-1">Project Management &amp; Task Tracking</x-ui.breadcrumb-page>
                            </x-ui.breadcrumb-item>
                        </x-ui.breadcrumb-list>
                    </x-ui.breadcrumb>
                </div>
            </header>
            <div class="flex flex-1 flex-col gap-4 p-4">
                <div class="bg-muted/50 mx-auto h-24 w-full max-w-3xl rounded-xl"></div>
                <div class="bg-muted/50 mx-auto h-[100vh] w-full max-w-3xl rounded-xl"></div>
            </div>
        </x-ui.sidebar-inset>

        <x-ui.sidebar collapsible="none" class="sticky top-0 hidden h-svh border-l lg:flex">
            <x-ui.sidebar-header class="border-sidebar-border h-16 border-b">
                <x-block.nav-user :name="$user['name']" :email="$user['email']" :avatar="$user['avatar']" align="start" />
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group class="px-0">
                    <x-ui.sidebar-group-content>
                        <x-ui.calendar class="[&_[role=gridcell]]:w-[33px]" />
                    </x-ui.sidebar-group-content>
                </x-ui.sidebar-group>
                <x-ui.sidebar-separator class="mx-0" />
                @foreach ($calendars as $index => $calendar)
                    <x-ui.sidebar-group class="py-0">
                        <x-ui.collapsible :open="$index === 0" class="group/collapsible" ::data-state="open ? 'open' : 'closed'">
                            <x-ui.sidebar-group-label
                                class="group/label text-sidebar-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground w-full text-sm"
                                x-on:click="open = !open" ::data-state="open ? 'open' : 'closed'" role="button">
                                {{ $calendar['name'] }}
                                <x-lucide-chevron-right class="ml-auto transition-transform group-data-[state=open]/collapsible:rotate-90" />
                            </x-ui.sidebar-group-label>
                            <x-ui.collapsible-content>
                                <x-ui.sidebar-group-content>
                                    <x-ui.sidebar-menu>
                                        @foreach ($calendar['items'] as $i => $item)
                                            <x-ui.sidebar-menu-item>
                                                <x-ui.sidebar-menu-button>
                                                    <div @if ($i < 2) data-active="true" @endif class="group/calendar-item border-sidebar-border text-sidebar-primary-foreground data-[active=true]:border-sidebar-primary data-[active=true]:bg-sidebar-primary flex aspect-square size-4 shrink-0 items-center justify-center rounded-sm border">
                                                        <x-lucide-check class="hidden size-3 group-data-[active=true]/calendar-item:block" />
                                                    </div>
                                                    {{ $item }}
                                                </x-ui.sidebar-menu-button>
                                            </x-ui.sidebar-menu-item>
                                        @endforeach
                                    </x-ui.sidebar-menu>
                                </x-ui.sidebar-group-content>
                            </x-ui.collapsible-content>
                        </x-ui.collapsible>
                    </x-ui.sidebar-group>
                    <x-ui.sidebar-separator class="mx-0" />
                @endforeach
            </x-ui.sidebar-content>
            <x-ui.sidebar-footer>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button>
                            <x-lucide-plus />
                            <span>New Calendar</span>
                        </x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-footer>
        </x-ui.sidebar>
    </x-ui.sidebar-provider>
</x-layouts.app>
