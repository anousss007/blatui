@php
    $img = fn ($id, $w = 800) => "https://images.unsplash.com/photo-{$id}?w={$w}&q=80&auto=format&fit=crop";
    $nav = ['Work', 'Services', 'Studio', 'Journal'];

    $services = [
        ['icon' => 'palette', 'title' => 'Brand identity', 'desc' => 'Naming, logo systems, type and the guidelines to keep it all consistent.'],
        ['icon' => 'monitor', 'title' => 'Web & product', 'desc' => 'Sites and apps designed and built to convert — fast, accessible, on-brand.'],
        ['icon' => 'clapperboard', 'title' => 'Motion', 'desc' => 'Launch films, product demos and the micro-interactions that bring UI to life.'],
        ['icon' => 'compass', 'title' => 'Strategy', 'desc' => 'Positioning, messaging and research that points the creative in the right direction.'],
    ];

    $work = ['1618005182384-a83a8bd57fbe', '1561070791-2526d30994b5', '1558655146-9f40138edfeb', '1545235617-9465d2a55698', '1620641788421-7a1c342ea42e', '1559028012-481c04fa702d'];

    $team = [
        ['n' => 'Mara Quinn', 'r' => 'Creative Director', 'i' => 'MQ'],
        ['n' => 'Leo Fontaine', 'r' => 'Design Lead', 'i' => 'LF'],
        ['n' => 'Ines Park', 'r' => 'Motion Designer', 'i' => 'IP'],
        ['n' => 'Theo Vance', 'r' => 'Engineer', 'i' => 'TV'],
    ];
@endphp

