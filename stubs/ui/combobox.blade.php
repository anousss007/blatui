@props([
    'name' => null,
    'options' => [],
    'value' => '',
    'placeholder' => 'Select option...',
    'searchPlaceholder' => 'Search...',
    'empty' => 'No results found.',
    'width' => 'w-[200px]',
])

@php
    $opts = collect($options)->map(fn ($o) => is_array($o)
        ? ['value' => (string) ($o['value'] ?? ''), 'label' => (string) ($o['label'] ?? $o['value'] ?? '')]
        : ['value' => (string) $o, 'label' => (string) $o]
    )->values();
@endphp

<div
    data-slot="combobox"
    x-data="{
        open: false,
        value: @js((string) $value),
        query: '',
        options: @js($opts),
        get label() { const o = this.options.find(o => o.value === this.value); return o ? o.label : '' },
        matches(label) { return label.toLowerCase().includes(this.query.toLowerCase()) },
        get visibleCount() { return this.options.filter(o => this.matches(o.label)).length },
        select(v) { this.value = (this.value === v ? '' : v); this.open = false; this.query = '' }
    }"
    {{ $attributes->twMerge('relative '.$width) }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif

    <button
        type="button"
        x-ref="trigger"
        @click="open = !open"
        role="combobox"
        :aria-expanded="open"
        class="{{ $width }} border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 items-center justify-between gap-2 rounded-md border bg-transparent px-3 py-2 text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-transparent focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
    >
        <span x-text="label || @js($placeholder)" :class="{ 'text-muted-foreground': !label }"></span>
        <x-lucide-chevrons-up-down class="size-4 shrink-0 opacity-50" />
    </button>

    <div
        x-show="open"
        x-cloak
        x-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-trap="open"
        class="bg-popover text-popover-foreground z-50 {{ $width }} origin-top overflow-hidden rounded-md border p-0 shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <div class="flex h-full w-full flex-col overflow-hidden rounded-md">
            <div class="flex h-9 items-center gap-2 border-b px-3">
                <x-lucide-search class="size-4 shrink-0 opacity-50" />
                <input
                    x-model="query"
                    placeholder="{{ $searchPlaceholder }}"
                    class="placeholder:text-muted-foreground flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-hidden"
                >
            </div>
            <div class="max-h-[300px] scroll-py-1 overflow-x-hidden overflow-y-auto p-1">
                <div x-show="visibleCount === 0" class="py-6 text-center text-sm">{{ $empty }}</div>
                <template x-for="option in options" :key="option.value">
                    <div
                        role="option"
                        x-show="matches(option.label)"
                        @click="select(option.value)"
                        class="hover:bg-accent hover:text-accent-foreground relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none"
                    >
                        <x-lucide-check class="size-4" x-bind:class="value === option.value ? 'opacity-100' : 'opacity-0'" />
                        <span x-text="option.label"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
