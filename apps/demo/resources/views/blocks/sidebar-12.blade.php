@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];
    $calendars = [
        ['name' => 'My Calendars', 'items' => ['Personal', 'Work', 'Family']],
        ['name' => 'Favorites', 'items' => ['Holidays', 'Birthdays']],
        ['name' => 'Other', 'items' => ['Travel', 'Reminders', 'Deadlines']],
    ];
@endphp

<x-layouts.app title="Sidebar 12">
    <x-ui.sidebar-provider>
        <x-ui.sidebar>
            <x-ui.sidebar-header class="border-sidebar-border h-16 border-b">
                <x-block.nav-user :name="$user['name']" :email="$user['email']" :avatar="$user['avatar']" align="start" />
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group class="px-0">
                    <x-ui.sidebar-group-content>
                        <x-ui.calendar class="[&_[role=gridcell]]:w-[33px] [&_[role=gridcell].bg-accent]:bg-sidebar-primary [&_[role=gridcell].bg-accent]:text-sidebar-primary-foreground" />
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
            <x-ui.sidebar-rail />
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="bg-background sticky top-0 flex h-16 shrink-0 items-center gap-2 border-b px-4">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                <x-ui.breadcrumb>
                    <x-ui.breadcrumb-list>
                        <x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-page>October 2024</x-ui.breadcrumb-page>
                        </x-ui.breadcrumb-item>
                    </x-ui.breadcrumb-list>
                </x-ui.breadcrumb>
            </header>
            <div class="flex flex-1 flex-col gap-4 p-4">
                <div class="grid auto-rows-min gap-4 md:grid-cols-5">
                    @for ($i = 0; $i < 20; $i++)
                        <div class="bg-muted/50 aspect-square rounded-xl"></div>
                    @endfor
                </div>
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
