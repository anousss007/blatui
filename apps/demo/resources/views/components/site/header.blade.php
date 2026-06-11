@props(['active' => null])

@php
    $nav = [
        'docs' => ['label' => 'Docs', 'href' => '/docs'],
        'components' => ['label' => 'Components', 'href' => '/components'],
        'blocks' => ['label' => 'Blocks', 'href' => '/blocks'],
        'templates' => ['label' => 'Templates', 'href' => '/templates'],
        'charts' => ['label' => 'Charts', 'href' => '/charts'],
        'themes' => ['label' => 'Themes', 'href' => '/themes'],
    ];
@endphp

<header class="bg-background/80 supports-[backdrop-filter]:bg-background/65 sticky top-0 z-40 border-b backdrop-blur-xl">
    <div class="mx-auto flex h-14 max-w-screen-2xl items-center gap-3 px-4 lg:px-6">
        {{ $leading ?? '' }}

        {{-- Wordmark --}}
        <a href="/" class="flex shrink-0 items-center gap-2.5 font-semibold tracking-tight" aria-label="{{ config('brand.name') }} home">
            <span class="blat-brand-fill flex size-7 items-center justify-center rounded-md shadow-sm">
                <x-lucide-terminal class="size-4" />
            </span>
            <span class="blat-mono text-[15px]">blatui</span>
        </a>

        {{-- Desktop nav --}}
        <nav class="ml-3 hidden items-center gap-0.5 text-sm lg:flex">
            @foreach ($nav as $key => $item)
                <a href="{{ $item['href'] }}"
                    @class([
                        'rounded-md px-3 py-1.5 font-medium transition-colors',
                        'bg-accent text-accent-foreground' => $active === $key,
                        'text-muted-foreground hover:text-foreground hover:bg-accent/60' => $active !== $key,
                    ])>{{ $item['label'] }}</a>
            @endforeach
        </nav>

        <div class="ml-auto flex items-center gap-1.5">
            {{-- GitHub --}}
            <a href="{{ config('brand.github') }}" target="_blank" rel="noopener"
               class="hover:border-foreground/30 bg-card hidden items-center gap-1.5 rounded-md border px-2.5 py-1.5 text-xs font-medium transition-colors sm:inline-flex"
               title="Star on GitHub">
                <x-lucide-github class="size-3.5" />
                <span class="blat-mono">Star</span>
                <x-lucide-star class="size-3 fill-amber-400 text-amber-400" aria-hidden="true" />
            </a>

            <x-customizer />

            <button type="button" @click="$store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" title="Toggle theme" aria-label="Toggle theme">
                <x-lucide-sun class="size-4 dark:hidden" />
                <x-lucide-moon class="hidden size-4 dark:block" />
            </button>

            {{-- Get started (desktop) --}}
            <a href="/docs" class="blat-glow-btn blat-brand-fill hidden items-center gap-1.5 rounded-md px-3 py-1.5 text-sm font-semibold md:inline-flex">
                Get started <x-lucide-arrow-right class="size-3.5" />
            </a>

            {{-- Mobile menu --}}
            <div class="lg:hidden">
                <x-ui.sheet>
                    <x-ui.sheet-trigger>
                        <button type="button" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Open menu">
                            <x-lucide-menu class="size-5" />
                        </button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="right" class="w-72">
                        <x-ui.sheet-header>
                            <x-ui.sheet-title class="flex items-center gap-2.5">
                                <span class="blat-brand-fill flex size-7 items-center justify-center rounded-md">
                                    <x-lucide-terminal class="size-4" />
                                </span>
                                <span class="blat-mono text-[15px]">blatui</span>
                            </x-ui.sheet-title>
                        </x-ui.sheet-header>

                        <nav class="mt-2 flex flex-col gap-0.5 px-4">
                            @foreach ($nav as $key => $item)
                                <a href="{{ $item['href'] }}" @click="open = false"
                                    @class([
                                        'flex items-center justify-between rounded-md px-3 py-2.5 text-sm font-medium transition-colors',
                                        'bg-accent text-accent-foreground' => $active === $key,
                                        'text-muted-foreground hover:text-foreground hover:bg-accent/60' => $active !== $key,
                                    ])>
                                    <span class="blat-mono">{{ $item['label'] }}</span>
                                    <x-lucide-arrow-up-right class="size-3.5 opacity-50" />
                                </a>
                            @endforeach
                        </nav>

                        <x-ui.sheet-footer class="mt-auto gap-2">
                            <a href="/docs" @click="open = false" class="blat-brand-fill inline-flex w-full items-center justify-center gap-1.5 rounded-md px-3 py-2.5 text-sm font-semibold">
                                Get started <x-lucide-arrow-right class="size-4" />
                            </a>
                            <a href="{{ config('brand.github') }}" target="_blank" rel="noopener" class="inline-flex w-full items-center justify-center gap-2 rounded-md border px-3 py-2.5 text-sm font-medium">
                                <x-lucide-github class="size-4" /> Star on GitHub
                            </a>
                        </x-ui.sheet-footer>
                    </x-ui.sheet-content>
                </x-ui.sheet>
            </div>
        </div>
    </div>
</header>
