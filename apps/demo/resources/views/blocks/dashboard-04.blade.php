@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];

    $teams = [
        ['name' => 'Acme Projects', 'plan' => 'Workspace', 'logo' => 'gallery-vertical-end'],
    ];
    $nav = [
        ['title' => 'Dashboard', 'icon' => 'layout-dashboard', 'active' => true],
        ['title' => 'Projects', 'icon' => 'folder-kanban'],
        ['title' => 'Tasks', 'icon' => 'square-check-big'],
        ['title' => 'Team', 'icon' => 'users'],
        ['title' => 'Calendar', 'icon' => 'calendar'],
        ['title' => 'Reports', 'icon' => 'chart-no-axes-combined'],
    ];

    $cards = [
        ['label' => 'Active Projects', 'value' => '12', 'icon' => 'folder-kanban', 'sub' => '3 due this week'],
        ['label' => 'Tasks Completed', 'value' => '248', 'icon' => 'circle-check-big', 'sub' => '+32 this week'],
        ['label' => 'Team Members', 'value' => '16', 'icon' => 'users', 'sub' => '2 invited'],
        ['label' => 'Hours Logged', 'value' => '1,204', 'icon' => 'clock', 'sub' => 'this month'],
    ];

    $team = [
        ['name' => 'Olivia Martin', 'role' => 'Product Designer', 'fallback' => 'OM', 'status' => 'online'],
        ['name' => 'Jackson Lee', 'role' => 'Frontend Engineer', 'fallback' => 'JL', 'status' => 'online'],
        ['name' => 'Isabella Nguyen', 'role' => 'Backend Engineer', 'fallback' => 'IN', 'status' => 'away'],
        ['name' => 'William Kim', 'role' => 'Project Manager', 'fallback' => 'WK', 'status' => 'offline'],
    ];
    $statusDot = ['online' => 'bg-emerald-500', 'away' => 'bg-amber-500', 'offline' => 'bg-muted-foreground/40'];

    $projects = [
        ['name' => 'Website Redesign', 'badge' => 'On track', 'pct' => 72, 'tone' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400'],
        ['name' => 'Mobile App v2', 'badge' => 'At risk', 'pct' => 38, 'tone' => 'bg-amber-500/15 text-amber-700 dark:text-amber-400'],
        ['name' => 'Marketing Campaign', 'badge' => 'On track', 'pct' => 56, 'tone' => 'bg-emerald-500/15 text-emerald-700 dark:text-emerald-400'],
        ['name' => 'API Migration', 'badge' => 'Done', 'pct' => 100, 'tone' => 'bg-primary/15 text-primary'],
    ];
@endphp

<x-layouts.app title="Dashboard 04 — Projects">
    <x-ui.sidebar-provider style="--sidebar-width: calc(var(--spacing) * 68);">
        <x-ui.sidebar>
            <x-ui.sidebar-header>
                <x-block.team-switcher :teams="$teams" />
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>Workspace</x-ui.sidebar-group-label>
                    <x-ui.sidebar-menu>
                        @foreach ($nav as $item)
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button href="#" :is-active="$item['active'] ?? false">
                                    <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                    <span>{{ $item['title'] }}</span>
                                </x-ui.sidebar-menu-button>
                            </x-ui.sidebar-menu-item>
                        @endforeach
                    </x-ui.sidebar-menu>
                </x-ui.sidebar-group>
            </x-ui.sidebar-content>
            <x-ui.sidebar-footer>
                <x-block.nav-user :name="$user['name']" :email="$user['email']" :avatar="$user['avatar']" />
            </x-ui.sidebar-footer>
            <x-ui.sidebar-rail />
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="bg-background sticky top-0 z-10 flex h-16 shrink-0 items-center gap-2 border-b px-4 lg:px-6">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                <h1 class="text-base font-medium">Good morning, shadcn 👋</h1>
                <div class="ml-auto flex items-center gap-2">
                    <x-ui.button variant="outline" size="sm"><x-lucide-filter /> Filter</x-ui.button>
                    <x-ui.button size="sm"><x-lucide-plus /> New Task</x-ui.button>
                </div>
            </header>

            <div class="flex flex-1 flex-col gap-4 p-4 md:gap-6 md:p-6">
                {{-- Stat cards --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($cards as $c)
                        <x-ui.card>
                            <x-ui.card-content class="flex items-center gap-4 p-5">
                                <div class="bg-primary/10 text-primary flex size-11 shrink-0 items-center justify-center rounded-xl">
                                    <x-dynamic-component :component="'lucide-'.$c['icon']" class="size-5" />
                                </div>
                                <div class="min-w-0">
                                    <div class="text-2xl font-semibold tabular-nums leading-tight">{{ $c['value'] }}</div>
                                    <div class="text-muted-foreground truncate text-sm">{{ $c['label'] }}</div>
                                </div>
                            </x-ui.card-content>
                        </x-ui.card>
                    @endforeach
                </div>

                {{-- Goals + Calendar + Team --}}
                <div class="grid grid-cols-1 gap-4 md:gap-6 lg:grid-cols-3">
                    <x-ui.card>
                        <x-ui.card-header>
                            <x-ui.card-title>Quarterly Goals</x-ui.card-title>
                            <x-ui.card-description>Completion by objective</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content>
                            <x-ui.chart type="radialBar" :height="260"
                                :series="[88, 64, 47]"
                                :labels="['Revenue', 'Growth', 'Retention']"
                                :colors="['var(--chart-1)', 'var(--chart-2)', 'var(--chart-3)']"
                                :options="[
                                    'plotOptions' => ['radialBar' => ['hollow' => ['size' => '32%'], 'track' => ['background' => 'var(--muted)'], 'dataLabels' => ['name' => ['fontSize' => '12px'], 'value' => ['fontSize' => '14px']]]],
                                    'legend' => ['show' => true, 'position' => 'bottom'],
                                ]"
                                class="mx-auto aspect-square max-h-[260px]" />
                        </x-ui.card-content>
                    </x-ui.card>

                    <x-ui.card class="flex flex-col">
                        <x-ui.card-header>
                            <x-ui.card-title>Calendar</x-ui.card-title>
                            <x-ui.card-description>June 2025</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content class="flex flex-1 items-center justify-center">
                            <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" class="border-0 p-0" />
                        </x-ui.card-content>
                    </x-ui.card>

                    <x-ui.card>
                        <x-ui.card-header>
                            <x-ui.card-title>Team</x-ui.card-title>
                            <x-ui.card-description>Who's around today</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content class="space-y-4">
                            @foreach ($team as $m)
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <x-ui.avatar class="size-9">
                                            <x-ui.avatar-fallback>{{ $m['fallback'] }}</x-ui.avatar-fallback>
                                        </x-ui.avatar>
                                        <span class="border-card absolute -right-0.5 -bottom-0.5 size-3 rounded-full border-2 {{ $statusDot[$m['status']] }}"></span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium">{{ $m['name'] }}</p>
                                        <p class="text-muted-foreground truncate text-xs">{{ $m['role'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </x-ui.card-content>
                    </x-ui.card>
                </div>

                {{-- Project progress --}}
                <x-ui.card>
                    <x-ui.card-header>
                        <x-ui.card-title>Project Progress</x-ui.card-title>
                        <x-ui.card-description>Status across active projects</x-ui.card-description>
                    </x-ui.card-header>
                    <x-ui.card-content class="space-y-5">
                        @foreach ($projects as $p)
                            <div class="space-y-2">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-sm font-medium">{{ $p['name'] }}</span>
                                    <div class="flex items-center gap-3">
                                        <x-ui.badge variant="outline" class="border-transparent {{ $p['tone'] }}">{{ $p['badge'] }}</x-ui.badge>
                                        <span class="text-muted-foreground w-9 text-right text-sm tabular-nums">{{ $p['pct'] }}%</span>
                                    </div>
                                </div>
                                <x-ui.progress :value="$p['pct']" class="h-2" />
                            </div>
                        @endforeach
                    </x-ui.card-content>
                </x-ui.card>
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
