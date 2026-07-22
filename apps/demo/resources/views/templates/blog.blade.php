@php
    $img = fn ($id, $w = 800) => "https://images.unsplash.com/photo-{$id}?w={$w}&q=80&auto=format&fit=crop";
    $nav = ['Latest', 'Design', 'Engineering', 'Culture', 'Newsletter'];

    $featured = [
        'cat' => 'Engineering', 'tone' => 'primary',
        'title' => 'How we cut our build times by 70% with a smarter cache',
        'excerpt' => 'A deep dive into the content-addressable pipeline we built, the dead ends we hit, and the three changes that actually moved the needle.',
        'author' => 'Marcus Chen', 'init' => 'MC', 'date' => 'Jun 8, 2026', 'read' => '8 min', 'id' => '1517180102446-f3ece451e9d8',
    ];

    $posts = [
        ['cat' => 'Design', 'tone' => 'info', 'title' => 'Designing for dark mode without doubling your work', 'author' => 'Sofia Davis', 'init' => 'SD', 'date' => 'Jun 7', 'read' => '6 min', 'id' => '1498050108023-c5249f4df085'],
        ['cat' => 'Engineering', 'tone' => 'primary', 'title' => 'A pragmatic guide to feature flags at scale', 'author' => 'Priya Nair', 'init' => 'PN', 'date' => 'Jun 6', 'read' => '9 min', 'id' => '1526374965328-7f61d4dc18c5'],
        ['cat' => 'Culture', 'tone' => 'warning', 'title' => 'What async-first actually looks like day to day', 'author' => 'Jackson Lee', 'init' => 'JL', 'date' => 'Jun 5', 'read' => '5 min', 'id' => '1517694712202-14dd9538aa97'],
        ['cat' => 'Design', 'tone' => 'info', 'title' => 'The case for boring, predictable components', 'author' => 'Ada Lovelace', 'init' => 'AL', 'date' => 'Jun 4', 'read' => '7 min', 'id' => '1555066931-4365d14bab8c'],
        ['cat' => 'Engineering', 'tone' => 'primary', 'title' => 'Shipping a design system your team will use', 'author' => 'William Kim', 'init' => 'WK', 'date' => 'Jun 3', 'read' => '10 min', 'id' => '1518770660439-4636190af475'],
        ['cat' => 'Culture', 'tone' => 'warning', 'title' => 'Writing changelogs people actually read', 'author' => 'Olivia Martin', 'init' => 'OM', 'date' => 'Jun 2', 'read' => '4 min', 'id' => '1551288049-bebda4e38f71'],
    ];
@endphp

<x-layouts.app title="The Dispatch — Stories on craft & code">
    {{-- Header --}}
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">
            <a href="#" class="text-xl font-bold tracking-tight">The&nbsp;Dispatch</a>
            <nav class="ml-4 hidden items-center gap-1 text-sm md:flex">
                @foreach ($nav as $label)
                    <a href="#" class="text-muted-foreground hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">{{ $label }}</a>
                @endforeach
            </nav>
            <div class="ml-auto flex items-center gap-1.5">
                <button class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Search"><x-lucide-search class="size-4" /></button>
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <x-ui.button size="sm">Subscribe</x-ui.button>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-6xl px-6">
        {{-- Featured --}}
        <section class="border-b py-12">
            <a href="#" class="group grid items-center gap-8 lg:grid-cols-2">
                <div class="bg-muted aspect-[16/10] overflow-hidden rounded-2xl border">
                    <img src="{{ $img($featured['id'], 1100) }}" alt="" loading="lazy" class="size-full object-cover transition-transform duration-500 group-hover:scale-105" />
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <x-ui.badge :tone="$featured['tone']" variant="soft">{{ $featured['cat'] }}</x-ui.badge>
                        <span class="text-muted-foreground text-xs">Featured</span>
                    </div>
                    <h1 class="group-hover:text-primary mt-3 text-3xl font-bold tracking-tight text-balance transition-colors sm:text-4xl">{{ $featured['title'] }}</h1>
                    <p class="text-muted-foreground mt-3 text-lg text-balance">{{ $featured['excerpt'] }}</p>
                    <div class="mt-5 flex items-center gap-3">
                        <x-ui.avatar class="size-9"><x-ui.avatar-fallback>{{ $featured['init'] }}</x-ui.avatar-fallback></x-ui.avatar>
                        <div class="text-sm">
                            <div class="font-medium">{{ $featured['author'] }}</div>
                            <div class="text-muted-foreground">{{ $featured['date'] }} · {{ $featured['read'] }} read</div>
                        </div>
                    </div>
                </div>
            </a>
        </section>

        {{-- Latest grid --}}
        <section class="py-12">
            <div class="mb-7 flex items-baseline justify-between">
                <h2 class="text-2xl font-bold tracking-tight">Latest stories</h2>
                <a href="#" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1 text-sm">View all <x-lucide-arrow-right class="size-3.5" /></a>
            </div>
            <div class="grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($posts as $post)
                    <a href="#" class="group flex flex-col">
                        <div class="bg-muted aspect-[16/10] overflow-hidden rounded-xl border">
                            <img src="{{ $img($post['id']) }}" alt="" loading="lazy" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        </div>
                        <div class="mt-4 flex flex-1 flex-col">
                            <x-ui.badge :tone="$post['tone']" variant="soft" class="w-fit text-xs">{{ $post['cat'] }}</x-ui.badge>
                            <h3 class="group-hover:text-primary mt-2.5 text-lg font-semibold leading-snug text-balance transition-colors">{{ $post['title'] }}</h3>
                            <div class="text-muted-foreground mt-auto flex items-center gap-2 pt-4 text-sm">
                                <x-ui.avatar class="size-6"><x-ui.avatar-fallback class="text-[10px]">{{ $post['init'] }}</x-ui.avatar-fallback></x-ui.avatar>
                                <span class="text-foreground font-medium">{{ $post['author'] }}</span>
                                <span>·</span><span>{{ $post['date'] }}</span><span>·</span><span>{{ $post['read'] }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Newsletter --}}
    <section class="bg-muted/30 border-y py-16">
        <div class="mx-auto max-w-xl px-6 text-center">
            <x-lucide-mail class="text-primary mx-auto mb-3 size-8" />
            <h2 class="text-2xl font-bold tracking-tight">The Dispatch, in your inbox</h2>
            <p class="text-muted-foreground mt-2">One thoughtful email a week on design and engineering. No spam, unsubscribe anytime.</p>
            <form class="mx-auto mt-6 flex max-w-md gap-2">
                <x-ui.input type="email" placeholder="you@example.com" class="flex-1" aria-label="Email" />
                <x-ui.button type="submit">Subscribe</x-ui.button>
            </form>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t py-10">
        <div class="text-muted-foreground mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-6 text-sm sm:flex-row">
            <span>© {{ date('Y') }} The Dispatch. Built with BlatUI.</span>
            <div class="flex gap-2">
                @foreach (['twitter', 'github', 'rss'] as $s)
                    <a href="#" aria-label="{{ $s }}" class="hover:text-foreground hover:bg-accent inline-flex size-9 items-center justify-center rounded-md border transition-colors"><x-dynamic-component :component="'lucide-'.$s" class="size-4" /></a>
                @endforeach
            </div>
        </div>
    </footer>
</x-layouts.app>
