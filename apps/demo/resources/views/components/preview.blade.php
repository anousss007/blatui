@props([
    'file',
    'previewClass' => 'min-h-[350px]',
])

@php
    $path = resource_path('views/examples/'.str_replace('.', '/', $file).'.blade.php');
    $source = is_file($path) ? rtrim(file_get_contents($path)) : "{{-- example not found: {$file} --}}";
@endphp

<div
    x-data="{ tab: 'preview', copied: false, copy() { navigator.clipboard.writeText(this.$refs.code.innerText); this.copied = true; clearTimeout(this._t); this._t = setTimeout(() => this.copied = false, 1600); } }"
    {{ $attributes->twMerge('not-prose group/preview my-6 overflow-hidden rounded-xl border') }}
>
    {{-- Toolbar --}}
    <div class="bg-muted/40 flex items-center justify-between border-b px-2 py-1.5">
        <div class="bg-muted text-muted-foreground inline-flex items-center gap-1 rounded-md p-0.5">
            <button type="button" @click="tab = 'preview'"
                :class="tab === 'preview' ? 'bg-background text-foreground shadow-sm' : 'hover:text-foreground'"
                class="rounded px-2.5 py-1 text-xs font-medium transition-colors">Preview</button>
            <button type="button" @click="tab = 'code'"
                :class="tab === 'code' ? 'bg-background text-foreground shadow-sm' : 'hover:text-foreground'"
                class="rounded px-2.5 py-1 text-xs font-medium transition-colors">Code</button>
        </div>
        <button type="button" @click="copy()"
            class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1.5 rounded-md px-2 py-1 text-xs font-medium transition-colors">
            <template x-if="!copied"><span class="inline-flex items-center gap-1.5"><x-lucide-copy class="size-3.5" /> Copy</span></template>
            <template x-if="copied"><span class="inline-flex items-center gap-1.5 text-emerald-500"><x-lucide-check class="size-3.5" /> Copied</span></template>
        </button>
    </div>

    {{-- Preview pane --}}
    <div x-show="tab === 'preview'"
        class="bg-background flex {{ $previewClass }} items-center justify-center p-10">
        @include('examples.'.$file)
    </div>

    {{-- Code pane --}}
    <div x-show="tab === 'code'" x-cloak class="relative max-h-[600px] overflow-auto bg-zinc-950 dark:bg-zinc-900">
        <pre class="p-4 text-[13px] leading-relaxed"><code x-ref="code" class="font-mono text-zinc-100">{{ $source }}</code></pre>
    </div>
</div>
