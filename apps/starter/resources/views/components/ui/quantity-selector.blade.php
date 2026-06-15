@props([
    'name' => null,
    'value' => 1,
    'min' => 1,
    'max' => null,
    'step' => 1,
    'size' => 'default',
    'disabled' => false,
    'id' => null,
])

@php
    // Compact, attached − [n] + stepper for carts/products. Integer-only steps and a
    // tighter footprint than number-input, but the same attached look and aria routing.
    $sizes = [
        'sm' => 'h-7 text-xs',
        'default' => 'h-8 text-sm',
        'lg' => 'h-9 text-base',
    ];
    $field = $sizes[$size] ?? $sizes['default'];

    // Square stepper buttons sized to the control height.
    $btnSizes = [
        'sm' => 'w-7 [&_svg]:size-3',
        'default' => 'w-8 [&_svg]:size-3.5',
        'lg' => 'w-9 [&_svg]:size-4',
    ];
    $btn = $btnSizes[$size] ?? $btnSizes['default'];

    // Width of the numeric field, scaled to the size so digits stay centered.
    $fieldWidths = [
        'sm' => 'w-9',
        'default' => 'w-10',
        'lg' => 'w-12',
    ];
    $fieldWidth = $fieldWidths[$size] ?? $fieldWidths['default'];

    // The spinbutton (not the wrapper) must carry the accessible name. Route any
    // author-supplied aria-label / aria-labelledby onto the <input>, falling back
    // to the field name then a generic label, so the control is never unnamed.
    $ariaLabel = $attributes->get('aria-label');
    $ariaLabelledby = $attributes->get('aria-labelledby');
    $attributes = $attributes->except(['aria-label', 'aria-labelledby']);
    $inputLabel = $ariaLabel ?? $name;
@endphp

<div
    data-slot="quantity-selector"
    x-data="{
        value: @js($value === null || $value === '' ? null : (int) $value),
        min: @js($min === null ? null : (int) $min),
        max: @js($max === null ? null : (int) $max),
        step: @js((int) $step),
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
            const raw = e.target.value.replace(/[^\d-]/g, '');
            this.value = raw === '' ? null : parseInt(raw, 10);
        },
        onBlur(e) {
            if (this.value === null || isNaN(this.value)) {
                this.value = this.clamp(this.min ?? 0);
                e.target.value = this.value ?? '';
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
        aria-label="Decrease quantity"
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
        inputmode="numeric"
        role="spinbutton"
        @if ($ariaLabelledby) aria-labelledby="{{ $ariaLabelledby }}"
        @elseif ($inputLabel) aria-label="{{ $inputLabel }}"
        @else aria-label="Quantity" @endif
        @if ($name) name="{{ $name }}" @endif
        @if ($id) id="{{ $id }}" @endif
        @disabled($disabled)
        :value="value"
        @input="onInput($event)"
        @blur="onBlur($event)"
        :aria-valuenow="value"
        @if ($min !== null) aria-valuemin="{{ $min }}" @endif
        @if ($max !== null) aria-valuemax="{{ $max }}" @endif
        @class([
            'text-foreground selection:bg-primary selection:text-primary-foreground min-w-0 border-0 bg-transparent px-1 py-1 text-center font-medium tabular-nums outline-none disabled:cursor-not-allowed',
            $field,
            $fieldWidth,
        ])
    />

    {{-- Increase: sits at the inline-end; border-s divides it from the field --}}
    <button
        type="button"
        aria-label="Increase quantity"
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
