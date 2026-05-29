@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];

    $nav = [
        ['title' => 'Overview', 'icon' => 'layout-dashboard', 'active' => true],
        ['title' => 'Audience', 'icon' => 'users'],
        ['title' => 'Acquisition', 'icon' => 'route'],
        ['title' => 'Behavior', 'icon' => 'mouse-pointer-click'],
        ['title' => 'Conversions', 'icon' => 'target'],
        ['title' => 'Real-time', 'icon' => 'activity'],
    ];
    $navSecondary = [
        ['title' => 'Settings', 'icon' => 'settings'],
        ['title' => 'Help', 'icon' => 'circle-help'],
    ];

    $cards = [
        ['label' => 'Visitors', 'value' => '24,512', 'delta' => '+12.5%', 'up' => true, 'spark' => [12, 18, 15, 22, 19, 27, 24, 31]],
        ['label' => 'Page Views', 'value' => '89,240', 'delta' => '+8.2%', 'up' => true, 'spark' => [40, 38, 45, 42, 50, 48, 55, 60]],
        ['label' => 'Bounce Rate', 'value' => '42.3%', 'delta' => '-3.1%', 'up' => false, 'spark' => [60, 58, 55, 56, 50, 48, 45, 42]],
        ['label' => 'Avg. Session', 'value' => '3m 24s', 'delta' => '+5.0%', 'up' => true, 'spark' => [20, 22, 21, 25, 24, 28, 27, 30]],
    ];
@endphp

