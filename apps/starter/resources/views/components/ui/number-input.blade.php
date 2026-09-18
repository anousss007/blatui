@props([
    'name' => null,
    'value' => 0,
    'min' => null,
    'max' => null,
    'step' => 1,
    'decimals' => null,
    'nullable' => true,
    'size' => 'default',
    'disabled' => false,
    'id' => null,
    'placeholder' => null,
])

@php
    // Field height + text size mirror the input component so a number-input lines up
    // with sibling fields in a form.
    $sizes = [
        'sm' => 'h-8 text-sm',
        'default' => 'h-9 text-base md:text-sm',
        'lg' => 'h-10 text-base',
    ];
    $field = $sizes[$size] ?? $sizes['default'];

    // Square stepper buttons sized to the control height (the field is h-8/9/10).
    $btnSizes = [
        'sm' => 'w-8 [&_svg]:size-3.5',
        'default' => 'w-9 [&_svg]:size-4',
        'lg' => 'w-10 [&_svg]:size-4',
    ];
    $btn = $btnSizes[$size] ?? $btnSizes['default'];

    // The spinbutton (not the wrapper) must carry the accessible name. Route any
    // author-supplied aria-label / aria-labelledby onto the <input>, falling back
    // to the field name then a generic label, so the control is never unnamed.
    $ariaLabel = $attributes->get('aria-label');
    $ariaLabelledby = $attributes->get('aria-labelledby');
    $attributes = $attributes->except(['aria-label', 'aria-labelledby']);
    $inputLabel = $ariaLabel ?? $name;

    // Livewire bridge — bind to a consumer's wire:model when present. The property path travels
    // as a data attribute instead of being baked into x-data (which Alpine evaluates once), so a
    // morph that re-points or re-mounts the component is followed. $blatModel reads and writes
    // the Livewire property directly — see the bridge in blatui-core.js.
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
    data-slot="number-input"
    x-data="{
        _model: $blatModel(@js($value === null || $value === '' ? null : (float) $value)),
        get value() { return this._model.value; },
        set value(v) { this._model.value = v; },
        min: @js($min === null ? null : (float) $min),
        max: @js($max === null ? null : (float) $max),
        step: @js((float) $step),
        disabled: @js((bool) $disabled),
        decimals: @js($decimals === null || $decimals === '' ? null : max(0, min(15, (int) $decimals))),
        nullable: @js((bool) $nullable),
        clamp(v) {
            if (v === null || isNaN(v)) return v;
            if (this.min !== null && v < this.min) v = this.min;
            if (this.max !== null && v > this.max) v = this.max;
            return v;
        },
        // Stepping goes through $blatNumber so eight clicks of +0.1 from 1.1 land on 1.9 rather
        // than 1.3666…, and so a hand-typed 1.32 stepped by 1 becomes 2.32 rather than 2 — the
        // precision that survives is the one the value and the step imply, not the step alone.
        inc() {
            if (this.disabled || this.atMax) return;
            this.draft = null;
            this.value = this.clamp(this.snapped(this.$blatNumber.step(this.value ?? this.min ?? 0, this.step, this.step)));
        },
        dec() {
            if (this.disabled || this.atMin) return;
            this.draft = null;
            this.value = this.clamp(this.snapped(this.$blatNumber.step(this.value ?? this.max ?? 0, -this.step, this.step)));
        },
        snapped(v) { return this.decimals === null ? v : this.$blatNumber.round(v, this.decimals); },
        // What the field shows. While it has focus that is the text as typed — a draft that is
        // never reformatted under the caret, so 1.90 stays 1.90 and an empty field stays empty
        // instead of being reported as a value. Otherwise it is the value, at `decimals` places.
        draft: null,
        get text() { return this.draft ?? this.format(this.value); },
        format(v) {
            if (v === null || v === undefined || v === '' || !isFinite(v)) return '';
            return this.decimals === null ? String(v) : Number(v).toFixed(this.decimals);
        },
        // A comma is accepted as the decimal separator: inputmode=decimal puts one on the keypad
        // in most of the locales that write numbers that way.
        parse(raw) {
            const s = String(raw).trim().replace(',', '.');
            if (s === '' || !/^[-+]?(\d+\.?\d*|\.\d+)$/.test(s)) return null;
            const n = Number(s);
            return this.decimals === null ? n : this.$blatNumber.round(n, this.decimals);
        },
        onFocus(e) { this.draft = e.target.value; },
        // Only a number is ever written while typing. An empty field, or a half-typed '-', is a
        // draft on the way to one — selecting 25.50 and typing 30 passes through an empty field,
        // and sending that as null is what unset a non-nullable property under wire:model.live
        // (issue #31). What the field ends up holding is decided on blur.
        onInput(e) {
            this.draft = e.target.value;
            const n = this.parse(this.draft);
            if (n !== null && n !== this.value) this.value = n;
        },
        onBlur(e) {
            const raw = this.draft ?? e.target.value;
            this.draft = null;
            const n = this.parse(raw);
            // Emptied on purpose: null, so a `required` rule has something to reject — unless the
            // field was declared never-empty, in which case it goes back to what it held. Text that
            // is not a number at all goes back too. Nothing is written that is already there, so a
            // blur that changed nothing sends nothing under .live.
            const next = n !== null ? this.clamp(n)
                : (String(raw).trim() === '' && this.nullable ? null : this.value);
            if (next !== this.value) this.value = next;
            e.target.value = this.text;
        },
        get atMin() { return this.value !== null && this.min !== null && this.value <= this.min; },
        get atMax() { return this.value !== null && this.max !== null && this.value >= this.max; },
    }"
    role="group"
    {{ $attributes->twMerge('border-input dark:bg-input/30 inline-flex items-stretch overflow-hidden rounded-md border bg-transparent shadow-xs transition-[color,box-shadow] focus-within:border-ring focus-within:ring-ring/50 focus-within:ring-[3px] has-[input:disabled]:pointer-events-none has-[input:disabled]:opacity-50') }}
