@php
    $user = ['name' => 'shadcn', 'email' => 'm@example.com', 'avatar' => ''];

    $nav = [
        ['title' => 'Dashboard', 'icon' => 'layout-dashboard', 'active' => true],
        ['title' => 'Orders', 'icon' => 'shopping-cart', 'badge' => '12'],
        ['title' => 'Products', 'icon' => 'package'],
        ['title' => 'Customers', 'icon' => 'users'],
        ['title' => 'Analytics', 'icon' => 'chart-line'],
        ['title' => 'Discounts', 'icon' => 'ticket-percent'],
    ];

    $cards = [
        ['label' => 'Total Sales', 'value' => '$45,231.89', 'delta' => '+20.1%', 'up' => true, 'icon' => 'dollar-sign', 'sub' => 'vs. last month'],
        ['label' => 'Orders', 'value' => '1,234', 'delta' => '+15.3%', 'up' => true, 'icon' => 'shopping-bag', 'sub' => '320 this week'],
        ['label' => 'Customers', 'value' => '892', 'delta' => '+8.2%', 'up' => true, 'icon' => 'user-plus', 'sub' => '48 new'],
        ['label' => 'Avg. Order Value', 'value' => '$52.40', 'delta' => '-2.4%', 'up' => false, 'icon' => 'receipt', 'sub' => 'vs. last month'],
    ];

    $orders = [
        ['id' => '#3210', 'customer' => 'Olivia Martin', 'status' => 'Fulfilled', 'amount' => '$42.25'],
        ['id' => '#3209', 'customer' => 'Ava Johnson', 'status' => 'Processing', 'amount' => '$74.99'],
        ['id' => '#3208', 'customer' => 'Michael Lee', 'status' => 'Fulfilled', 'amount' => '$120.00'],
        ['id' => '#3207', 'customer' => 'Lisa Anderson', 'status' => 'Cancelled', 'amount' => '$32.50'],
        ['id' => '#3206', 'customer' => 'Samantha Green', 'status' => 'Fulfilled', 'amount' => '$88.10'],
    ];
    $statusStyles = ['Fulfilled' => 'border-transparent bg-emerald-500/15 text-emerald-700 dark:text-emerald-400', 'Processing' => 'border-transparent bg-amber-500/15 text-amber-700 dark:text-amber-400', 'Cancelled' => 'border-transparent bg-red-500/15 text-red-700 dark:text-red-400'];

    $products = [
        ['name' => 'Acme Hoodie', 'sales' => 1240, 'pct' => 100],
        ['name' => 'Wireless Buds', 'sales' => 980, 'pct' => 79],
        ['name' => 'Coffee Mug', 'sales' => 760, 'pct' => 61],
        ['name' => 'Sticker Pack', 'sales' => 540, 'pct' => 44],
        ['name' => 'Cap', 'sales' => 320, 'pct' => 26],
    ];
@endphp

