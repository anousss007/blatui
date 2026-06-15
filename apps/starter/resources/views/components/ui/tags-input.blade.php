@props([
    'name' => null,
    'value' => [],
    'placeholder' => 'Add tag…',
    'max' => null,
    'disabled' => false,
    'id' => null,
])

<div
    data-slot="tags-input"
    x-data="{
        tags: @js(array_values((array) $value)),
        draft: '',
        max: @js($max !== null ? (int) $max : null),
        disabled: @js((bool) $disabled),
        get atMax() { return this.max !== null && this.tags.length >= this.max; },
        get inputDisabled() { return this.disabled || this.atMax; },
        add() {
            const t = this.draft.trim();
            this.draft = '';
            if (!t || this.atMax) return;
            if (this.tags.includes(t)) return;
            this.tags.push(t);
        },
        remove(i) {
            if (this.disabled) return;
            this.tags.splice(i, 1);
        },
        backspace() {
            if (this.disabled) return;
            if (this.draft === '' && this.tags.length) this.tags.pop();
        },
    }"
    @click="!disabled && $refs.field && $refs.field.focus()"
    @if ($disabled) aria-disabled="true" @endif
    {{ $attributes->twMerge('border-input dark:bg-input/30 flex min-h-9 w-full flex-wrap items-center gap-1.5 rounded-md border bg-transparent p-1.5 text-sm shadow-xs transition-[color,box-shadow] focus-within:border-ring focus-within:ring-ring/50 focus-within:ring-[3px] has-[input:disabled]:pointer-events-none has-[input:disabled]:cursor-not-allowed has-[input:disabled]:opacity-50') }}
>
    @if ($name)
        <template x-for="tag in tags" :key="tag">
            <input type="hidden" name="{{ $name }}[]" :value="tag">
        </template>
    @endif

    <template x-for="(tag, i) in tags" :key="tag">
        <span data-slot="tags-input-item" class="bg-secondary text-secondary-foreground inline-flex items-center gap-1 rounded px-2 py-0.5 text-sm">
            <span x-text="tag"></span>
            <button
                type="button"
                x-show="!disabled"
                @click.stop="remove(i)"
                :aria-label="'Remove ' + tag"
                class="hover:text-secondary-foreground/70 -me-0.5 inline-flex cursor-pointer items-center rounded-sm outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]"
            >
                <x-lucide-x class="size-3.5" aria-hidden="true" />
            </button>
        </span>
    </template>

    <input
        type="text"
        x-ref="field"
        x-model="draft"
        @if ($id) id="{{ $id }}" @endif
        placeholder="{{ $placeholder }}"
        :disabled="inputDisabled"
        @keydown.enter.prevent="add()"
        @keydown="if ($event.key === ',') { $event.preventDefault(); add(); }"
        @keydown.backspace="backspace()"
        @blur="add()"
        class="text-foreground placeholder:text-muted-foreground flex-1 bg-transparent px-1 py-0.5 text-sm outline-none disabled:cursor-not-allowed"
    />
</div>
