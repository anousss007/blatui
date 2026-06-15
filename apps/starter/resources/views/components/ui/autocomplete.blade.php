@props([
    'name' => null,
    'options' => [],
    'value' => '',
    'placeholder' => 'Search...',
    'empty' => 'No results found.',
    'size' => 'default',   // sm | default | lg
    'disabled' => false,
    'multiple' => false,   // true → tag input: selected render as removable chips, list stays open
    'icon' => null,        // optional lucide icon name (e.g. "search") for a leading icon
    'width' => 'w-[260px]',
])

@php
    $opts = collect($options)->map(fn ($o) => is_array($o)
        ? ['value' => (string) ($o['value'] ?? ''), 'label' => (string) ($o['label'] ?? $o['value'] ?? '')]
        : ['value' => (string) $o, 'label' => (string) $o]
    )->values();

    $selected = $multiple ? null : $opts->firstWhere('value', (string) $value);

    $initialValue = $multiple
        ? collect(is_array($value) ? $value : (($value === '' || $value === null) ? [] : [$value]))->map(fn ($v) => (string) $v)->values()
        : (string) $value;

    $sizes = [
        'sm' => 'h-8 py-1 text-sm',
        'default' => 'h-9 py-2 text-sm',
        'lg' => 'h-10 py-2 text-base',
    ];
    $sizeCls = $sizes[$size] ?? $sizes['default'];
    $minH = ['sm' => 'min-h-8', 'default' => 'min-h-9', 'lg' => 'min-h-10'][$size] ?? 'min-h-9';
@endphp

