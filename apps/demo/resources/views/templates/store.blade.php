@php
    $nav = ['Shop' => '#', 'New in' => '#', 'Lighting' => '#', 'Sale' => '#'];
    $chips = ['All', 'Lighting', 'Seating', 'Tables', 'Decor', 'Textiles'];

    $img = fn ($id, $w = 600) => "https://images.unsplash.com/photo-{$id}?w={$w}&q=80&auto=format&fit=crop";

    $products = [
        ['name' => 'Halo Floor Lamp', 'cat' => 'Lighting', 'price' => 189, 'old' => null, 'rating' => 5, 'reviews' => 128, 'badge' => 'New', 'tone' => 'primary', 'id' => '1507473885765-e6ed057f782c'],
        ['name' => 'Linen Lounge Chair', 'cat' => 'Seating', 'price' => 320, 'old' => 420, 'rating' => 4, 'reviews' => 86, 'badge' => 'Sale', 'tone' => 'danger', 'id' => '1567538096630-e0c55bd6374c'],
        ['name' => 'Oak Coffee Table', 'cat' => 'Tables', 'price' => 245, 'old' => null, 'rating' => 5, 'reviews' => 54, 'badge' => null, 'tone' => null, 'id' => '1533090481720-856c6e3c1fdc'],
        ['name' => 'Terra Vase Set', 'cat' => 'Decor', 'price' => 64, 'old' => null, 'rating' => 4, 'reviews' => 210, 'badge' => 'New', 'tone' => 'primary', 'id' => '1588345921523-c2dcdb7f1dcd'],
        ['name' => 'Wool Throw Blanket', 'cat' => 'Textiles', 'price' => 78, 'old' => 99, 'rating' => 5, 'reviews' => 167, 'badge' => 'Sale', 'tone' => 'danger', 'id' => '1600166898405-da9535204843'],
        ['name' => 'Arc Pendant Light', 'cat' => 'Lighting', 'price' => 142, 'old' => null, 'rating' => 4, 'reviews' => 41, 'badge' => null, 'tone' => null, 'id' => '1513506003901-1e6a229e2d15'],
        ['name' => 'Boucle Accent Stool', 'cat' => 'Seating', 'price' => 119, 'old' => null, 'rating' => 5, 'reviews' => 73, 'badge' => null, 'tone' => null, 'id' => '1503602642458-232111445657'],
        ['name' => 'Ceramic Mug Set', 'cat' => 'Decor', 'price' => 38, 'old' => null, 'rating' => 4, 'reviews' => 305, 'badge' => 'Bestseller', 'tone' => 'warning', 'id' => '1514228742587-6b1558fcca3d'],
    ];

    $cart = [
        ['name' => 'Halo Floor Lamp', 'price' => 189, 'qty' => 1, 'id' => '1507473885765-e6ed057f782c'],
        ['name' => 'Terra Vase Set', 'price' => 64, 'qty' => 2, 'id' => '1588345921523-c2dcdb7f1dcd'],
    ];
    $subtotal = collect($cart)->sum(fn ($l) => $l['price'] * $l['qty']);

    $lookbook = ['1616486338812-3dadae4b4ace', '1586023492125-27b2c045efd7', '1567016432779-094069958ea5', '1556228453-efd6c1ff04f6'];

    $footer = [
        'Shop' => ['New arrivals', 'Lighting', 'Furniture', 'Decor', 'Sale'],
        'Help' => ['Shipping', 'Returns', 'Track order', 'Size guide', 'Contact'],
        'Company' => ['Our story', 'Stores', 'Sustainability', 'Careers', 'Press'],
    ];
@endphp

