@php
    $categories = [
        ['icon' => 'rocket', 'title' => 'Getting started', 'desc' => 'Set up your account and ship your first project.', 'n' => 18],
        ['icon' => 'credit-card', 'title' => 'Account & billing', 'desc' => 'Plans, invoices, payment methods and refunds.', 'n' => 24],
        ['icon' => 'plug', 'title' => 'Integrations', 'desc' => 'Connect Slack, GitHub, Zapier and more.', 'n' => 31],
        ['icon' => 'shield', 'title' => 'Security & privacy', 'desc' => 'SSO, data handling and compliance.', 'n' => 12],
        ['icon' => 'wrench', 'title' => 'Troubleshooting', 'desc' => 'Fix common errors and known issues.', 'n' => 27],
        ['icon' => 'code', 'title' => 'API & developers', 'desc' => 'Authentication, webhooks and the SDK.', 'n' => 40],
    ];

    $popular = [
        'How do I reset my password?',
        'Upgrading or downgrading your plan',
        'Inviting teammates to your workspace',
        'Setting up single sign-on (SSO)',
        'Exporting your data',
    ];

    $faqs = [
        ['q' => 'How do I contact support?', 'a' => 'Start a live chat from the widget in the bottom-right of any page, or email support@helix.io. Pro and Business plans get priority response times.'],
        ['q' => 'Where can I see my invoices?', 'a' => 'Open Settings → Billing. Every invoice is downloadable as a PDF, and you can update your billing email there too.'],
        ['q' => 'Is there a status page?', 'a' => 'Yes — status.helix.io shows real-time uptime and incident history. Subscribe to get notified of any disruptions.'],
    ];
@endphp

<x-layouts.app title="Help Center — Helix">
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">
            <a href="#" class="flex items-center gap-2 font-semibold"><span class="bg-primary text-primary-foreground flex size-7 items-center justify-center rounded-lg"><x-lucide-life-buoy class="size-4" /></span> Helix Help</a>
            <nav class="ml-4 hidden items-center gap-1 text-sm md:flex">
                @foreach (['Help Center', 'Community', 'Status', 'Blog'] as $l)<a href="#" class="text-muted-foreground hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">{{ $l }}</a>@endforeach
            </nav>
            <div class="ml-auto flex items-center gap-1.5">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <x-ui.button size="sm" variant="outline">Sign in</x-ui.button>
            </div>
        </div>
    </header>

    {{-- Hero + search --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center"><div class="from-primary/20 h-80 w-[700px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div></div>
        <div class="mx-auto max-w-2xl px-6 py-20 text-center">
            <h1 class="text-4xl font-bold tracking-tight text-balance sm:text-5xl">How can we help?</h1>
            <p class="text-muted-foreground mt-3 text-lg">Search our knowledge base or browse the categories below.</p>
            <div class="mx-auto mt-7 max-w-xl">
                <x-ui.input type="search" placeholder="Search for articles, e.g. “reset password”…" class="h-12 text-base">
                    <x-slot:leading><x-lucide-search /></x-slot:leading>
                </x-ui.input>
            </div>
            <div class="text-muted-foreground mt-4 flex flex-wrap items-center justify-center gap-2 text-sm">
                <span>Popular:</span>
                @foreach (['Billing', 'SSO', 'API keys', 'Export data'] as $p)
                    <a href="#" class="bg-muted hover:bg-accent rounded-full px-3 py-1 transition-colors">{{ $p }}</a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-6xl px-6">
        {{-- Categories --}}
        <section class="py-16">
            <h2 class="mb-8 text-2xl font-bold tracking-tight">Browse by topic</h2>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $c)
                    <a href="#" class="group bg-card hover:border-ring/60 rounded-xl border p-6 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-md">
                        <div class="bg-primary/10 text-primary mb-4 inline-flex size-11 items-center justify-center rounded-lg"><x-dynamic-component :component="'lucide-'.$c['icon']" class="size-5" /></div>
                        <h3 class="group-hover:text-primary flex items-center gap-1.5 font-semibold transition-colors">{{ $c['title'] }} <x-lucide-arrow-right class="size-4 opacity-0 transition-opacity group-hover:opacity-100" /></h3>
                        <p class="text-muted-foreground mt-1.5 text-sm">{{ $c['desc'] }}</p>
                        <p class="text-muted-foreground mt-3 text-xs">{{ $c['n'] }} articles</p>
                    </a>
                @endforeach
            </div>
        </section>

        {{-- Popular + FAQ --}}
        <section class="grid gap-10 border-t py-16 lg:grid-cols-2">
            <div>
                <h2 class="mb-5 text-xl font-bold tracking-tight">Popular articles</h2>
                <ul class="divide-y rounded-xl border">
                    @foreach ($popular as $a)
                        <li><a href="#" class="hover:bg-accent/50 flex items-center justify-between gap-3 px-4 py-3.5 text-sm font-medium transition-colors"><span class="flex items-center gap-2.5"><x-lucide-file-text class="text-muted-foreground size-4" /> {{ $a }}</span> <x-lucide-chevron-right class="text-muted-foreground size-4" /></a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2 class="mb-5 text-xl font-bold tracking-tight">Frequently asked</h2>
                <x-ui.accordion type="single" collapsible class="w-full">
                    @foreach ($faqs as $i => $faq)
                        <x-ui.accordion-item value="faq-{{ $i }}"><x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger><x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content></x-ui.accordion-item>
                    @endforeach
                </x-ui.accordion>
            </div>
        </section>
    </div>

    {{-- Still need help --}}
    <section class="bg-muted/30 border-y py-16">
        <div class="mx-auto max-w-5xl px-6 text-center">
            <h2 class="text-2xl font-bold tracking-tight">Still need help?</h2>
            <p class="text-muted-foreground mt-2">Our team is here for you. Pick whatever's easiest.</p>
            <div class="mt-8 grid gap-5 sm:grid-cols-3">
                @foreach ([['message-circle', 'Live chat', 'Replies in ~2 min', 'Start chat'], ['mail', 'Email us', 'support@helix.io', 'Send email'], ['users', 'Community', '12k+ members', 'Visit forum']] as [$ic, $t, $d, $cta])
                    <x-ui.card class="flex flex-col items-center text-center">
                        <div class="bg-primary/10 text-primary mb-3 inline-flex size-12 items-center justify-center rounded-full"><x-dynamic-component :component="'lucide-'.$ic" class="size-5" /></div>
                        <h3 class="font-semibold">{{ $t }}</h3>
                        <p class="text-muted-foreground mt-1 text-sm">{{ $d }}</p>
                        <x-ui.button variant="outline" size="sm" class="mt-4">{{ $cta }}</x-ui.button>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="text-muted-foreground border-t py-8 text-center text-sm">© {{ date('Y') }} Helix. Built with BlatUI.</footer>
</x-layouts.app>
