@php
    $cols = [
        'Explore' => [
            ['Components', '/components'],
            ['Blocks', '/blocks'],
            ['Templates', '/templates'],
            ['Charts', '/charts'],
            ['Themes', '/themes'],
        ],
        'Docs' => [
            ['Getting started', '/docs'],
            ['MCP server', '/docs/mcp'],
            ['llms.txt', '/llms.txt'],
            ['registry.json', '/registry.json'],
        ],
        'Project' => [
            ['GitHub', config('brand.github')],
            ['Package', config('brand.package')],
            ['Packagist', 'https://packagist.org/packages/blatui/blatui'],
            ['Changelog', config('brand.github').'/blob/main/CHANGELOG.md'],
        ],
    ];

    preg_match('/##\s*\[([0-9][0-9.]*)\]/', @file_get_contents(base_path('CHANGELOG.md')) ?: '', $vm);
    $version = $vm[1] ?? '';
@endphp

<footer class="bg-muted/30 border-t">
    <div class="mx-auto max-w-screen-2xl px-6 py-14 lg:px-8">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                <a href="/" class="flex items-center gap-2.5 font-semibold tracking-tight" aria-label="{{ config('brand.name') }}">
                    <span class="blat-brand-fill flex size-7 items-center justify-center rounded-md">
                        <x-lucide-terminal class="size-4" />
                    </span>
                    <span class="blat-mono text-[15px]">blatui</span>
                </a>
                <p class="text-muted-foreground mt-3 max-w-xs text-sm leading-relaxed">
                    {{ config('brand.tagline') }}. Copy, paste & own beautiful Blade components — Laravel, Alpine &amp; Tailwind v4. No npm runtime, no lock-in.
                </p>
                <div class="mt-5 flex items-center gap-2">
                    <a href="{{ config('brand.github') }}" target="_blank" rel="noopener" aria-label="GitHub" class="hover:border-foreground/30 hover:text-foreground text-muted-foreground inline-flex size-8 items-center justify-center rounded-md border transition-colors">
                        <x-lucide-github class="size-4" />
                    </a>
                    <span class="bg-card inline-flex items-center gap-1.5 rounded-md border px-2.5 py-1.5 text-xs font-medium">
                        <x-lucide-scale class="size-3.5" style="color: var(--blat-brand-ink);" />
                        <span class="blat-mono">MIT</span>
                    </span>
                </div>
            </div>

            {{-- Link columns --}}
            @foreach ($cols as $heading => $links)
                <div>
                    <h3 class="blat-mono text-muted-foreground/80 mb-3 text-[11px] font-semibold tracking-widest uppercase">{{ $heading }}</h3>
                    <ul class="space-y-2.5 text-sm">
                        @foreach ($links as [$label, $href])
                            <li>
                                <a href="{{ $href }}" @if (str_starts_with($href, 'http')) target="_blank" rel="noopener" @endif
                                   class="text-muted-foreground hover:text-foreground transition-colors">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="border-border/60 mt-12 flex flex-col items-center justify-between gap-3 border-t pt-6 sm:flex-row">
            <p class="text-muted-foreground text-xs">
                © {{ date('Y') }} {{ config('brand.name') }}. Built with Blade, Laravel, Alpine &amp; Tailwind&nbsp;v4.
            </p>
            <div class="text-muted-foreground flex items-center gap-2 text-xs">
                <span class="inline-block size-1.5 rounded-full" style="background: var(--blat-brand);"></span>
                <span class="blat-mono">v{{ $version }}</span>
                <span class="opacity-40">·</span>
                <span>Inspired by shadcn/ui</span>
            </div>
        </div>
    </div>
</footer>
