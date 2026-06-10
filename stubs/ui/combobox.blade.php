@props([
    'name' => null,
    'options' => [],
    'value' => '',
    'placeholder' => null,        // translated trigger text; defaults via __() below (no hardcoded English)
    'searchPlaceholder' => null,
    'empty' => null,
    'width' => 'w-[200px]',
    'searchable' => true,         // false → a plain picker with no search box
    'disabled' => false,
    'multiple' => false,          // true → pick many; selected render as removable chips, list stays open
])

@php
    // i18n-safe defaults: these are translation keys, localise them in your lang files.
    $placeholder ??= __('Select option...');
    $searchPlaceholder ??= __('Search...');
    $empty ??= __('No results found.');

    $opts = collect($options)->map(fn ($o) => is_array($o)
        ? ['value' => (string) ($o['value'] ?? ''), 'label' => (string) ($o['label'] ?? $o['value'] ?? '')]
        : ['value' => (string) $o, 'label' => (string) $o]
    )->values();

    // Multiple seeds an array of values; single keeps the scalar string.
    $initialValue = $multiple
        ? collect(is_array($value) ? $value : (($value === '' || $value === null) ? [] : [$value]))->map(fn ($v) => (string) $v)->values()
        : (string) $value;
@endphp

<div
    data-slot="combobox"
    x-data="{
        open: false,
        multiple: @js((bool) $multiple),
        value: @js($initialValue),
        query: '',
        activeValue: null,
        options: @js($opts),
        isSelected(v) { return this.multiple ? this.value.includes(v) : this.value === v },
        get selected() { return this.options.filter(o => this.isSelected(o.value)) },
        get label() { const o = this.options.find(o => o.value === this.value); return o ? o.label : '' },
        matches(label) { return label.toLowerCase().includes(this.query.toLowerCase()) },
        get visible() { return this.options.filter(o => this.matches(o.label)) },
        get visibleCount() { return this.visible.length },
        ensureActive() {
            const v = this.visible;
            if (!v.length) { this.activeValue = null; return }
            if (!v.some(o => o.value === this.activeValue)) this.activeValue = (v.find(o => this.isSelected(o.value)) || v[0]).value;
        },
        openList() { this.open = true; this.query = ''; this.$nextTick(() => { this.ensureActive(); (this.$refs.search || this.$refs.list)?.focus() }) },
        close(returnFocus = true) { if (!this.open) return; this.open = false; if (returnFocus) this.$nextTick(() => this.$refs.trigger?.focus()) },
        move(dir) { const v = this.visible; if (!v.length) return; let i = v.findIndex(o => o.value === this.activeValue); i = i < 0 ? 0 : (i + dir + v.length) % v.length; this.activeValue = v[i].value },
        edge(pos) { const v = this.visible; if (!v.length) return; this.activeValue = (pos === 'last' ? v[v.length - 1] : v[0]).value },
        selectActive() { if (this.activeValue != null) this.select(this.activeValue) },
        select(v) {
            if (this.multiple) {
                const i = this.value.indexOf(v);
                if (i === -1) this.value.push(v); else this.value.splice(i, 1);
                return; // keep the list open for further picks
            }
            this.value = (this.value === v ? '' : v); this.close(); this.query = '';
        },
        remove(v) { const i = this.value.indexOf(v); if (i !== -1) this.value.splice(i, 1) }
    }"
    x-id="['blat-combobox-list', 'blat-combobox-opt']"
    x-init="$watch('query', () => ensureActive())"
    {{ $attributes->twMerge('relative '.$width) }}
