@props([
    'label' => null,   // e.g. "Terminal", "resources/css/app.css"
    'icon' => null,    // lucide name for the label
])

<div
    x-data="{ copied: false, copy() { navigator.clipboard.writeText(this.$refs.code.innerText.trim()); this.copied = true; clearTimeout(this._t); this._t = setTimeout(() => this.copied = false, 1600); } }"
    {{ $attributes->twMerge('group/code relative overflow-hidden rounded-xl border bg-zinc-950 dark:bg-zinc-900/80') }}
>
    @if ($label)
        <div class="flex items-center justify-between border-b border-white/10 px-4 py-2">
            <span class="inline-flex items-center gap-1.5 font-mono text-xs text-zinc-400">
                @if ($icon)<x-dynamic-component :component="'lucide-'.$icon" class="size-3.5" />@endif
                {{ $label }}
            </span>
            <button type="button" @click="copy()" class="inline-flex items-center gap-1.5 rounded-md px-1.5 py-0.5 text-xs text-zinc-400 transition-colors hover:text-zinc-100">
                <template x-if="!copied"><span class="inline-flex items-center gap-1.5"><x-lucide-copy class="size-3.5" /> Copy</span></template>
                <template x-if="copied"><span class="inline-flex items-center gap-1.5 text-emerald-400"><x-lucide-check class="size-3.5" /> Copied</span></template>
            </button>
        </div>
    @else
        <button type="button" @click="copy()" class="absolute right-2 top-2 z-10 inline-flex size-7 items-center justify-center rounded-md text-zinc-400 opacity-0 transition-all hover:bg-white/10 hover:text-zinc-100 group-hover/code:opacity-100">
            <x-lucide-copy class="size-3.5" x-show="!copied" />
            <x-lucide-check class="size-3.5 text-emerald-400" x-show="copied" x-cloak />
        </button>
    @endif
    {{-- Slot is raw so HTML-entity-encoded snippets (e.g. &lt;x-ui.card&gt;) display as
         literal tags instead of being parsed by Blade. Pass markup HTML-escaped. --}}
    <pre class="overflow-x-auto p-4 text-[13px] leading-relaxed"><code x-ref="code" class="font-mono text-zinc-100">{!! trim($slot) !!}</code></pre>
</div>
