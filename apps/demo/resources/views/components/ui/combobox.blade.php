@props([
    'name' => null,
    'options' => [],
    'value' => '',
    'placeholder' => null,        // translated trigger text; defaults via __() below (no hardcoded English)
    'searchPlaceholder' => null,
    'empty' => null,
    'width' => 'w-[200px]',
    'searchable' => true,         // false → a plain picker with no search box (button trigger only)
    'disabled' => false,
    'multiple' => false,          // true → pick many; selected render as removable chips, list stays open
    'trigger' => 'button',        // button → popover w/ search inside | input → the field IS the search box (autocomplete)
    'size' => 'default',          // sm | default | lg — input trigger only
    'icon' => null,               // optional leading lucide icon name (input trigger only, e.g. "search")
])

@php
    $trigger = in_array($trigger, ['button', 'input'], true) ? $trigger : 'button';
    $isInput = $trigger === 'input';

    // i18n-safe defaults: these are translation keys, localise them in your lang files.
    // The input trigger has a single visible placeholder (the search field itself); default it to "Search...".
    $placeholder ??= $isInput ? __('Search...') : __('Select option...');
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

    // Input trigger seeds the query with the selected label (single select) so the field shows it.
    // Guard the scalar cast: in multiple mode $value is an array.
    $selectedSingle = $multiple ? null : $opts->firstWhere('value', (string) $value);
    $initialQuery = ($isInput && ! $multiple) ? (string) ($selectedSingle['label'] ?? '') : '';

    $sizes = [
        'sm' => 'h-8 py-1 text-sm',
        'default' => 'h-9 py-2 text-sm',
        'lg' => 'h-10 py-2 text-base',
    ];
    $sizeCls = $sizes[$size] ?? $sizes['default'];
    $minH = ['sm' => 'min-h-8', 'default' => 'min-h-9', 'lg' => 'min-h-10'][$size] ?? 'min-h-9';

    // Livewire bridge — entangle the listbox value with a consumer's wire:model when present.
    // No-op (and stripped) without Livewire. blatListbox uses config.value verbatim (no coercion).
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) { $attributes = $attributes->whereDoesntStartWith('wire:model'); }
@endphp

<div
    data-slot="combobox"
    x-data="blatListbox({
        trigger: @js($trigger),
        multiple: @js((bool) $multiple),
        value: @if ($hasWire)@entangle($wireModel)@else @js($initialValue)@endif,
        query: @js($initialQuery),
        options: @js($opts),
    })"
    x-id="['blat-combobox-list', 'blat-combobox-opt']"
    @unless ($isInput) x-init="$watch('query', () => ensureActive())" @endunless
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

    @if ($isInput)
        {{-- Inline-input trigger (autocomplete shape): the field itself is the search box. --}}
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
                    :aria-controls="$id('blat-combobox-list')"
                    :aria-activedescendant="activeValue != null ? $id('blat-combobox-opt', activeValue) : null"
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
                    :aria-controls="$id('blat-combobox-list')"
                    :aria-activedescendant="activeValue != null ? $id('blat-combobox-opt', activeValue) : null"
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
    @else
        <button
            type="button"
            x-ref="trigger"
            @click="toggle()"
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
    @endif

    {{-- Teleported to <body> so the listbox is never clipped by an overflow-hidden ancestor. --}}
    <template x-teleport="body" wire:ignore>
    <div
        x-blat-dialog-layer
        x-show="open"
        x-cloak
        @if ($isInput)
            x-anchor.fixed.bottom-start.offset.4="$refs.control"
            @click.outside="open && !$refs.control.contains($event.target) && close()"
        @else
            x-anchor.fixed.bottom-start.offset.4="$refs.trigger"
            @click.outside="close(false)"
            @keydown.escape.prevent.stop="close()"
        @endif
        {{-- Panel matches the TRIGGER width (not the passed `$width` class — applying that to a
             body-teleported node made it the viewport width). Grows no narrower than the anchor. --}}
        x-bind:style="($refs.trigger || $refs.control) ? ('min-width:' + ($refs.trigger || $refs.control).offsetWidth + 'px') : ''"
        class="bg-popover text-popover-foreground z-50 w-fit origin-top overflow-hidden rounded-md border {{ $isInput ? 'p-1' : 'p-0' }} shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <div class="flex h-full w-full flex-col overflow-hidden rounded-md">
            @if (! $isInput && $searchable)
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
                @if (! $isInput && ! $searchable)
                    @keydown.down.prevent="move(1)"
                    @keydown.up.prevent="move(-1)"
                    @keydown.home.prevent="edge('first')"
                    @keydown.end.prevent="edge('last')"
                    @keydown.enter.prevent="selectActive()"
                @endif
                class="max-h-[300px] scroll-py-1 overflow-x-hidden overflow-y-auto {{ $isInput ? '' : 'p-1' }} outline-hidden"
            >
                <div x-show="visibleCount === 0" class="py-6 text-center text-sm">{{ $empty }}</div>
                <template x-for="option in options" :key="option.value">
                    <div
                        role="option"
                        :id="$id('blat-combobox-opt', option.value)"
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
    </div>
    </template>
</div>