<div
    data-slot="autocomplete"
    x-data="{
        open: false,
        filtering: false,
        multiple: @js((bool) $multiple),
        value: @js($initialValue),
        query: @js($multiple ? '' : ($selected['label'] ?? '')),
        activeValue: null,
        options: @js($opts),
        isSelected(v) { return this.multiple ? this.value.includes(v) : this.value === v },
        get selected() { return this.options.filter(o => this.isSelected(o.value)) },
        matches(label) { return label.toLowerCase().includes(this.query.toLowerCase()) },
        get visible() { return this.filtering ? this.options.filter(o => this.matches(o.label)) : this.options },
        get visibleCount() { return this.visible.length },
        ensureActive() {
            const v = this.visible;
            if (!v.length) { this.activeValue = null; return }
            if (!v.some(o => o.value === this.activeValue)) this.activeValue = (v.find(o => this.isSelected(o.value)) || v[0]).value;
        },
        openList() { this.open = true; this.filtering = false; this.$nextTick(() => this.ensureActive()) },
        close() { this.open = false; this.filtering = false; },
        onInput() { if (!this.multiple) this.value = ''; this.open = true; this.filtering = true; this.$nextTick(() => this.ensureActive()) },
        move(dir) { if (!this.open) { this.openList(); return } const v = this.visible; if (!v.length) return; let i = v.findIndex(o => o.value === this.activeValue); i = i < 0 ? 0 : (i + dir + v.length) % v.length; this.activeValue = v[i].value },
        selectActive() { if (this.activeValue != null) this.select(this.activeValue) },
        select(v) {
            if (this.multiple) {
                const i = this.value.indexOf(v);
                if (i === -1) this.value.push(v); else this.value.splice(i, 1);
                this.query = ''; this.filtering = false;
                this.$nextTick(() => this.$refs.input?.focus());
                return; // keep the list open for further picks
            }
            const o = this.options.find(x => x.value === v); if (o) { this.value = o.value; this.query = o.label; } this.close();
        },
        remove(v) { const i = this.value.indexOf(v); if (i !== -1) this.value.splice(i, 1) },
        backspace() { if (this.multiple && this.query === '' && this.value.length) this.value.splice(this.value.length - 1, 1) }
    }"
    x-id="['blat-autocomplete-list', 'blat-autocomplete-opt']"
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

    @if ($multiple)
        {{-- Tag input: bordered box wrapping chips + a growing search field. --}}
        <div
            x-ref="control"
            @click="!$refs.input.contains($event.target) && $refs.input.focus()"
            class="border-input dark:bg-input/30 {{ $minH }} flex w-full flex-wrap items-center gap-1 rounded-md border bg-transparent px-2 py-1 shadow-xs transition-[color,box-shadow] focus-within:border-ring focus-within:ring-ring/50 focus-within:ring-[3px] {{ $disabled ? 'pointer-events-none opacity-50' : '' }}"
        >
            @if ($icon)
                <x-dynamic-component :component="'lucide-'.$icon" class="text-muted-foreground pointer-events-none ml-1 size-4 shrink-0" aria-hidden="true" />
            @endif
            <template x-for="o in selected" :key="o.value">
                <span class="bg-secondary text-secondary-foreground inline-flex items-center gap-1 rounded px-1.5 py-0.5 text-xs font-medium">
                    <span x-text="o.label"></span>
                    <span role="button" tabindex="-1" :aria-label="'Remove ' + o.label" @click.stop.prevent="remove(o.value)"
                        class="hover:text-foreground/70 inline-flex cursor-pointer items-center rounded-sm outline-none">
                        <x-lucide-x class="size-3" aria-hidden="true" />
                    </span>
                </span>
            </template>
            <input
                x-ref="input"
                x-model="query"
                type="text"
                role="combobox"
                aria-autocomplete="list"
                autocomplete="off"
                :aria-expanded="open"
                :aria-controls="$id('blat-autocomplete-list')"
                :aria-activedescendant="activeValue != null ? $id('blat-autocomplete-opt', activeValue) : null"
                @focus="openList()"
                @click="openList()"
                @input="onInput()"
                @keydown.down.prevent="move(1)"
                @keydown.up.prevent="move(-1)"
                @keydown.enter.prevent="selectActive()"
                @keydown.escape.prevent.stop="close()"
                @keydown.backspace="backspace()"
                placeholder="{{ $placeholder }}"
                @disabled($disabled)
                class="placeholder:text-muted-foreground min-w-[6rem] flex-1 bg-transparent text-sm outline-none disabled:cursor-not-allowed"
            >
            <x-lucide-chevron-down
                class="text-muted-foreground pointer-events-none ml-auto size-4 shrink-0 self-center opacity-50 transition-transform"
                ::class="open && 'rotate-180'"
                aria-hidden="true"
            />
        </div>
    @else
        <div class="relative">
            @if ($icon)
                <x-dynamic-component :component="'lucide-'.$icon" class="text-muted-foreground pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2" aria-hidden="true" />
            @endif
            <input
                x-ref="control"
                x-model="query"
                type="text"
                role="combobox"
                aria-autocomplete="list"
                autocomplete="off"
                :aria-expanded="open"
                :aria-controls="$id('blat-autocomplete-list')"
                :aria-activedescendant="activeValue != null ? $id('blat-autocomplete-opt', activeValue) : null"
                @focus="openList()"
                @click="openList()"
                @input="onInput()"
                @keydown.down.prevent="move(1)"
                @keydown.up.prevent="move(-1)"
                @keydown.enter.prevent="selectActive()"
                @keydown.escape.prevent.stop="close()"
                placeholder="{{ $placeholder }}"
                @disabled($disabled)
                class="border-input dark:bg-input/30 placeholder:text-muted-foreground flex w-full rounded-md border bg-transparent pr-9 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 {{ $icon ? 'pl-9' : 'pl-3' }} {{ $sizeCls }}"
            >
            <x-lucide-chevron-down
                class="text-muted-foreground pointer-events-none absolute top-1/2 right-3 size-4 -translate-y-1/2 opacity-50 transition-transform"
                ::class="open && 'rotate-180'"
                aria-hidden="true"
            />
        </div>
    @endif

    {{-- Teleported to <body> so the list is never clipped by an overflow-hidden ancestor. --}}
    <template x-teleport="body">
        <div
            x-show="open"
            x-cloak
            x-anchor.bottom-start.offset.4="$refs.control"
            @click.outside="open && !$refs.control.contains($event.target) && close()"
            class="bg-popover text-popover-foreground z-50 {{ $width }} origin-top overflow-hidden rounded-md border p-1 shadow-md"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
        >
            <div role="listbox" :id="$id('blat-autocomplete-list')" :aria-multiselectable="multiple" class="max-h-[300px] scroll-py-1 overflow-x-hidden overflow-y-auto">
                <div x-show="visibleCount === 0" class="py-6 text-center text-sm">{{ $empty }}</div>
                <template x-for="option in options" :key="option.value">
                    <div
                        role="option"
                        :id="$id('blat-autocomplete-opt', option.value)"
                        x-show="visible.some(o => o.value === option.value)"
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
    </template>
</div>
