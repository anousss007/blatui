@props([
    'name' => null,
    'value' => 0,
    'min' => null,
    'max' => null,
    'step' => 1,
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
@endphp

<div
    data-slot="number-input"
    x-data="{
        value: @js($value === null || $value === '' ? null : (float) $value),
        min: @js($min === null ? null : (float) $min),
        max: @js($max === null ? null : (float) $max),
        step: @js((float) $step),
        disabled: @js((bool) $disabled),
        clamp(v) {
            if (v === null || isNaN(v)) return v;
            if (this.min !== null && v < this.min) v = this.min;
            if (this.max !== null && v > this.max) v = this.max;
            return v;
        },
        inc() {
            if (this.disabled || this.atMax) return;
            this.value = this.clamp((this.value ?? this.min ?? 0) + this.step);
        },
        dec() {
            if (this.disabled || this.atMin) return;
            this.value = this.clamp((this.value ?? this.max ?? 0) - this.step);
        },
        onInput(e) {
            const raw = e.target.value;
            this.value = raw === '' ? null : parseFloat(raw);
        },
        onBlur(e) {
            if (this.value === null || isNaN(this.value)) {
                this.value = null;
                e.target.value = '';
                return;
            }
            this.value = this.clamp(this.value);
            e.target.value = this.value;
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
        aria-label="Decrease"
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
        @else aria-label="Number" @endif
        @if ($name) name="{{ $name }}" @endif
        @if ($id) id="{{ $id }}" @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @disabled($disabled)
        :value="value"
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
        aria-label="Increase"
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
