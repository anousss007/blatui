<x-layouts.app title="Marketing 01">
    <div class="flex min-h-svh flex-col">
        {{-- Nav --}}
        <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
            <div class="mx-auto flex h-16 max-w-6xl items-center gap-6 px-6 lg:px-8">
                <a href="#" class="flex items-center gap-2 font-semibold tracking-tight">
                    <span class="bg-primary text-primary-foreground flex size-7 items-center justify-center rounded-md">
                        <x-lucide-hexagon class="size-4" />
                    </span>
                    Acme
                </a>
                <nav class="text-muted-foreground ml-2 hidden items-center gap-1 text-sm md:flex">
                    <a href="#features" class="hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">Features</a>
                    <a href="#testimonial" class="hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">Customers</a>
                    <a href="#cta" class="hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">Pricing</a>
                </nav>
                <div class="ml-auto flex items-center gap-2">
                    <x-ui.button variant="ghost" size="sm" href="#">Sign in</x-ui.button>
                    <x-ui.button size="sm" href="#cta">Get started</x-ui.button>
                </div>
            </div>
        </header>

        <main class="flex-1">
            {{-- Hero --}}
            <section class="relative overflow-hidden">
                <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 flex justify-center">
                    <div class="from-primary/25 h-96 w-[820px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
                </div>
                <div class="mx-auto max-w-3xl px-6 py-24 text-center lg:py-32">
                    <a href="#" class="bg-muted hover:bg-accent mb-6 inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-medium transition-colors">
                        <x-ui.badge class="rounded-full">New</x-ui.badge>
                        Introducing v2.0 — now with realtime
                        <x-lucide-arrow-right class="size-3.5" />
                    </a>
                    <h1 class="text-4xl font-bold tracking-tight text-balance sm:text-5xl md:text-6xl">
                        Ship your product at the speed of thought
                    </h1>
                    <p class="text-muted-foreground mx-auto mt-6 max-w-2xl text-lg text-pretty">
                        The all-in-one platform to build, launch and scale modern apps. Beautiful by default,
                        accessible everywhere, and yours to own.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                        <x-ui.button size="lg" href="#cta">Start for free <x-lucide-arrow-right class="size-4" /></x-ui.button>
                        <x-ui.button size="lg" variant="outline" href="#">
                            <x-lucide-circle-play class="size-4" /> Watch demo
                        </x-ui.button>
                    </div>
                    <p class="text-muted-foreground mt-4 text-xs">No credit card required · Free 14-day trial</p>
                </div>

                {{-- Logo cloud --}}
                <div class="mx-auto max-w-5xl px-6 pb-16 lg:px-8">
                    <p class="text-muted-foreground mb-6 text-center text-xs font-medium tracking-wide uppercase">Trusted by teams at</p>
                    <div class="text-muted-foreground/70 grid grid-cols-2 items-center justify-items-center gap-8 sm:grid-cols-3 md:grid-cols-5">
                        @foreach (['Vercel', 'Linear', 'Raycast', 'Supabase', 'Stripe'] as $logo)
                            <span class="text-lg font-semibold tracking-tight">{{ $logo }}</span>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Features --}}
            <section id="features" class="border-t py-24">
                <div class="mx-auto max-w-6xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <x-ui.badge variant="secondary">Features</x-ui.badge>
                        <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">Everything you need, nothing you don't</h2>
                        <p class="text-muted-foreground mt-4 text-lg">A thoughtful set of primitives that scale from prototype to production.</p>
                    </div>
                    <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @php
                            $features = [
                                ['zap', 'Blazing fast', 'Sub-second cold starts and edge-rendered everywhere your users are.'],
                                ['shield-check', 'Secure by default', 'WCAG AA, hardened auth and sensible defaults out of the box.'],
                                ['palette', 'Fully themeable', 'Every token is a CSS variable. Recolor your whole app in seconds.'],
                                ['code', 'You own the code', 'No black-box dependency — components are copied into your project.'],
                                ['layers', 'Composable', 'Small, predictable pieces that snap together however you need.'],
                                ['sparkles', 'Delightful UX', 'Keyboard navigation, focus management and motion, considered.'],
                            ];
                        @endphp
                        @foreach ($features as [$icon, $title, $desc])
                            <x-ui.card class="h-full">
                                <x-ui.card-header>
                                    <span class="bg-primary/10 text-primary flex size-10 items-center justify-center rounded-lg">
                                        <x-dynamic-component :component="'lucide-'.$icon" class="size-5" />
                                    </span>
                                    <x-ui.card-title class="mt-3">{{ $title }}</x-ui.card-title>
                                    <x-ui.card-description>{{ $desc }}</x-ui.card-description>
                                </x-ui.card-header>
                            </x-ui.card>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Stats --}}
            <section class="border-t py-20">
                <div class="mx-auto grid max-w-5xl grid-cols-2 gap-8 px-6 text-center md:grid-cols-4 lg:px-8">
                    @foreach ([['99.99%', 'Uptime'], ['12ms', 'p50 latency'], ['180+', 'Edge regions'], ['4.9/5', 'Avg rating']] as [$stat, $label])
                        <div>
                            <div class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $stat }}</div>
                            <div class="text-muted-foreground mt-1 text-sm">{{ $label }}</div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Testimonial --}}
            <section id="testimonial" class="border-t py-24">
                <div class="mx-auto max-w-3xl px-6 text-center lg:px-8">
                    <div class="text-primary mb-5 flex items-center justify-center gap-1">
                        @for ($i = 0; $i < 5; $i++)
                            <x-lucide-star class="size-5 fill-current" />
                        @endfor
                    </div>
                    <blockquote class="text-2xl font-medium tracking-tight text-balance sm:text-3xl">
                        “We replaced three tools and shipped our redesign in a weekend. The team has never moved faster.”
                    </blockquote>
                    <div class="mt-8 flex items-center justify-center gap-3">
                        <x-ui.avatar>
                            <x-ui.avatar-image src="https://github.com/shadcn.png" alt="Avery Stone" />
                            <x-ui.avatar-fallback>AS</x-ui.avatar-fallback>
                        </x-ui.avatar>
                        <div class="text-left">
                            <div class="text-sm font-semibold">Avery Stone</div>
                            <div class="text-muted-foreground text-sm">VP Engineering, Northwind</div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- CTA --}}
            <section id="cta" class="border-t py-24">
                <div class="mx-auto max-w-5xl px-6 lg:px-8">
                    <div class="bg-primary text-primary-foreground relative overflow-hidden rounded-2xl px-8 py-16 text-center shadow-sm">
                        <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">Ready to build something great?</h2>
                        <p class="text-primary-foreground/80 mx-auto mt-4 max-w-xl text-lg">Start free today. Upgrade when you're ready — no lock-in, ever.</p>
                        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                            <x-ui.button size="lg" variant="secondary" href="#">Get started free</x-ui.button>
                            <x-ui.button size="lg" variant="outline" href="#" class="border-primary-foreground/30 bg-transparent text-primary-foreground hover:bg-primary-foreground/10 hover:text-primary-foreground">
                                Talk to sales
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="border-t py-12">
            <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-6 sm:flex-row lg:px-8">
                <div class="flex items-center gap-2 text-sm font-semibold">
                    <span class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded">
                        <x-lucide-hexagon class="size-3.5" />
                    </span>
                    Acme
                </div>
                <p class="text-muted-foreground text-sm">© {{ date('Y') }} Acme Inc. All rights reserved.</p>
                <div class="text-muted-foreground flex items-center gap-4">
                    <a href="#" class="hover:text-foreground transition-colors"><x-lucide-github class="size-5" /></a>
                    <a href="#" class="hover:text-foreground transition-colors"><x-lucide-twitter class="size-5" /></a>
                    <a href="#" class="hover:text-foreground transition-colors"><x-lucide-linkedin class="size-5" /></a>
                </div>
            </div>
        </footer>
    </div>
</x-layouts.app>
