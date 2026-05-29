@props([
    'title' => null,
    'description' => null,
    'active' => null,
])

@php
    $categories = config('docs.categories');
    $available = collect(glob(resource_path('views/examples/*'), GLOB_ONLYDIR))
        ->map(fn ($p) => basename($p))->all();
@endphp

<x-layouts.app :title="$title" :description="$description ?: 'shadcn/ui components for Laravel — Blade, Alpine & Tailwind v4. Browse, copy and own the code.'">
    <div x-data="{ sidebar: false }" class="min-h-screen">
        {{-- Top bar (shared) --}}
        <x-site.header active="components">
            <x-slot:leading>
                <button type="button" class="-ml-1 inline-flex size-9 items-center justify-center rounded-md lg:hidden" @click="sidebar = !sidebar">
                    <x-lucide-menu class="size-5" />
                </button>
            </x-slot:leading>
        </x-site.header>

        <div class="mx-auto flex max-w-screen-2xl">
            {{-- Sidebar --}}
            <aside
                class="bg-background fixed inset-y-0 left-0 top-14 z-30 w-64 shrink-0 overflow-y-auto border-r p-4 transition-transform lg:sticky lg:top-14 lg:h-[calc(100svh-3.5rem)] lg:translate-x-0"
                :class="sidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
                <nav class="space-y-6 text-sm">
                    @foreach ($categories as $label => $items)
                        <div>
                            <p class="text-muted-foreground mb-1.5 px-2 text-xs font-semibold tracking-wide uppercase">{{ $label }}</p>
                            <ul class="space-y-0.5">
                                @foreach ($items as $slug)
                                    @php $has = in_array($slug, $available); @endphp
                                    <li>
                                        <a href="{{ $has ? route('docs.component', $slug) : '#' }}"
                                            @class([
                                                'flex items-center justify-between rounded-md px-2 py-1.5 transition-colors',
                                                'bg-accent text-accent-foreground font-medium' => $active === $slug,
                                                'hover:bg-accent/60 text-foreground' => $active !== $slug && $has,
                                                'text-muted-foreground/50 cursor-not-allowed' => ! $has,
                                            ])>
                                            <span class="capitalize">{{ str_replace('-', ' ', $slug) }}</span>
                                            @unless ($has)
                                                <span class="text-muted-foreground/40 text-[10px]">soon</span>
                                            @endunless
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </nav>
            </aside>

            {{-- Backdrop (mobile) --}}
            <div x-show="sidebar" x-cloak @click="sidebar = false" class="fixed inset-0 top-14 z-20 bg-black/50 lg:hidden"></div>

            {{-- Content --}}
            <main class="min-w-0 flex-1 px-4 py-8 lg:px-10">
                <div class="mx-auto max-w-3xl">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-layouts.app>