<x-layouts.app title="Studio Form — A design & motion studio">
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">
            <a href="#" class="flex items-center gap-2 font-semibold tracking-tight"><span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-asterisk class="size-5" /></span> Studio&nbsp;Form</a>
            <nav class="ml-4 hidden items-center gap-1 text-sm md:flex">
                @foreach ($nav as $label)<a href="#" class="text-muted-foreground hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">{{ $label }}</a>@endforeach
            </nav>
            <div class="ml-auto flex items-center gap-1.5">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <x-ui.button size="sm" href="#contact">Start a project</x-ui.button>
            </div>
        </div>
    </header>

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 flex justify-center"><div class="from-primary/20 h-[26rem] w-[56rem] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div></div>
        <div class="mx-auto max-w-6xl px-6 py-24 lg:py-32">
            <x-ui.badge variant="outline" class="mb-6">Design &amp; motion studio · since 2014</x-ui.badge>
            <h1 class="max-w-4xl text-5xl font-bold tracking-tight text-balance sm:text-6xl lg:text-7xl">We craft brands that <span class="text-primary">move</span>.</h1>
            <p class="text-muted-foreground mt-6 max-w-xl text-lg text-balance">A small studio of designers, animators and engineers helping ambitious teams look and feel unmistakable.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <x-ui.button size="lg" href="#work">See our work <x-lucide-arrow-right class="size-4" /></x-ui.button>
                <x-ui.button size="lg" variant="outline" href="#contact">Start a project</x-ui.button>
            </div>
        </div>
        <x-ui.marquee :duration="'28s'" class="border-t py-5">
            @foreach (['Branding', 'Web Design', 'Motion', 'Art Direction', 'Strategy', 'Identity', 'Product', '3D'] as $w)
                <span class="text-muted-foreground/60 px-4 text-2xl font-semibold whitespace-nowrap">{{ $w }} <span class="text-primary">✳</span></span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- Services --}}
    <section id="services" class="scroll-mt-20 py-20 lg:py-28">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 max-w-2xl">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">What we do</h2>
                <p class="text-muted-foreground mt-3 text-lg">Four disciplines, one team — so the strategy, design and build never get lost in translation.</p>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $s)
                    <x-ui.card class="transition-shadow hover:shadow-md">
                        <div class="bg-primary/10 text-primary mb-4 inline-flex size-11 items-center justify-center rounded-lg"><x-dynamic-component :component="'lucide-'.$s['icon']" class="size-5" /></div>
                        <h3 class="font-semibold">{{ $s['title'] }}</h3>
                        <p class="text-muted-foreground mt-1.5 text-sm">{{ $s['desc'] }}</p>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Work (gallery + lightbox) --}}
    <section id="work" class="bg-muted/30 scroll-mt-20 border-y py-20 lg:py-28">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-10 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Selected work</h2>
                    <p class="text-muted-foreground mt-2">Tap any project to open the case study.</p>
                </div>
                <x-ui.button variant="outline">All projects <x-lucide-arrow-right class="size-4" /></x-ui.button>
            </div>
            <x-ui.gallery :columns="3" rounded="rounded-2xl" :images="collect($work)->map(fn ($id) => ['src' => $img($id, 1400), 'thumb' => $img($id, 700), 'alt' => 'Project'])->all()" />
        </div>
    </section>

    {{-- Stats --}}
    <section class="py-16">
        <div class="mx-auto grid max-w-4xl grid-cols-2 gap-8 px-6 text-center lg:grid-cols-4">
            @foreach ([['120+', 'Projects shipped'], ['18', 'Design awards'], ['40+', 'Happy clients'], ['12yrs', 'In business']] as [$v, $l])
                <div><div class="text-4xl font-bold tracking-tight">{{ $v }}</div><div class="text-muted-foreground mt-1 text-sm">{{ $l }}</div></div>
            @endforeach
        </div>
    </section>

    {{-- Team --}}
    <section class="bg-muted/30 border-y py-20 lg:py-28">
        <div class="mx-auto max-w-6xl px-6">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">The studio</h2>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($team as $m)
                    <div class="text-center">
                        <x-ui.avatar class="mx-auto size-24"><x-ui.avatar-fallback class="text-xl">{{ $m['i'] }}</x-ui.avatar-fallback></x-ui.avatar>
                        <div class="mt-3 font-semibold">{{ $m['n'] }}</div>
                        <div class="text-muted-foreground text-sm">{{ $m['r'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonial --}}
    <section class="py-20 lg:py-28">
        <div class="mx-auto max-w-3xl px-6 text-center">
            <x-lucide-quote class="text-muted-foreground/30 mx-auto mb-4 size-10" />
            <blockquote class="text-2xl font-medium leading-snug text-balance sm:text-3xl">Studio Form rebranded us in six weeks and our demo requests doubled. They get strategy and craft in equal measure.</blockquote>
            <div class="mt-6 flex items-center justify-center gap-3">
                <x-ui.avatar class="size-11"><x-ui.avatar-fallback>RC</x-ui.avatar-fallback></x-ui.avatar>
                <div class="text-left text-sm"><div class="font-semibold">Renata Cruz</div><div class="text-muted-foreground">CMO, Northwind</div></div>
            </div>
        </div>
    </section>

    {{-- Contact CTA --}}
    <section id="contact" class="scroll-mt-20 pb-24">
        <div class="mx-auto max-w-5xl px-6">
            <div class="from-primary to-primary/80 text-primary-foreground overflow-hidden rounded-3xl bg-gradient-to-br p-10 lg:p-16">
                <div class="grid items-center gap-8 lg:grid-cols-2">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">Have a project in mind?</h2>
                        <p class="text-primary-foreground/80 mt-3 text-balance">Tell us what you're building. We reply within two business days.</p>
                    </div>
                    <form class="grid gap-3">
                        <div class="grid gap-3 sm:grid-cols-2">
                            <input class="blat-input bg-white/10 border-white/20 text-primary-foreground placeholder:text-primary-foreground/60" placeholder="Your name" aria-label="Name" />
                            <input class="blat-input bg-white/10 border-white/20 text-primary-foreground placeholder:text-primary-foreground/60" type="email" placeholder="Email" aria-label="Email" />
                        </div>
                        <textarea class="blat-textarea bg-white/10 border-white/20 text-primary-foreground placeholder:text-primary-foreground/60" rows="3" placeholder="Tell us about the project…" aria-label="Message"></textarea>
                        <x-ui.button type="submit" variant="secondary" class="w-fit">Send brief <x-lucide-arrow-right class="size-4" /></x-ui.button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-muted-foreground border-t py-8 text-center text-sm">© {{ date('Y') }} Studio Form. Designed in-house, built with BlatUI.</footer>
</x-layouts.app>