<x-layouts.app title="Atelier — Modern home goods">
    <x-ui.banner tone="default" :dismissible="false" class="justify-center text-xs">
        <span class="inline-flex items-center gap-2"><x-lucide-truck class="size-4" /> Free shipping over $75 · 30-day returns · <a href="#" class="font-semibold underline underline-offset-2">Shop the sale</a></span>
    </x-ui.banner>

    {{-- Header --}}
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-4 lg:px-6">
            <a href="#" class="text-xl font-semibold tracking-tight">Atelier</a>
            <nav class="ml-4 hidden items-center gap-1 text-sm md:flex">
                @foreach ($nav as $label => $href)
                    <a href="{{ $href }}" class="text-muted-foreground hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">{{ $label }}</a>
                @endforeach
            </nav>
            <div class="ml-auto flex items-center gap-1.5">
                <div class="hidden sm:block">
                    <x-ui.input type="search" placeholder="Search products…" class="h-9 w-44 lg:w-56">
                        <x-slot:leading><x-lucide-search /></x-slot:leading>
                    </x-ui.input>
                </div>
                <button class="hover:bg-accent relative inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Wishlist"><x-lucide-heart class="size-4" /></button>

                {{-- Cart drawer --}}
                <x-ui.sheet>
                    <x-ui.sheet-trigger>
                        <button class="hover:bg-accent relative inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Cart">
                            <x-lucide-shopping-bag class="size-4" />
                            <span class="bg-primary text-primary-foreground absolute -right-0.5 -top-0.5 flex size-4 items-center justify-center rounded-full text-[10px] font-semibold">{{ count($cart) + 1 }}</span>
                        </button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="right" class="flex flex-col">
                        <x-ui.sheet-header>
                            <x-ui.sheet-title>Your cart</x-ui.sheet-title>
                            <x-ui.sheet-description>{{ count($cart) }} items · ships in 2–4 days</x-ui.sheet-description>
                        </x-ui.sheet-header>
                        <div class="flex-1 space-y-4 overflow-auto px-4">
                            @foreach ($cart as $line)
                                <div class="flex gap-3">
                                    <img src="{{ $img($line['id'], 160) }}" alt="{{ $line['name'] }}" class="size-16 shrink-0 rounded-md border object-cover" />
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-start justify-between gap-2">
                                            <span class="truncate text-sm font-medium">{{ $line['name'] }}</span>
                                            <button class="text-muted-foreground hover:text-foreground" aria-label="Remove"><x-lucide-x class="size-4" /></button>
                                        </div>
                                        <div class="text-muted-foreground mt-1 flex items-center justify-between text-sm">
                                            <span>Qty {{ $line['qty'] }}</span>
                                            <span class="text-foreground font-medium">${{ $line['price'] * $line['qty'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-ui.sheet-footer>
                            <div class="mb-1 flex items-center justify-between text-sm">
                                <span class="text-muted-foreground">Subtotal</span>
                                <span class="text-lg font-semibold">${{ $subtotal }}</span>
                            </div>
                            <x-ui.button class="w-full">Checkout <x-lucide-arrow-right class="size-4" /></x-ui.button>
                            <x-ui.button variant="outline" class="w-full" x-on:click="open = false">Continue shopping</x-ui.button>
                        </x-ui.sheet-footer>
                    </x-ui.sheet-content>
                </x-ui.sheet>

                {{-- Mobile menu --}}
                <x-ui.sheet>
                    <x-ui.sheet-trigger class="md:hidden">
                        <button class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Menu"><x-lucide-menu class="size-4" /></button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="left">
                        <x-ui.sheet-header><x-ui.sheet-title>Atelier</x-ui.sheet-title></x-ui.sheet-header>
                        <nav class="grid gap-1 px-4 text-sm">
                            @foreach ($nav as $label => $href)
                                <a href="{{ $href }}" @click="open = false" class="hover:bg-accent rounded-md px-3 py-2 font-medium">{{ $label }}</a>
                            @endforeach
                        </nav>
                    </x-ui.sheet-content>
                </x-ui.sheet>
            </div>
        </div>
    </header>

    {{-- Hero --}}
    <section class="border-b">
        <div class="mx-auto grid max-w-7xl items-stretch gap-0 lg:grid-cols-2">
            <div class="flex flex-col justify-center px-6 py-16 lg:px-12 lg:py-24">
                <x-ui.badge tone="primary" variant="soft" class="mb-4 w-fit">New season</x-ui.badge>
                <h1 class="text-4xl font-bold tracking-tight text-balance sm:text-5xl">Warm minimalism for every room</h1>
                <p class="text-muted-foreground mt-4 max-w-md text-lg text-balance">Considered pieces in natural materials — built to last, priced to live with. Free shipping over $75.</p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <x-ui.button size="lg">Shop new arrivals <x-lucide-arrow-right class="size-4" /></x-ui.button>
                    <x-ui.button size="lg" variant="outline">Browse lookbook</x-ui.button>
                </div>
            </div>
            <div class="bg-muted relative min-h-[320px] overflow-hidden">
                <img src="{{ $img('1618220179428-22790b461013', 1100) }}" alt="Styled living room" loading="lazy" class="size-full object-cover" />
            </div>
        </div>
    </section>

    {{-- Category chips --}}
    <div class="border-b">
        <div class="mx-auto flex max-w-7xl gap-2 overflow-x-auto px-4 py-4 lg:px-6" x-data="{ active: 'All' }">
            @foreach ($chips as $chip)
                <button @click="active = '{{ $chip }}'" :class="active === '{{ $chip }}' ? 'bg-primary text-primary-foreground' : 'bg-muted text-muted-foreground hover:text-foreground'" class="shrink-0 rounded-full px-4 py-1.5 text-sm font-medium transition-colors">{{ $chip }}</button>
            @endforeach
        </div>
    </div>

    {{-- Shop --}}
    <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 lg:grid-cols-[240px_1fr] lg:px-6">
        {{-- Filters --}}
        <aside class="hidden lg:block">
            <div class="sticky top-24 space-y-7">
                <div>
                    <h3 class="mb-3 text-sm font-semibold">Price</h3>
                    <x-ui.slider range :value="[40, 220]" :min="0" :max="320" name="price" aria-label="Price" />
                    <div class="text-muted-foreground mt-2 flex justify-between text-xs"><span>$0</span><span>$320</span></div>
                </div>
                <x-ui.separator />
                <div>
                    <h3 class="mb-3 text-sm font-semibold">Category</h3>
                    <div class="space-y-2.5">
                        @foreach (['Lighting' => 14, 'Seating' => 9, 'Tables' => 6, 'Decor' => 22, 'Textiles' => 11] as $c => $n)
                            <label class="flex cursor-pointer items-center gap-2.5 text-sm">
                                <x-ui.checkbox id="cat-{{ \Illuminate\Support\Str::slug($c) }}" />
                                <span class="flex-1">{{ $c }}</span>
                                <span class="text-muted-foreground text-xs">{{ $n }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <x-ui.separator />
                <div>
                    <h3 class="mb-3 text-sm font-semibold">Rating</h3>
                    <label class="flex cursor-pointer items-center gap-2.5 text-sm">
                        <x-ui.checkbox id="rating-4" />
                        <x-ui.rating :value="4" readonly size="sm" /> <span class="text-muted-foreground text-xs">&amp; up</span>
                    </label>
                </div>
            </div>
        </aside>

        {{-- Grid --}}
        <div>
            <div class="mb-6 flex items-center justify-between">
                <p class="text-muted-foreground text-sm"><span class="text-foreground font-medium">{{ count($products) }}</span> products</p>
                <x-ui.dropdown-menu>
                    <x-ui.dropdown-menu-trigger>
                        <x-ui.button variant="outline" size="sm">Sort: Featured <x-lucide-chevron-down class="size-4" /></x-ui.button>
                    </x-ui.dropdown-menu-trigger>
                    <x-ui.dropdown-menu-content align="end" class="w-48">
                        @foreach (['Featured', 'Newest', 'Price: Low to High', 'Price: High to Low', 'Top rated'] as $opt)
                            <x-ui.dropdown-menu-item>{{ $opt }}</x-ui.dropdown-menu-item>
                        @endforeach
                    </x-ui.dropdown-menu-content>
                </x-ui.dropdown-menu>
            </div>

            <div class="grid grid-cols-2 gap-x-5 gap-y-8 lg:grid-cols-3">
                @foreach ($products as $p)
                    <div class="group">
                        <div class="bg-muted relative aspect-square overflow-hidden rounded-xl border">
                            <img src="{{ $img($p['id']) }}" alt="{{ $p['name'] }}" loading="lazy" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" />
                            @if ($p['badge'])
                                <x-ui.badge tone="{{ $p['tone'] }}" class="absolute left-2.5 top-2.5">{{ $p['badge'] }}</x-ui.badge>
                            @endif
                            <button class="bg-background/80 text-foreground absolute right-2.5 top-2.5 inline-flex size-8 items-center justify-center rounded-full opacity-0 backdrop-blur transition-opacity group-hover:opacity-100 hover:text-red-500" aria-label="Add to wishlist"><x-lucide-heart class="size-4" /></button>
                            <div class="absolute inset-x-2.5 bottom-2.5 translate-y-2 opacity-0 transition-all duration-200 group-hover:translate-y-0 group-hover:opacity-100">
                                <x-ui.button size="sm" class="w-full"><x-lucide-shopping-bag class="size-4" /> Add to cart</x-ui.button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="text-muted-foreground text-xs">{{ $p['cat'] }}</div>
                            <h3 class="mt-0.5 text-sm font-medium">{{ $p['name'] }}</h3>
                            <div class="mt-1 flex items-center gap-1.5">
                                <x-ui.rating :value="$p['rating']" readonly size="sm" />
                                <span class="text-muted-foreground text-xs">({{ $p['reviews'] }})</span>
                            </div>
                            <div class="mt-1.5 flex items-center gap-2">
                                <span class="font-semibold">${{ $p['price'] }}</span>
                                @if ($p['old'])<span class="text-muted-foreground text-sm line-through">${{ $p['old'] }}</span>@endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Lookbook (gallery + lightbox) --}}
    <section class="bg-muted/30 border-y py-16">
        <div class="mx-auto max-w-7xl px-4 lg:px-6">
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight sm:text-3xl">Shop the look</h2>
                    <p class="text-muted-foreground mt-1">Tap any room to explore the pieces.</p>
                </div>
            </div>
            <x-ui.gallery :columns="4" rounded="rounded-xl" :images="collect($lookbook)->map(fn ($id) => ['src' => $img($id, 1400), 'thumb' => $img($id, 600), 'alt' => 'Styled room'])->all()" />
        </div>
    </section>

    {{-- Trust marquee --}}
    <section class="py-10">
        <p class="text-muted-foreground mb-5 text-center text-sm">As seen in</p>
        <x-ui.marquee fade :duration="'30s'" class="mx-auto max-w-4xl">
            @foreach (['Vogue Living', 'Dwell', 'Architectural Digest', 'Kinfolk', 'Elle Decor', 'Cereal'] as $name)
                <span class="text-muted-foreground/60 px-2 text-lg font-medium whitespace-nowrap italic">{{ $name }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- Newsletter --}}
    <section class="border-t py-16">
        <div class="mx-auto max-w-xl px-6 text-center">
            <h2 class="text-2xl font-bold tracking-tight">Get 10% off your first order</h2>
            <p class="text-muted-foreground mt-2">Join the list for new drops, restocks and the occasional sale.</p>
            <form class="mx-auto mt-6 flex max-w-md gap-2">
                <x-ui.input type="email" placeholder="you@example.com" class="flex-1" aria-label="Email" />
                <x-ui.button type="submit">Subscribe</x-ui.button>
            </form>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t">
        <div class="mx-auto max-w-7xl px-6 py-14">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <span class="text-xl font-semibold">Atelier</span>
                    <p class="text-muted-foreground mt-3 max-w-xs text-sm">Modern home goods in natural materials. Designed in Copenhagen, shipped worldwide.</p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['instagram', 'twitter', 'youtube'] as $s)
                            <a href="#" aria-label="{{ $s }}" class="text-muted-foreground hover:text-foreground hover:bg-accent inline-flex size-9 items-center justify-center rounded-md border transition-colors"><x-dynamic-component :component="'lucide-'.$s" class="size-4" /></a>
                        @endforeach
                    </div>
                </div>
                @foreach ($footer as $heading => $links)
                    <div>
                        <h3 class="text-sm font-semibold">{{ $heading }}</h3>
                        <ul class="mt-3 space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li><a href="#" class="text-muted-foreground hover:text-foreground transition-colors">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <x-ui.separator class="my-8" />
            <div class="text-muted-foreground flex flex-col items-center justify-between gap-3 text-sm sm:flex-row">
                <span>© {{ date('Y') }} Atelier. All rights reserved.</span>
                <div class="flex items-center gap-2 opacity-70">
                    @foreach (['credit-card', 'wallet', 'badge-dollar-sign'] as $i)<x-dynamic-component :component="'lucide-'.$i" class="size-5" />@endforeach
                </div>
            </div>
        </div>
    </footer>
</x-layouts.app>
