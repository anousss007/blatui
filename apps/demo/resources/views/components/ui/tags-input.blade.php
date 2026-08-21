@props([
    'name' => null,
    'value' => [],
    'placeholder' => 'Add tag…',
    'max' => null,
    'disabled' => false,
    'id' => null,
])

@php
    // Livewire bridge — bind Alpine state to a consumer's wire:model when present. The property
    // path travels as a data attribute rather than baked into x-data (which Alpine evaluates once),
    // so a morph that re-points or re-mounts the component is followed. $blatModel reads and writes
    // the Livewire property directly; without Livewire it just holds the value locally, so the
    // component still works in plain Blade/Alpine. See the bridge in blatui-core.js.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) {
        $attributes = $attributes->whereDoesntStartWith('wire:model')->merge(array_filter([
            'data-blat-model' => $wireModel->value(),
            'data-blat-model-live' => $wireModel->hasModifier('live') ? '1' : null,
        ]));
    }
@endphp

<div
    data-slot="tags-input"
    x-data="{
        _model: $blatModel(@js(array_values((array) $value))),
        get tags() { return this._model.value; },
        set tags(v) { this._model.value = v; },
        draft: '',
        max: @js($max !== null ? (int) $max : null),
        disabled: @js((bool) $disabled),
        get atMax() { return this.max !== null && this.tags.length >= this.max; },
        get inputDisabled() { return this.disabled || this.atMax; },
        // Each edit replaces the array rather than mutating it in place: `tags` is the bound
        // Livewire property itself, and a push() nobody assigned is a change wire:model.live
        // never hears about.
        add() {
            const t = this.draft.trim();
            this.draft = '';
            if (!t || this.atMax) return;
            if (this.tags.includes(t)) return;
            this.tags = [...this.tags, t];
        },
        remove(i) {
            if (this.disabled) return;
            this.tags = this.tags.filter((_, index) => index !== i);
        },
        backspace() {
            if (this.disabled) return;
            if (this.draft === '' && this.tags.length) this.tags = this.tags.slice(0, -1);
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
