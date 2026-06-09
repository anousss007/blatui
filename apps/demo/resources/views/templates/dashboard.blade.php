@php
    $kpis = [
        ['label' => 'Revenue', 'value' => '$84,254', 'delta' => '+12.5%', 'up' => true, 'spark' => '0,28 16,22 32,24 48,16 64,18 80,8 96,12 112,4'],
        ['label' => 'Orders', 'value' => '1,329', 'delta' => '+4.1%', 'up' => true, 'spark' => '0,20 16,24 32,18 48,20 64,12 80,16 96,10 112,8'],
        ['label' => 'Customers', 'value' => '3,872', 'delta' => '+8.2%', 'up' => true, 'spark' => '0,26 16,20 32,22 48,14 64,16 80,12 96,8 112,6'],
        ['label' => 'Conversion', 'value' => '3.6%', 'delta' => '-0.4%', 'up' => false, 'spark' => '0,8 16,12 32,10 48,16 64,14 80,20 96,18 112,24'],
    ];

    $traffic = [['Direct', 42], ['Organic search', 28], ['Referral', 18], ['Social', 12]];

    $orders = [
        ['id' => '#3201', 'name' => 'Olivia Martin', 'init' => 'OM', 'status' => 'Completed', 'tone' => 'success', 'date' => 'Jun 8', 'amount' => '$429.00'],
        ['id' => '#3200', 'name' => 'Jackson Lee', 'init' => 'JL', 'status' => 'Processing', 'tone' => 'info', 'date' => 'Jun 8', 'amount' => '$129.00'],
        ['id' => '#3199', 'name' => 'Isabella Nguyen', 'init' => 'IN', 'status' => 'Pending', 'tone' => 'warning', 'date' => 'Jun 7', 'amount' => '$89.00'],
        ['id' => '#3198', 'name' => 'William Kim', 'init' => 'WK', 'status' => 'Refunded', 'tone' => 'danger', 'date' => 'Jun 7', 'amount' => '$249.00'],
        ['id' => '#3197', 'name' => 'Sofia Davis', 'init' => 'SD', 'status' => 'Completed', 'tone' => 'success', 'date' => 'Jun 6', 'amount' => '$599.00'],
    ];
@endphp

