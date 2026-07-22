@php
    $stats = [['Open pipeline', '$412k'], ['Weighted', '$168k'], ['Win rate', '32%'], ['Avg. deal', '$8.4k']];

    $stages = [
        ['name' => 'Lead', 'tone' => 'neutral', 'deals' => [
            ['co' => 'Northwind', 'title' => 'Annual plan — 40 seats', 'value' => '$24k', 'tag' => 'Inbound', 'tone' => 'info', 'who' => 'MQ'],
            ['co' => 'Globex', 'title' => 'Pilot expansion', 'value' => '$9k', 'tag' => 'New', 'tone' => 'primary', 'who' => 'LF'],
            ['co' => 'Soylent', 'title' => 'Starter → Pro', 'value' => '$4k', 'tag' => 'Inbound', 'tone' => 'info', 'who' => 'IP'],
        ]],
        ['name' => 'Contacted', 'tone' => 'info', 'deals' => [
            ['co' => 'Initech', 'title' => 'Team plan rollout', 'value' => '$18k', 'tag' => 'Warm', 'tone' => 'warning', 'who' => 'TV'],
            ['co' => 'Umbrella', 'title' => 'Security add-on', 'value' => '$31k', 'tag' => 'Enterprise', 'tone' => 'primary', 'who' => 'MQ'],
        ]],
        ['name' => 'Proposal', 'tone' => 'warning', 'deals' => [
            ['co' => 'Stark Industries', 'title' => 'Platform license', 'value' => '$96k', 'tag' => 'Enterprise', 'tone' => 'primary', 'who' => 'LF'],
            ['co' => 'Hooli', 'title' => 'Annual renewal', 'value' => '$42k', 'tag' => 'Renewal', 'tone' => 'success', 'who' => 'IP'],
        ]],
        ['name' => 'Negotiation', 'tone' => 'primary', 'deals' => [
            ['co' => 'Wayne Ent.', 'title' => 'Multi-year deal', 'value' => '$120k', 'tag' => 'Hot', 'tone' => 'danger', 'who' => 'TV'],
        ]],
        ['name' => 'Won', 'tone' => 'success', 'deals' => [
            ['co' => 'Acme', 'title' => 'Business plan', 'value' => '$28k', 'tag' => 'Closed', 'tone' => 'success', 'who' => 'MQ'],
            ['co' => 'Cyberdyne', 'title' => 'Pro — 25 seats', 'value' => '$15k', 'tag' => 'Closed', 'tone' => 'success', 'who' => 'LF'],
        ]],
    ];
@endphp

