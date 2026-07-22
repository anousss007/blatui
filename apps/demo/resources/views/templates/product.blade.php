@php
    $img = fn ($id, $w = 800) => "https://images.unsplash.com/photo-{$id}?w={$w}&q=80&auto=format&fit=crop";
    $shots = ['1507473885765-e6ed057f782c', '1513506003901-1e6a229e2d15', '1524758631624-e2822e304c36', '1618220179428-22790b461013'];
    $images = collect($shots)->map(fn ($id) => $img($id, 900))->all();

    $colors = [['Charcoal', 'bg-neutral-800'], ['Sand', 'bg-amber-200'], ['Sage', 'bg-emerald-300'], ['Clay', 'bg-orange-300']];
    $sizes = ['Small', 'Medium', 'Large'];

    $specs = [
        'Materials' => 'Powder-coated steel, FSC-certified oak base',
        'Dimensions' => '152 cm H × 28 cm Ø base',
        'Bulb' => 'E27, max 60W (LED recommended)',
        'Cable' => '2.5 m braided, in-line dimmer',
        'Weight' => '4.2 kg',
        'Warranty' => '5 years',
    ];

    $related = [
        ['name' => 'Arc Pendant Light', 'price' => 142, 'id' => '1513506003901-1e6a229e2d15'],
        ['name' => 'Linen Lounge Chair', 'price' => 320, 'id' => '1567538096630-e0c55bd6374c'],
        ['name' => 'Oak Coffee Table', 'price' => 245, 'id' => '1533090481720-856c6e3c1fdc'],
        ['name' => 'Wool Throw Blanket', 'price' => 78, 'id' => '1600166898405-da9535204843'],
    ];
@endphp