>
    @if ($name)
        @if ($multiple)
            <template x-for="v in value" :key="v">
                <input type="hidden" name="{{ $name }}[]" :value="v">
            </template>
        @else
            <input type="hidden" name="{{ $name }}" :value="value">
        @endif
    @endif

    <button
        type="button"
        x-ref="trigger"
        @click="open ? close(false) : openList()"
        @keydown.down.prevent.stop="openList()"
        @keydown.up.prevent.stop="openList()"
        @keydown.enter.prevent.stop="openList()"
        @keydown.space.prevent.stop="openList()"
        role="combobox"
        aria-haspopup="listbox"
        aria-label="{{ $placeholder }}"
        :aria-expanded="open"
        :aria-controls="$id('blat-combobox-list')"
        @disabled($disabled)
        class="{{ $width }} border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex min-h-9 items-center justify-between gap-2 rounded-md border bg-transparent px-3 py-1.5 text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-transparent focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50"
    >
        {{-- single-select label --}}
        <span x-show="!multiple" x-text="label || @js($placeholder)" :class="{ 'text-muted-foreground': !label }"></span>

        {{-- multi-select: placeholder when empty, else removable chips --}}
        <span x-show="multiple && !selected.length" class="text-muted-foreground">{{ $placeholder }}</span>
        <span x-show="multiple && selected.length" class="flex flex-1 flex-wrap items-center gap-1">
            <template x-for="o in selected" :key="o.value">
                <span class="bg-secondary text-secondary-foreground inline-flex items-center gap-1 rounded px-1.5 py-0.5 text-xs font-medium">
                    <span x-text="o.label"></span>
                    <span role="button" tabindex="-1" :aria-label="'Remove ' + o.label" @click.stop.prevent="remove(o.value)"
                        class="hover:text-foreground/70 inline-flex cursor-pointer items-center rounded-sm outline-none">
                        <x-lucide-x class="size-3" aria-hidden="true" />
                    </span>
                </span>
            </template>
        </span>

        <x-lucide-chevrons-up-down class="size-4 shrink-0 self-center opacity-50" aria-hidden="true" />
    </button>

    {{-- Teleported to <body> so the listbox is never clipped by an overflow-hidden ancestor. --}}
    <template x-teleport="body">
    <div
        x-show="open"
        x-cloak
        x-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="close(false)"
        @keydown.escape.prevent.stop="close()"
        {{-- Panel matches the TRIGGER width (not the passed `$width` class — applying that to a
             body-teleported node made it the viewport width). Grows no narrower than the trigger. --}}
        x-bind:style="$refs.trigger ? ('min-width:' + $refs.trigger.offsetWidth + 'px') : ''"
        class="bg-popover text-popover-foreground z-50 w-fit origin-top overflow-hidden rounded-md border p-0 shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <div class="flex h-full w-full flex-col overflow-hidden rounded-md">
            @if ($searchable)
            <div class="flex h-9 items-center gap-2 border-b px-3">
                <x-lucide-search class="size-4 shrink-0 opacity-50" aria-hidden="true" />
                <input
                    x-ref="search"
                    x-model="query"
                    type="text"
                    role="combobox"
                    aria-expanded="true"
                    aria-autocomplete="list"
                    autocomplete="off"
                    aria-label="{{ $searchPlaceholder }}"
                    :aria-controls="$id('blat-combobox-list')"
                    :aria-activedescendant="activeValue != null ? $id('blat-combobox-opt', activeValue) : null"
                    @keydown.down.prevent="move(1)"
                    @keydown.up.prevent="move(-1)"
                    @keydown.home.prevent="edge('first')"
                    @keydown.end.prevent="edge('last')"
                    @keydown.enter.prevent="selectActive()"
                    placeholder="{{ $searchPlaceholder }}"
                    class="placeholder:text-muted-foreground flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-hidden"
                >
            </div>
            @endif
            <div
                role="listbox"
                x-ref="list"
                tabindex="-1"
                :aria-multiselectable="multiple"
                :id="$id('blat-combobox-list')"
                @if (! $searchable)
                    @keydown.down.prevent="move(1)"
                    @keydown.up.prevent="move(-1)"
                    @keydown.home.prevent="edge('first')"
                    @keydown.end.prevent="edge('last')"
                    @keydown.enter.prevent="selectActive()"
                @endif
                class="max-h-[300px] scroll-py-1 overflow-x-hidden overflow-y-auto p-1 outline-hidden"
            >
                <div x-show="visibleCount === 0" class="py-6 text-center text-sm">{{ $empty }}</div>
                <template x-for="option in options" :key="option.value">
                    <div
                        role="option"
                        :id="$id('blat-combobox-opt', option.value)"
                        x-show="matches(option.label)"
                        @click="select(option.value)"
                        @mouseenter="activeValue = option.value"
                        :aria-selected="isSelected(option.value)"
                        :data-active="activeValue === option.value"
                        class="data-[active=true]:bg-accent data-[active=true]:text-accent-foreground relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none"
                    >
                        <x-lucide-check class="size-4" x-bind:class="isSelected(option.value) ? 'opacity-100' : 'opacity-0'" aria-hidden="true" />
                        <span x-text="option.label"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>
    </template>
</div>