<x-layouts.app title="Pipeline — Forge CRM">
    <div class="flex min-h-screen flex-col">
        {{-- App bar --}}
        <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-30 flex h-16 items-center gap-3 border-b px-4 backdrop-blur-xl lg:px-6">
            <a href="#" class="flex items-center gap-2 font-semibold"><span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-target class="size-5" /></span> Forge</a>
            <nav class="ml-3 hidden items-center gap-1 text-sm md:flex">
                @foreach (['Deals', 'Contacts', 'Companies', 'Reports'] as $i)<a href="#" @class(['rounded-md px-3 py-1.5 font-medium transition-colors', 'bg-accent text-accent-foreground' => $loop->first, 'text-muted-foreground hover:text-foreground hover:bg-accent/60' => ! $loop->first])>{{ $i }}</a>@endforeach
            </nav>
            <div class="ml-auto flex items-center gap-1.5">
                <div class="relative hidden sm:block">
                    <x-ui.input type="search" placeholder="Search deals…" class="h-9 w-48">
                        <x-slot:leading><x-lucide-search /></x-slot:leading>
                    </x-ui.input>
                </div>
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <x-ui.avatar class="size-8"><x-ui.avatar-fallback>AD</x-ui.avatar-fallback></x-ui.avatar>
            </div>
        </header>

        {{-- Toolbar --}}
        <div class="border-b px-4 py-4 lg:px-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Deals</h1>
                    <div class="mt-2 flex flex-wrap gap-x-6 gap-y-1 text-sm">
                        @foreach ($stats as [$l, $v])
                            <div><span class="text-muted-foreground">{{ $l }}:</span> <span class="font-semibold">{{ $v }}</span></div>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="flex -space-x-2">
                        @foreach (['MQ', 'LF', 'IP', 'TV'] as $i)<x-ui.avatar class="ring-background size-7 ring-2"><x-ui.avatar-fallback class="text-[10px]">{{ $i }}</x-ui.avatar-fallback></x-ui.avatar>@endforeach
                    </div>
                    <x-ui.button variant="outline" size="sm"><x-lucide-list-filter class="size-4" /> Filter</x-ui.button>
                    <x-ui.dropdown-menu>
                        <x-ui.dropdown-menu-trigger><x-ui.button variant="outline" size="sm"><x-lucide-arrow-up-down class="size-4" /> Sort</x-ui.button></x-ui.dropdown-menu-trigger>
                        <x-ui.dropdown-menu-content align="end" class="w-44">
                            @foreach (['Value: High to Low', 'Value: Low to High', 'Recently updated', 'Closing soon'] as $o)<x-ui.dropdown-menu-item>{{ $o }}</x-ui.dropdown-menu-item>@endforeach
                        </x-ui.dropdown-menu-content>
                    </x-ui.dropdown-menu>
                    <x-ui.button size="sm"><x-lucide-plus class="size-4" /> New deal</x-ui.button>
                </div>
            </div>
        </div>

        {{-- Board --}}
        <div class="flex-1 overflow-x-auto p-4 lg:p-6">
            <div class="flex min-w-max gap-4">
                @foreach ($stages as $stage)
                    @php $total = collect($stage['deals'])->sum(fn ($d) => (int) str_replace(['$', 'k'], '', $d['value'])); @endphp
                    <div class="w-72 shrink-0">
                        <div class="mb-3 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <x-ui.badge :tone="$stage['tone']" variant="soft">{{ $stage['name'] }}</x-ui.badge>
                                <span class="text-muted-foreground text-sm">{{ count($stage['deals']) }}</span>
                            </div>
                            <span class="text-muted-foreground text-xs font-medium">${{ $total }}k</span>
                        </div>
                        <div class="space-y-3">
                            @foreach ($stage['deals'] as $d)
                                <div class="bg-card hover:border-ring/60 group cursor-pointer rounded-xl border p-4 shadow-sm transition-all hover:shadow-md">
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="text-sm font-semibold">{{ $d['co'] }}</div>
                                        <button class="text-muted-foreground hover:text-foreground opacity-0 transition group-hover:opacity-100" aria-label="Deal actions"><x-lucide-ellipsis class="size-4" /></button>
                                    </div>
                                    <p class="text-muted-foreground mt-0.5 text-sm">{{ $d['title'] }}</p>
                                    <div class="mt-3 flex items-center justify-between">
                                        <span class="font-semibold">{{ $d['value'] }}</span>
                                        <x-ui.badge :tone="$d['tone']" variant="soft" class="text-xs">{{ $d['tag'] }}</x-ui.badge>
                                    </div>
                                    <div class="mt-3 flex items-center justify-between border-t pt-3">
                                        <x-ui.avatar class="size-6"><x-ui.avatar-fallback class="text-[10px]">{{ $d['who'] }}</x-ui.avatar-fallback></x-ui.avatar>
                                        <span class="text-muted-foreground inline-flex items-center gap-1 text-xs"><x-lucide-calendar class="size-3" /> Jun 14</span>
                                    </div>
                                </div>
                            @endforeach
                            <button class="text-muted-foreground hover:text-foreground hover:border-ring flex w-full items-center justify-center gap-1.5 rounded-xl border border-dashed py-2.5 text-sm transition-colors"><x-lucide-plus class="size-4" /> Add deal</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