<x-layouts.app title="Halo Floor Lamp — Atelier">
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-7xl items-center px-4 lg:px-6">
            <a href="/templates/store/raw" class="text-xl font-semibold tracking-tight">Atelier</a>
            <div class="ml-auto flex items-center gap-1.5">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <button class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md" aria-label="Cart"><x-lucide-shopping-bag class="size-4" /></button>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-7xl px-4 py-6 lg:px-6">
        <x-ui.breadcrumb class="mb-6">
            <x-ui.breadcrumb-list>
                <x-ui.breadcrumb-item><x-ui.breadcrumb-link href="/templates/store/raw">Home</x-ui.breadcrumb-link></x-ui.breadcrumb-item>
                <x-ui.breadcrumb-separator />
                <x-ui.breadcrumb-item><x-ui.breadcrumb-link href="#">Lighting</x-ui.breadcrumb-link></x-ui.breadcrumb-item>
                <x-ui.breadcrumb-separator />
                <x-ui.breadcrumb-item><x-ui.breadcrumb-page>Halo Floor Lamp</x-ui.breadcrumb-page></x-ui.breadcrumb-item>
            </x-ui.breadcrumb-list>
        </x-ui.breadcrumb>

        {{-- Product --}}
        <div class="grid gap-10 lg:grid-cols-2" x-data="{ active: 0, images: @js($images), color: 'Charcoal', size: 'Medium', qty: 1 }">
            {{-- Gallery --}}
            <div>
                <div class="bg-muted aspect-square overflow-hidden rounded-2xl border">
                    <img :src="images[active]" alt="Halo Floor Lamp" class="size-full object-cover" />
                </div>
                <div class="mt-3 grid grid-cols-4 gap-3">
                    <template x-for="(src, i) in images" :key="i">
                        <button type="button" @click="active = i" :class="active === i ? 'border-primary ring-primary/30 ring-2' : 'border-border hover:border-ring'" class="bg-muted aspect-square overflow-hidden rounded-lg border">
                            <img :src="src" alt="" class="size-full object-cover" />
                        </button>
                    </template>
                </div>
            </div>

            {{-- Details --}}
            <div>
                <div class="flex items-center gap-3">
                    <x-ui.badge tone="primary" variant="soft">New</x-ui.badge>
                    <span class="text-muted-foreground text-sm">Lighting · Studio collection</span>
                </div>
                <h1 class="mt-3 text-3xl font-bold tracking-tight">Halo Floor Lamp</h1>
                <div class="mt-2 flex items-center gap-2">
                    <x-ui.rating :value="5" readonly size="sm" />
                    <a href="#reviews" class="text-muted-foreground text-sm hover:underline">128 reviews</a>
                </div>
                <div class="mt-4 flex items-baseline gap-3">
                    <span class="text-3xl font-bold">$189</span>
                    <span class="text-muted-foreground text-lg line-through">$229</span>
                    <x-ui.badge tone="danger" variant="soft">Save 17%</x-ui.badge>
                </div>
                <p class="text-muted-foreground mt-4">A warm, dimmable floor lamp with a hand-finished oak base. Soft enough to read by, bright enough to fill a corner.</p>

                {{-- Color --}}
                <div class="mt-6">
                    <div class="mb-2 text-sm font-medium">Color: <span x-text="color" class="text-muted-foreground font-normal"></span></div>
                    <div class="flex gap-2">
                        @foreach ($colors as [$name, $bg])
                            <button type="button" @click="color = '{{ $name }}'" :class="color === '{{ $name }}' ? 'ring-primary ring-offset-2' : 'ring-transparent'" class="ring-2 ring-offset-2 ring-offset-background size-8 rounded-full {{ $bg }} border" aria-label="{{ $name }}"></button>
                        @endforeach
                    </div>
                </div>

                {{-- Size --}}
                <div class="mt-5">
                    <div class="mb-2 text-sm font-medium">Size</div>
                    <div class="inline-flex rounded-lg border p-1">
                        @foreach ($sizes as $sz)
                            <button type="button" @click="size = '{{ $sz }}'" :class="size === '{{ $sz }}' ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:text-foreground'" class="rounded-md px-4 py-1.5 text-sm font-medium transition-colors">{{ $sz }}</button>
                        @endforeach
                    </div>
                </div>

                {{-- Quantity + add --}}
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <div class="flex items-center rounded-lg border">
                        <button type="button" @click="qty = Math.max(1, qty - 1)" class="hover:bg-accent inline-flex size-10 items-center justify-center rounded-l-lg" aria-label="Decrease"><x-lucide-minus class="size-4" /></button>
                        <span class="w-10 text-center text-sm font-medium" x-text="qty"></span>
                        <button type="button" @click="qty++" class="hover:bg-accent inline-flex size-10 items-center justify-center rounded-r-lg" aria-label="Increase"><x-lucide-plus class="size-4" /></button>
                    </div>
                    <x-ui.button size="lg" class="flex-1"><x-lucide-shopping-bag class="size-4" /> Add to cart</x-ui.button>
                    <x-ui.button size="lg" variant="outline" class="size-11 p-0" aria-label="Wishlist"><x-lucide-heart class="size-4" /></x-ui.button>
                </div>

                {{-- Trust --}}
                <div class="text-muted-foreground mt-6 grid grid-cols-3 gap-3 text-center text-xs">
                    @foreach ([['truck', 'Free shipping'], ['rotate-ccw', '30-day returns'], ['shield-check', '5-year warranty']] as [$ic, $lb])
                        <div class="bg-muted/40 flex flex-col items-center gap-1.5 rounded-lg border p-3"><x-dynamic-component :component="'lucide-'.$ic" class="text-foreground size-5" /> {{ $lb }}</div>
                    @endforeach
                </div>

                {{-- Details accordion --}}
                <x-ui.accordion type="single" collapsible class="mt-6 w-full">
                    <x-ui.accordion-item value="ship"><x-ui.accordion-trigger>Shipping & returns</x-ui.accordion-trigger><x-ui.accordion-content>Free carbon-neutral shipping over $75, delivered in 2–4 business days. Return any item within 30 days for a full refund.</x-ui.accordion-content></x-ui.accordion-item>
                    <x-ui.accordion-item value="care"><x-ui.accordion-trigger>Care</x-ui.accordion-trigger><x-ui.accordion-content>Wipe the shade with a dry cloth. Treat the oak base with natural oil twice a year to keep its finish.</x-ui.accordion-content></x-ui.accordion-item>
                </x-ui.accordion>
            </div>
        </div>

        {{-- Tabs: description / specs / reviews --}}
        <div class="mt-16" id="reviews">
            <x-ui.tabs value="specs" class="w-full">
                <x-ui.tabs-list>
                    <x-ui.tabs-trigger value="desc">Description</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="specs">Specifications</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="reviews">Reviews</x-ui.tabs-trigger>
                </x-ui.tabs-list>
                <x-ui.tabs-content value="desc" class="text-muted-foreground mt-6 max-w-2xl leading-relaxed">
                    The Halo was designed around a single idea: warm light that's kind to your eyes. Its perforated steel shade diffuses the bulb into a soft glow, while the in-line dimmer lets you dial the room from focused to cozy. The solid oak base is turned and finished by hand, so no two are exactly alike.
                </x-ui.tabs-content>
                <x-ui.tabs-content value="specs" class="mt-6 max-w-2xl">
                    <dl class="divide-y">
                        @foreach ($specs as $k => $v)
                            <div class="grid grid-cols-3 gap-4 py-3 text-sm"><dt class="text-muted-foreground">{{ $k }}</dt><dd class="col-span-2 font-medium">{{ $v }}</dd></div>
                        @endforeach
                    </dl>
                </x-ui.tabs-content>
                <x-ui.tabs-content value="reviews" class="mt-6 max-w-2xl space-y-5">
                    @foreach ([['Jenny W.', 5, 'Perfect reading light. The dimmer goes really low which is great for evenings.'], ['Marcus T.', 4, 'Beautiful and sturdy. Assembly took two minutes. Wish the cable were a touch longer.'], ['Priya N.', 5, 'The oak base is gorgeous in person. Exactly the warm light I wanted.']] as [$n, $r, $t])
                        <div class="border-b pb-5 last:border-0">
                            <div class="flex items-center gap-2"><x-ui.avatar class="size-7"><x-ui.avatar-fallback class="text-xs">{{ $n[0] }}</x-ui.avatar-fallback></x-ui.avatar><span class="text-sm font-medium">{{ $n }}</span></div>
                            <div class="mt-1.5"><x-ui.rating :value="$r" readonly size="sm" /></div>
                            <p class="text-muted-foreground mt-2 text-sm">{{ $t }}</p>
                        </div>
                    @endforeach
                </x-ui.tabs-content>
            </x-ui.tabs>
        </div>

        {{-- Related --}}
        <div class="mt-16">
            <h2 class="mb-6 text-2xl font-bold tracking-tight">You might also like</h2>
            <div class="grid grid-cols-2 gap-x-5 gap-y-8 lg:grid-cols-4">
                @foreach ($related as $r)
                    <a href="#" class="group">
                        <div class="bg-muted aspect-square overflow-hidden rounded-xl border"><img src="{{ $img($r['id']) }}" alt="{{ $r['name'] }}" loading="lazy" class="size-full object-cover transition-transform duration-300 group-hover:scale-105" /></div>
                        <h3 class="mt-3 text-sm font-medium">{{ $r['name'] }}</h3>
                        <div class="mt-1 font-semibold">${{ $r['price'] }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <footer class="text-muted-foreground mt-10 border-t py-8 text-center text-sm">© {{ date('Y') }} Atelier. All rights reserved.</footer>
</x-layouts.app>
