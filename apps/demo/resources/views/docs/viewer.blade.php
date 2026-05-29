@php
    $source = rtrim(file_get_contents(resource_path("views/{$kind}/{$slug}.blade.php")));
    $rawUrl = "/{$kind}/{$slug}/raw";
    $title = \Illuminate\Support\Str::headline($slug);
    $backLabel = $kind === 'charts' ? 'Charts' : 'Blocks';
    $addCmd = "php artisan blatui:add {$kind}/{$slug}";
@endphp

<x-layouts.app :title="$title">
    <x-site.header :active="$kind" />

    <div class="mx-auto max-w-screen-2xl px-4 py-6 lg:px-6"
        x-data="{
            tab: 'preview',
            w: '100%',
            copied: false,
            copy() { navigator.clipboard.writeText(this.$refs.code.innerText); this.copied = true; clearTimeout(this._t); this._t = setTimeout(() => this.copied = false, 1600); },
        }">

        {{-- Title row --}}
        <div class="mb-4 flex flex-wrap items-end justify-between gap-3">
            <div>
                <a href="/{{ $kind }}" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1 text-sm">
                    <x-lucide-chevron-left class="size-4" /> {{ $backLabel }}
                </a>
                <h1 class="mt-1 text-2xl font-bold tracking-tight">{{ $title }}</h1>
            </div>

            <div class="flex items-center gap-2">
                {{-- viewport sizes --}}
                <div class="bg-muted text-muted-foreground hidden items-center gap-0.5 rounded-md p-0.5 lg:flex" x-show="tab === 'preview'">
                    @foreach (['100%' => 'monitor', '768px' => 'tablet', '390px' => 'smartphone'] as $val => $icon)
                        <button type="button" @click="w = '{{ $val }}'"
                            :class="w === '{{ $val }}' ? 'bg-background text-foreground shadow-sm' : 'hover:text-foreground'"
                            class="inline-flex size-7 items-center justify-center rounded transition-colors">
                            <x-dynamic-component :component="'lucide-'.$icon" class="size-4" />
                        </button>
                    @endforeach
                </div>

                {{-- preview / code --}}
                <div class="bg-muted text-muted-foreground inline-flex items-center gap-0.5 rounded-md p-0.5">
                    <button type="button" @click="tab = 'preview'"
                        :class="tab === 'preview' ? 'bg-background text-foreground shadow-sm' : 'hover:text-foreground'"
                        class="rounded px-2.5 py-1 text-xs font-medium transition-colors">Preview</button>
                    <button type="button" @click="tab = 'code'"
                        :class="tab === 'code' ? 'bg-background text-foreground shadow-sm' : 'hover:text-foreground'"
                        class="rounded px-2.5 py-1 text-xs font-medium transition-colors">Code</button>
                </div>

                <a href="{{ $rawUrl }}" target="_blank" rel="noopener"
                    class="hover:bg-accent inline-flex size-8 items-center justify-center rounded-md border" title="Open in new tab">
                    <x-lucide-external-link class="size-4" />
                </a>
                <x-ui.button size="sm" variant="outline" @click="copy()">
                    <template x-if="!copied"><span class="inline-flex items-center gap-1.5"><x-lucide-copy class="size-3.5" /> Copy</span></template>
                    <template x-if="copied"><span class="inline-flex items-center gap-1.5 text-emerald-500"><x-lucide-check class="size-3.5" /> Copied</span></template>
                </x-ui.button>
            </div>
        </div>

        {{-- Preview (iframe-isolated so the block's full-page layout renders cleanly) --}}
        <div x-show="tab === 'preview'" class="bg-background overflow-hidden rounded-xl border">
            <div class="mx-auto transition-[width] duration-200 ease-out" :style="`width: ${w}; max-width: 100%`">
                <iframe src="{{ $rawUrl }}" title="{{ $title }} preview" loading="lazy"
                    class="h-[82vh] w-full bg-background"></iframe>
            </div>
        </div>

        {{-- Code --}}
        <div x-show="tab === 'code'" x-cloak class="max-h-[82vh] overflow-auto rounded-xl border bg-zinc-950 dark:bg-zinc-900">
            <pre class="p-4 text-[13px] leading-relaxed"><code x-ref="code" class="font-mono text-zinc-100">{{ $source }}</code></pre>
        </div>
    </div>
</x-layouts.app>