<x-layouts.app title="Dashboard — Acme">
    <div class="flex min-h-screen">
        {{-- Sidebar (desktop) --}}
        <aside class="bg-card hidden w-64 shrink-0 flex-col border-r lg:flex">@include('templates.partials.dashboard-sidebar')</aside>

        <div class="flex min-w-0 flex-1 flex-col">
            {{-- Topbar --}}
            <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-30 flex h-16 items-center gap-3 border-b px-4 backdrop-blur-xl lg:px-6">
                <x-ui.sheet>
                    <x-ui.sheet-trigger class="lg:hidden">
                        <x-ui.button variant="outline" size="icon" aria-label="Menu"><x-lucide-menu class="size-4" /></x-ui.button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="left" class="w-64 p-0">
                        <div class="flex h-full flex-col">@include('templates.partials.dashboard-sidebar')</div>
                    </x-ui.sheet-content>
                </x-ui.sheet>

                <div class="relative hidden sm:block">
                    <x-ui.input type="search" placeholder="Search…" class="h-9 w-56 pe-12">
                        <x-slot:leading><x-lucide-search /></x-slot:leading>
                    </x-ui.input>
                    <x-ui.kbd class="absolute right-1.5 top-1/2 -translate-y-1/2">⌘K</x-ui.kbd>
                </div>

                <div class="ml-auto flex items-center gap-1.5">
                    <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                    <x-ui.dropdown-menu>
                        <x-ui.dropdown-menu-trigger>
                            <button class="hover:bg-accent relative inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Notifications"><x-lucide-bell class="size-4" /><span class="bg-destructive absolute right-2 top-2 size-2 rounded-full"></span></button>
                        </x-ui.dropdown-menu-trigger>
                        <x-ui.dropdown-menu-content align="end" class="w-72">
                            <x-ui.dropdown-menu-label>Notifications</x-ui.dropdown-menu-label>
                            <x-ui.dropdown-menu-separator />
                            @foreach (['New order #3201 from Olivia', 'Payout of $2,400 completed', 'Server load is back to normal'] as $n)
                                <x-ui.dropdown-menu-item class="whitespace-normal">{{ $n }}</x-ui.dropdown-menu-item>
                            @endforeach
                        </x-ui.dropdown-menu-content>
                    </x-ui.dropdown-menu>
                    <x-ui.dropdown-menu>
                        <x-ui.dropdown-menu-trigger>
                            <button aria-label="Account"><x-ui.avatar class="size-8"><x-ui.avatar-fallback>AD</x-ui.avatar-fallback></x-ui.avatar></button>
                        </x-ui.dropdown-menu-trigger>
                        <x-ui.dropdown-menu-content align="end" class="w-48">
                            <x-ui.dropdown-menu-label>My account</x-ui.dropdown-menu-label>
                            <x-ui.dropdown-menu-separator />
                            <x-ui.dropdown-menu-item>Profile</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-item>Billing</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-item>Settings</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-separator />
                            <x-ui.dropdown-menu-item>Log out</x-ui.dropdown-menu-item>
                        </x-ui.dropdown-menu-content>
                    </x-ui.dropdown-menu>
                </div>
            </header>

            {{-- Main --}}
            <main class="flex-1 space-y-6 p-4 lg:p-6">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
                        <p class="text-muted-foreground text-sm">Welcome back — here's what's happening today.</p>
                    </div>
                    <div class="flex gap-2">
                        <x-ui.button variant="outline" size="sm"><x-lucide-calendar class="size-4" /> Last 30 days</x-ui.button>
                        <x-ui.button size="sm"><x-lucide-download class="size-4" /> Export</x-ui.button>
                    </div>
                </div>

                {{-- KPIs --}}
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($kpis as $k)
                        <x-ui.card>
                            <div class="flex items-start justify-between">
                                <span class="text-muted-foreground text-sm">{{ $k['label'] }}</span>
                                <x-ui.badge :tone="$k['up'] ? 'success' : 'danger'" variant="soft" class="text-xs">{{ $k['delta'] }}</x-ui.badge>
                            </div>
                            <div class="mt-2 text-2xl font-bold tracking-tight">{{ $k['value'] }}</div>
                            <svg viewBox="0 0 112 32" class="mt-3 h-8 w-full {{ $k['up'] ? 'text-primary' : 'text-destructive' }}" fill="none" preserveAspectRatio="none" aria-hidden="true">
                                <polyline points="{{ $k['spark'] }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </x-ui.card>
                    @endforeach
                </div>

                {{-- Charts row --}}
                <div class="grid gap-4 lg:grid-cols-3">
                    <x-ui.card variant="sectioned" class="lg:col-span-2">
                        <x-ui.card-header>
                            <x-ui.card-title>Revenue</x-ui.card-title>
                            <x-ui.card-description>Daily revenue for the last 30 days</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content>
                            <svg viewBox="0 0 600 200" class="text-primary h-56 w-full" preserveAspectRatio="none" role="img" aria-label="Revenue chart">
                                <defs><linearGradient id="rev" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="currentColor" stop-opacity="0.25" /><stop offset="100%" stop-color="currentColor" stop-opacity="0" /></linearGradient></defs>
                                <path d="M0,160 C40,150 70,120 110,125 C150,130 180,90 220,95 C260,100 290,60 330,70 C370,80 400,45 440,40 C480,35 520,55 560,30 L600,25 L600,200 L0,200 Z" fill="url(#rev)" />
                                <path d="M0,160 C40,150 70,120 110,125 C150,130 180,90 220,95 C260,100 290,60 330,70 C370,80 400,45 440,40 C480,35 520,55 560,30 L600,25" fill="none" stroke="currentColor" stroke-width="2.5" />
                            </svg>
                        </x-ui.card-content>
                    </x-ui.card>

                    <x-ui.card variant="sectioned">
                        <x-ui.card-header>
                            <x-ui.card-title>Traffic sources</x-ui.card-title>
                            <x-ui.card-description>Where visitors come from</x-ui.card-description>
                        </x-ui.card-header>
                        <x-ui.card-content class="space-y-4">
                            @foreach ($traffic as [$label, $pct])
                                <div>
                                    <div class="mb-1.5 flex items-center justify-between text-sm">
                                        <span class="font-medium">{{ $label }}</span>
                                        <span class="text-muted-foreground">{{ $pct }}%</span>
                                    </div>
                                    <x-ui.progress :value="$pct" class="h-2" />
                                </div>
                            @endforeach
                        </x-ui.card-content>
                    </x-ui.card>
                </div>

                {{-- Recent orders --}}
                <x-ui.card variant="sectioned">
                    <x-ui.card-header class="flex-row items-center justify-between">
                        <div>
                            <x-ui.card-title>Recent orders</x-ui.card-title>
                            <x-ui.card-description>Your latest 5 orders</x-ui.card-description>
                        </div>
                        <x-ui.button variant="outline" size="sm">View all</x-ui.button>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <x-ui.table>
                            <x-ui.table-header>
                                <x-ui.table-row>
                                    <x-ui.table-head>Order</x-ui.table-head>
                                    <x-ui.table-head>Customer</x-ui.table-head>
                                    <x-ui.table-head>Status</x-ui.table-head>
                                    <x-ui.table-head class="hidden sm:table-cell">Date</x-ui.table-head>
                                    <x-ui.table-head class="text-right">Amount</x-ui.table-head>
                                    <x-ui.table-head class="w-10"></x-ui.table-head>
                                </x-ui.table-row>
                            </x-ui.table-header>
                            <x-ui.table-body>
                                @foreach ($orders as $o)
                                    <x-ui.table-row>
                                        <x-ui.table-cell class="font-medium">{{ $o['id'] }}</x-ui.table-cell>
                                        <x-ui.table-cell>
                                            <div class="flex items-center gap-2">
                                                <x-ui.avatar class="size-7"><x-ui.avatar-fallback class="text-xs">{{ $o['init'] }}</x-ui.avatar-fallback></x-ui.avatar>
                                                <span class="whitespace-nowrap">{{ $o['name'] }}</span>
                                            </div>
                                        </x-ui.table-cell>
                                        <x-ui.table-cell><x-ui.badge :tone="$o['tone']" variant="soft">{{ $o['status'] }}</x-ui.badge></x-ui.table-cell>
                                        <x-ui.table-cell class="text-muted-foreground hidden sm:table-cell">{{ $o['date'] }}</x-ui.table-cell>
                                        <x-ui.table-cell class="text-right font-medium">{{ $o['amount'] }}</x-ui.table-cell>
                                        <x-ui.table-cell>
                                            <x-ui.dropdown-menu>
                                                <x-ui.dropdown-menu-trigger>
                                                    <button class="hover:bg-accent inline-flex size-8 items-center justify-center rounded-md" aria-label="Actions"><x-lucide-ellipsis class="size-4" /></button>
                                                </x-ui.dropdown-menu-trigger>
                                                <x-ui.dropdown-menu-content align="end">
                                                    <x-ui.dropdown-menu-item>View order</x-ui.dropdown-menu-item>
                                                    <x-ui.dropdown-menu-item>Customer</x-ui.dropdown-menu-item>
                                                    <x-ui.dropdown-menu-separator />
                                                    <x-ui.dropdown-menu-item>Refund</x-ui.dropdown-menu-item>
                                                </x-ui.dropdown-menu-content>
                                            </x-ui.dropdown-menu>
                                        </x-ui.table-cell>
                                    </x-ui.table-row>
                                @endforeach
                            </x-ui.table-body>
                        </x-ui.table>
                    </x-ui.card-content>
                </x-ui.card>
            </main>
        </div>
    </div>
</x-layouts.app>
