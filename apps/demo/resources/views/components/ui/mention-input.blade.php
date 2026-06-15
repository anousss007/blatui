@props([
    'name' => null,
    'mentions' => [],
    'trigger' => '@',
    'placeholder' => 'Type @ to mention…',
    'rows' => 3,
    'id' => null,
])

@php
    // Normalise mentions → [value, label, avatar?, sub?]. Accepts plain strings or assoc arrays.
    $items = collect($mentions)->map(function ($m) {
        if (is_array($m)) {
            return [
                'value' => (string) ($m['value'] ?? $m['label'] ?? ''),
                'label' => (string) ($m['label'] ?? $m['value'] ?? ''),
                'avatar' => isset($m['avatar']) ? (string) $m['avatar'] : null,
                'sub' => isset($m['sub']) ? (string) $m['sub'] : null,
            ];
        }
        return ['value' => (string) $m, 'label' => (string) $m, 'avatar' => null, 'sub' => null];
    })->values();

    $fieldId = $id ?? 'blat-mention-'.\Illuminate\Support\Str::random(6);
    // Initial value drives the textarea contents; supports a prefilled value via the `value` attribute.
    $initial = (string) ($attributes->get('value') ?? $slot ?? '');
    $attributes = $attributes->except('value');
@endphp

<div
    data-slot="mention-input"
    x-data="{
        trigger: @js((string) $trigger),
        mentions: @js($items),
        open: false,
        query: '',
        activeIndex: 0,
        // Caret position where the current trigger word begins (the index of the trigger char).
        anchor: -1,
        get matches() {
            const q = this.query.toLowerCase();
            return this.mentions.filter(m => m.label.toLowerCase().includes(q) || m.value.toLowerCase().includes(q));
        },
        get activeId() {
            const m = this.matches[this.activeIndex];
            return m ? this.$id('blat-mention-opt', m.value) : null;
        },
        // Inspect the word immediately before the caret; open the popup when it starts with the trigger.
        scan() {
            const el = this.$refs.field;
            const pos = el.selectionStart;
            const text = el.value.slice(0, pos);
            const idx = text.lastIndexOf(this.trigger);
            if (idx === -1) { this.close(); return; }
            // The char before the trigger must be whitespace or start-of-text (so emails aren't caught).
            const before = idx === 0 ? '' : text[idx - 1];
            if (before && !/\s/.test(before)) { this.close(); return; }
            const word = text.slice(idx + this.trigger.length);
            // No whitespace allowed inside the active query.
            if (/\s/.test(word)) { this.close(); return; }
            this.anchor = idx;
            this.query = word;
            this.activeIndex = 0;
            this.open = this.matches.length > 0;
        },
        move(dir) {
            const n = this.matches.length;
            if (!n) return;
            this.activeIndex = (this.activeIndex + dir + n) % n;
            this.$nextTick(() => this.scrollActive());
        },
        scrollActive() {
            const opt = this.$refs.list?.querySelector('[data-active=\'true\']');
            opt?.scrollIntoView({ block: 'nearest' });
        },
        insertActive() {
            const m = this.matches[this.activeIndex];
            if (!m) return false;
            const el = this.$refs.field;
            const pos = el.selectionStart;
            const head = el.value.slice(0, this.anchor);
            const tail = el.value.slice(pos);
            const inserted = this.trigger + m.value + ' ';
            el.value = head + inserted + tail;
            const caret = (head + inserted).length;
            el.setSelectionRange(caret, caret);
            el.dispatchEvent(new Event('input', { bubbles: true }));
            this.close();
            this.$nextTick(() => el.focus());
            return true;
        },
        close() { this.open = false; this.query = ''; this.anchor = -1; this.activeIndex = 0; },
    }"
    x-id="['blat-mention-list', 'blat-mention-opt']"
    {{ $attributes->twMerge('relative w-full') }}
>
    <textarea
        x-ref="field"
        data-slot="mention-input-field"
        id="{{ $fieldId }}"
        @if ($name) name="{{ $name }}" @endif
        rows="{{ (int) $rows }}"
        placeholder="{{ $placeholder }}"
        role="combobox"
        aria-label="{{ $name ? $name : __('Mention input') }}"
        aria-autocomplete="list"
        :aria-expanded="open"
        :aria-controls="open ? $id('blat-mention-list') : null"
        :aria-activedescendant="open ? activeId : null"
        @input="scan()"
        @click="scan()"
        @keyup.arrow-left="scan()"
        @keyup.arrow-right="scan()"
        @keydown.arrow-down="if (open) { $event.preventDefault(); move(1); }"
        @keydown.arrow-up="if (open) { $event.preventDefault(); move(-1); }"
        @keydown.enter="if (open && insertActive()) $event.preventDefault();"
        @keydown.tab="if (open && insertActive()) $event.preventDefault();"
        @keydown.escape="if (open) { $event.preventDefault(); $event.stopPropagation(); close(); }"
        @blur="close()"
        class="border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 dark:bg-input/30 flex field-sizing-content min-h-16 w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
    >{{ $initial }}</textarea>

    {{-- Suggestion popup. Sits below the field; the textarea keeps focus (combobox pattern). --}}
    <div
        x-show="open"
        x-cloak
        @mousedown.prevent
        :id="$id('blat-mention-list')"
        role="listbox"
        aria-label="{{ __('Mention suggestions') }}"
        class="bg-popover text-popover-foreground absolute start-0 top-full z-50 mt-1 max-h-60 w-64 max-w-full overflow-y-auto rounded-md border p-1 shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <template x-for="(m, i) in matches" :key="m.value">
            <div
                role="option"
                :id="$id('blat-mention-opt', m.value)"
                :aria-selected="i === activeIndex"
                :data-active="i === activeIndex"
                @click="activeIndex = i; insertActive()"
                @mouseenter="activeIndex = i"
                class="data-[active=true]:bg-accent data-[active=true]:text-accent-foreground relative flex cursor-default items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden select-none"
            >
                <template x-if="m.avatar">
                    <img :src="m.avatar" :alt="''" aria-hidden="true" class="size-6 shrink-0 rounded-full object-cover" />
                </template>
                <template x-if="!m.avatar">
                    <span class="bg-muted text-muted-foreground flex size-6 shrink-0 items-center justify-center rounded-full text-xs font-medium" aria-hidden="true" x-text="m.label.slice(0, 1).toUpperCase()"></span>
                </template>
                <span class="flex min-w-0 flex-col">
                    <span class="truncate font-medium" x-text="m.label"></span>
                    <span x-show="m.sub" class="text-muted-foreground truncate text-xs" x-text="m.sub"></span>
                </span>
            </div>
        </template>
    </div>
</div>
