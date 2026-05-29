@props(['active' => null])

@php
    $nav = [
        'docs' => ['label' => 'Docs', 'href' => '/docs'],
        'components' => ['label' => 'Components', 'href' => '/components'],
        'blocks' => ['label' => 'Blocks', 'href' => '/blocks'],
        'charts' => ['label' => 'Charts', 'href' => '/charts'],
    ];
@endphp

<header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
    <div class="mx-auto flex h-14 max-w-screen-2xl items-center gap-3 px-4 lg:px-6">
        {{ $leading ?? '' }}
        <a href="/" class="flex items-center gap-2 font-semibold tracking-tight">
            <span class="bg-primary text-primary-foreground flex size-7 items-center justify-center rounded-lg">
                <x-lucide-component class="size-4" />
            </span>
            {{ config('brand.name') }}
        </a>

        <nav class="ml-2 hidden items-center gap-0.5 text-sm md:flex">
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
            <x-customizer />
            <button type="button" @click="$store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" title="Toggle theme">
                <x-lucide-sun class="size-4 dark:hidden" />
                <x-lucide-moon class="hidden size-4 dark:block" />
            </button>
            <a href="{{ config('brand.github') }}" target="_blank" rel="noopener" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" title="GitHub">
                <x-lucide-github class="size-4" />
            </a>
        </div>
    </div>
</header>