<x-layouts.app title="Dashboard 03 — Sales">
    <x-ui.sidebar-provider style="--sidebar-width: calc(var(--spacing) * 68);">
        <x-ui.sidebar variant="floating">
            <x-ui.sidebar-header>
                <x-ui.sidebar-menu>
                    <x-ui.sidebar-menu-item>
                        <x-ui.sidebar-menu-button size="lg" href="#">
                            <div class="bg-primary text-primary-foreground flex aspect-square size-8 items-center justify-center rounded-lg">
                                <x-lucide-store class="size-4" />
                            </div>
                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">Storefront</span>
                                <span class="truncate text-xs">Acme Inc.</span>
                            </div>
                        </x-ui.sidebar-menu-button>
                    </x-ui.sidebar-menu-item>
                </x-ui.sidebar-menu>
            </x-ui.sidebar-header>
            <x-ui.sidebar-content>
                <x-ui.sidebar-group>
                    <x-ui.sidebar-menu>
                        @foreach ($nav as $item)
                            <x-ui.sidebar-menu-item>
                                <x-ui.sidebar-menu-button href="#" :is-active="$item['active'] ?? false">
                                    <x-dynamic-component :component="'lucide-'.$item['icon']" />
                                    <span>{{ $item['title'] }}</span>
                                </x-ui.sidebar-menu-button>
                                @isset($item['badge'])
                                    <x-ui.sidebar-menu-badge>{{ $item['badge'] }}</x-ui.sidebar-menu-badge>
                                @endisset
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
                <h1 class="text-base font-medium">Dashboard</h1>
                <div class="ml-auto flex items-center gap-2">
                    <x-ui.button variant="outline" size="sm"><x-lucide-calendar /> Jan 1 – Jan 31</x-ui.button>
                    <x-ui.button size="sm"><x-lucide-plus /> Add product</x-ui.button>
                </div>
            </header>

            <div class="flex flex-1 flex-col gap-4 p-4 md:gap-6 md:p-6">
                {{-- KPI cards --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($cards as $c)
                        <x-ui.card>
                            <x-ui.card-header>
                                <x-ui.card-description class="flex items-center gap-2">
                                    <x-dynamic-component :component="'lucide-'.$c['icon']" class="size-4" /> {{ $c['label'] }}
                                </x-ui.card-description>
                                <x-ui.card-title class="text-2xl font-semibold tabular-nums">{{ $c['value'] }}</x-ui.card-title>
                            </x-ui.card-header>
                            <x-ui.card-footer class="text-sm">
                                <span class="{{ $c['up'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }} inline-flex items-center gap-1 font-medium">
                                    <x-dynamic-component :component="$c['up'] ? 'lucide-trending-up' : 'lucide-trending-down'" class="size-3.5" /> {{ $c['delta'] }}
                                </span>
                                <span class="text-muted-foreground ml-2">{{ $c['sub'] }}</span>
                            </x-ui.card-footer>
                        </x-ui.card>
                    @endforeach
                </div>

                {{-- Revenue bar chart --}}
                <x-ui.card>
                    <x-ui.card-header>
                        <x-ui.card-title>Revenue</x-ui.card-title>
                        <x-ui.card-description>Monthly revenue, this year vs. last year</x-ui.card-description>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <x-ui.chart type="bar" :height="300"
                            :config="['current' => ['label' => 'This year', 'color' => 'var(--chart-1)'], 'previous' => ['label' => 'Last year', 'color' => 'var(--chart-2)']]"
                            :series="[
                                ['name' => 'This year', 'data' => [4200, 3800, 5100, 4700, 6200, 5800, 7100, 6800, 7600, 7200, 8400, 9100]],
                                ['name' => 'Last year', 'data' => [3100, 2900, 3600, 3400, 4200, 4000, 4800, 4600, 5100, 4900, 5600, 6000]],
                            ]"
                            :colors="['var(--chart-1)', 'var(--chart-2)']"
                            :options="[
                                'xaxis' => ['categories' => ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']],
                                'plotOptions' => ['bar' => ['borderRadius' => 4, 'columnWidth' => '55%']],
                                'yaxis' => ['show' => false],
                                'legend' => ['show' => true, 'position' => 'top', 'horizontalAlign' => 'right'],
                            ]"
                            class="aspect-auto h-[300px]" />
                    </x-ui.card-content>
                </x-ui.card>

                {{-- Orders + Top products --}}
                <div class="grid grid-cols-1 gap-4 md:gap-6 lg:grid-cols-7">
                    <x-ui.card class="lg:col-span-4">
                        <x-ui.card-header>
                            <x-ui.card-title>Recent Orders</x-ui.card-title>
                            <x-ui.card-description>Latest transactions across your store</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content>
                            <x-ui.table>
                                <x-ui.table-header>
                                    <x-ui.table-row>
                                        <x-ui.table-head>Order</x-ui.table-head>
                                        <x-ui.table-head>Customer</x-ui.table-head>
                                        <x-ui.table-head>Status</x-ui.table-head>
                                        <x-ui.table-head class="text-right">Amount</x-ui.table-head>
                                    </x-ui.table-row>
                                </x-ui.table-header>
                                <x-ui.table-body>
                                    @foreach ($orders as $o)
                                        <x-ui.table-row>
                                            <x-ui.table-cell class="font-medium">{{ $o['id'] }}</x-ui.table-cell>
                                            <x-ui.table-cell>{{ $o['customer'] }}</x-ui.table-cell>
                                            <x-ui.table-cell><x-ui.badge variant="outline" class="{{ $statusStyles[$o['status']] }}">{{ $o['status'] }}</x-ui.badge></x-ui.table-cell>
                                            <x-ui.table-cell class="text-right tabular-nums">{{ $o['amount'] }}</x-ui.table-cell>
                                        </x-ui.table-row>
                                    @endforeach
                                </x-ui.table-body>
                            </x-ui.table>
                        </x-ui.card-content>
                    </x-ui.card>

                    <x-ui.card class="lg:col-span-3">
                        <x-ui.card-header>
                            <x-ui.card-title>Top Products</x-ui.card-title>
                            <x-ui.card-description>Best sellers this month</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content class="space-y-4">
                            @foreach ($products as $p)
                                <div class="space-y-1.5">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-medium">{{ $p['name'] }}</span>
                                        <span class="text-muted-foreground tabular-nums">{{ number_format($p['sales']) }} sold</span>
                                    </div>
                                    <x-ui.progress :value="$p['pct']" class="h-2" />
                                </div>
                            @endforeach
                        </x-ui.card-content>
                    </x-ui.card>
                </div>
            </div>
        </x-ui.sidebar-inset>
    </x-ui.sidebar-provider>
</x-layouts.app>
