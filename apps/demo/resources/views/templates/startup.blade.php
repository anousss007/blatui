@php
    $features = [
        ['icon' => 'zap', 'title' => 'Lightning fast', 'desc' => 'Built on the edge so it feels instant, everywhere.'],
        ['icon' => 'lock', 'title' => 'Private by default', 'desc' => 'Your data is encrypted and never sold. Ever.'],
        ['icon' => 'sparkles', 'title' => 'Delightfully simple', 'desc' => 'No manual needed. You\'ll know what to do.'],
    ];
@endphp

<x-layouts.app title="Orbit — Coming soon">
    <div class="relative flex min-h-screen flex-col overflow-hidden">
        <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 flex justify-center"><div class="from-primary/25 h-[30rem] w-[60rem] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div></div>

        {{-- Nav --}}
        <header class="mx-auto flex w-full max-w-5xl items-center px-6 py-6">
            <a href="#" class="flex items-center gap-2 font-semibold tracking-tight"><span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-orbit class="size-5" /></span> Orbit</a>
            <div class="ml-auto flex items-center gap-1.5">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                @foreach (['twitter', 'github'] as $s)<a href="#" aria-label="{{ $s }}" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors"><x-dynamic-component :component="'lucide-'.$s" class="size-4" /></a>@endforeach
            </div>
        </header>

        {{-- Hero --}}
        <main class="mx-auto flex w-full max-w-2xl flex-1 flex-col items-center justify-center px-6 py-16 text-center">
            <x-ui.badge tone="primary" variant="soft" class="mb-6 gap-1.5"><span class="bg-primary size-1.5 animate-pulse rounded-full"></span> Launching September 2026</x-ui.badge>
            <h1 class="text-5xl font-bold tracking-tight text-balance sm:text-6xl">The calmer way to run your day.</h1>
            <p class="text-muted-foreground mt-5 max-w-lg text-lg text-balance">Orbit brings your tasks, notes and calendar into one quiet place. Be the first to try it.</p>

            {{-- Countdown --}}
            <div class="mt-9 flex gap-3" x-data="{ d:0,h:0,m:0,s:0, init(){ this.tick(); setInterval(() => this.tick(), 1000); }, tick(){ const diff = Math.max(0, new Date('2026-09-01T00:00:00').getTime() - Date.now()); this.d = Math.floor(diff/86400000); this.h = Math.floor(diff/3600000)%24; this.m = Math.floor(diff/60000)%60; this.s = Math.floor(diff/1000)%60; } }">
                @foreach (['d' => 'Days', 'h' => 'Hours', 'm' => 'Mins', 's' => 'Secs'] as $k => $lbl)
                    <div class="bg-card w-18 rounded-xl border px-4 py-3 shadow-sm">
                        <div class="text-3xl font-bold tabular-nums" x-text="String({{ $k }}).padStart(2,'0')">00</div>
                        <div class="text-muted-foreground text-xs">{{ $lbl }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Waitlist --}}
            <form class="mt-9 flex w-full max-w-md flex-col gap-2 sm:flex-row" x-data="{ done: false }" @submit.prevent="done = true">
                <x-ui.input type="email" placeholder="you@example.com" class="h-11 flex-1" aria-label="Email" required>
                    <x-slot:leading><x-lucide-mail /></x-slot:leading>
                </x-ui.input>
                <x-ui.button type="submit" size="lg" x-show="!done">Join the waitlist <x-lucide-arrow-right class="size-4" /></x-ui.button>
                <x-ui.button type="button" size="lg" variant="outline" x-show="done" x-cloak class="text-emerald-600"><x-lucide-check class="size-4" /> You're on the list!</x-ui.button>
            </form>

            <div class="mt-6 flex items-center gap-3">
                <div class="flex -space-x-2">
                    @foreach (['AK', 'MR', 'JL', 'SD', 'TV'] as $i)<x-ui.avatar class="ring-background size-8 ring-2"><x-ui.avatar-fallback class="text-[10px]">{{ $i }}</x-ui.avatar-fallback></x-ui.avatar>@endforeach
                </div>
                <span class="text-muted-foreground text-sm"><span class="text-foreground font-medium">2,400+</span> people waiting</span>
            </div>
        </main>

        {{-- Feature teaser --}}
        <section class="border-t py-14">
            <div class="mx-auto grid max-w-4xl gap-8 px-6 sm:grid-cols-3">
                @foreach ($features as $f)
                    <div class="text-center sm:text-left">
                        <div class="bg-primary/10 text-primary mx-auto mb-3 inline-flex size-10 items-center justify-center rounded-lg sm:mx-0"><x-dynamic-component :component="'lucide-'.$f['icon']" class="size-5" /></div>
                        <h3 class="font-semibold">{{ $f['title'] }}</h3>
                        <p class="text-muted-foreground mt-1 text-sm text-balance">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <footer class="text-muted-foreground border-t py-6 text-center text-sm">© {{ date('Y') }} Orbit. Built with BlatUI.</footer>
    </div>
</x-layouts.app>