>
    {{-- Decrease: sits at the inline-start; border-e divides it from the field --}}
    <button
        type="button"
        aria-label="{{ __('Decrease') }}"
        @click="dec()"
        :disabled="disabled || atMin"
        @class([
            'border-input text-muted-foreground hover:bg-accent hover:text-accent-foreground flex shrink-0 items-center justify-center border-e outline-none transition-colors not-disabled:cursor-pointer disabled:pointer-events-none disabled:opacity-50',
            $btn,
        ])
    >
        <x-lucide-minus aria-hidden="true" />
    </button>

    <input
        type="text"
        inputmode="decimal"
        role="spinbutton"
        @if ($ariaLabelledby) aria-labelledby="{{ $ariaLabelledby }}"
        @elseif ($inputLabel) aria-label="{{ $inputLabel }}"
        @else aria-label="{{ __('Number') }}" @endif
        @if ($name) name="{{ $name }}" @endif
        @if ($id) id="{{ $id }}" @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @disabled($disabled)
        :value="text"
        @focus="onFocus($event)"
        @input="onInput($event)"
        @blur="onBlur($event)"
        :aria-valuenow="value"
        @if ($min !== null) aria-valuemin="{{ $min }}" @endif
        @if ($max !== null) aria-valuemax="{{ $max }}" @endif
        @class([
            'placeholder:text-muted-foreground text-foreground selection:bg-primary selection:text-primary-foreground w-full min-w-0 border-0 bg-transparent px-3 py-1 text-center tabular-nums outline-none disabled:cursor-not-allowed',
            $field,
        ])
    />

    {{-- Increase: sits at the inline-end; border-s divides it from the field --}}
    <button
        type="button"
        aria-label="{{ __('Increase') }}"
        @click="inc()"
        :disabled="disabled || atMax"
        @class([
            'border-input text-muted-foreground hover:bg-accent hover:text-accent-foreground flex shrink-0 items-center justify-center border-s outline-none transition-colors not-disabled:cursor-pointer disabled:pointer-events-none disabled:opacity-50',
            $btn,
        ])
    >
        <x-lucide-plus aria-hidden="true" />
    </button>
</div>