<x-layouts.app title="Dashboard 02 — Analytics">
    <x-ui.sidebar-provider style="--sidebar-width: calc(var(--spacing) * 68);">
        <x-ui.sidebar variant="inset">
            <x-ui.sidebar-header>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button size="lg" href="#">
                            <div class="bg-primary text-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                                <x-lucide-chart-pie class="size-4" />
                            </div>
                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">Acme Analytics</span>
                                <span class="truncate text-xs">Pro plan</span>
                            </div>
                        </x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group>
                    <x-ui.sidebar-group-label>Reports</x-ui.sidebar-group-label>
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
                <x-ui.sidebar-group class="mt-auto">
                    <x-ui.sidebar-menu>
                        @foreach ($navSecondary as $item)
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button href="#" size="sm">
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
        </x-ui.sidebar>

        <x-ui.sidebar-inset>
            <header class="flex h-16 shrink-0 items-center gap-2 border-b px-4 lg:px-6">
                <x-ui.sidebar-trigger class="-ml-1" />
                <x-ui.separator orientation="vertical" class="mr-2 data-[orientation=vertical]:h-4" />
                <h1 class="text-base font-medium">Overview</h1>
                <div class="ml-auto flex items-center gap-2">
                    <x-ui.button variant="outline" size="sm"><x-lucide-calendar /> Last 30 days</x-ui.button>
                    <x-ui.button size="sm"><x-lucide-download /> Export</x-ui.button>
                </div>
            </header>

            <div class="flex flex-1 flex-col gap-4 p-4 md:gap-6 md:p-6">
                {{-- Stat cards with sparklines --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($cards as $i => $c)
                        <x-ui.card class="@container/card overflow-hidden">
                            <x-ui.card-header class="pb-2">
                                <x-ui.card-description>{{ $c['label'] }}</x-ui.card-description>
                                <x-ui.card-title class="text-2xl font-semibold tabular-nums">{{ $c['value'] }}</x-ui.card-title>
                                <x-ui.card-action>
                                    <x-ui.badge variant="outline" class="{{ $c['up'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                                        <x-dynamic-component :component="$c['up'] ? 'lucide-trending-up' : 'lucide-trending-down'" />
                                        {{ $c['delta'] }}
                                    </x-ui.badge>
                                </x-ui.card-action>
                            </x-ui.card-header>
                            <x-ui.card-content class="px-0 pb-0">
                                <x-ui.chart type="area" :height="56"
                                    :series="[['name' => $c['label'], 'data' => $c['spark']]]"
                                    :colors="[$c['up'] ? 'var(--chart-2)' : 'var(--destructive)']"
                                    :options="[
                                        'chart' => ['sparkline' => ['enabled' => true]],
                                        'stroke' => ['width' => 2, 'curve' => 'smooth'],
                                        'fill' => ['type' => 'gradient', 'gradient' => ['opacityFrom' => 0.4, 'opacityTo' => 0.0, 'stops' => [0, 100]]],
                                        'tooltip' => ['enabled' => false],
                                    ]"
                                    class="aspect-auto h-[56px]" />
                            </x-ui.card-content>
                        </x-ui.card>
                    @endforeach
                </div>

                {{-- Traffic area chart --}}
                <x-ui.card>
                    <x-ui.card-header>
                        <x-ui.card-title>Traffic</x-ui.card-title>
                        <x-ui.card-description>Visitors vs. previous period</x-ui.card-description>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <x-ui.chart type="area" :height="300"
                            :config="['current' => ['label' => 'This period', 'color' => 'var(--chart-1)'], 'previous' => ['label' => 'Last period', 'color' => 'var(--chart-3)']]"
                            :series="[
                                ['name' => 'This period', 'data' => [820, 932, 901, 1234, 1290, 1330, 1520, 1400, 1680, 1520, 1780, 1920]],
                                ['name' => 'Last period', 'data' => [620, 700, 740, 820, 880, 910, 1010, 980, 1100, 1040, 1180, 1240]],
                            ]"
                            :colors="['var(--chart-1)', 'var(--chart-3)']"
                            :options="[
                                'xaxis' => ['categories' => ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']],
                                'fill' => ['type' => 'gradient', 'gradient' => ['opacityFrom' => 0.35, 'opacityTo' => 0.02, 'stops' => [0, 100]]],
                                'stroke' => ['width' => 2, 'curve' => 'smooth'],
                                'legend' => ['show' => true, 'position' => 'top', 'horizontalAlign' => 'right'],
                            ]"
                            class="aspect-auto h-[300px]" />
                    </x-ui.card-content>
                </x-ui.card>

                {{-- Sources + Top pages --}}
                <div class="grid grid-cols-1 gap-4 md:gap-6 lg:grid-cols-7">
                    <x-ui.card class="lg:col-span-3">
                        <x-ui.card-header>
                            <x-ui.card-title>Traffic Sources</x-ui.card-title>
                            <x-ui.card-description>Where your visitors come from</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content>
                            <x-ui.chart type="donut" :height="260"
                                :series="[58, 22, 12, 8]"
                                :labels="['Organic', 'Direct', 'Referral', 'Social']"
                                :colors="['var(--chart-1)', 'var(--chart-2)', 'var(--chart-3)', 'var(--chart-4)']"
                                :options="[
                                    'legend' => ['position' => 'bottom'],
                                    'stroke' => ['width' => 2, 'colors' => ['var(--card)']],
                                    'plotOptions' => ['pie' => ['donut' => ['size' => '68%']]],
                                    'dataLabels' => ['enabled' => false],
                                ]"
                                class="mx-auto aspect-square max-h-[260px]" />
                        </x-ui.card-content>
                    </x-ui.card>

                    <x-ui.card class="lg:col-span-4">
                        <x-ui.card-header>
                            <x-ui.card-title>Top Pages</x-ui.card-title>
                            <x-ui.card-description>Most visited this month</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content class="space-y-4">
                            @foreach ([['/', 18420, 100], ['/pricing', 12230, 66], ['/blog/blatui-v1', 9870, 53], ['/docs', 7640, 41], ['/changelog', 4120, 22]] as [$path, $views, $pct])
                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-medium">{{ $path }}</span>
                                        <span class="text-muted-foreground tabular-nums">{{ number_format($views) }}</span>
                                    </div>
                                    <x-ui.progress :value="$pct" class="h-2" />
                                </div>
                            @endforeach
                        </x-ui.card-content>
                    </x-ui.card>
                </div>
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
