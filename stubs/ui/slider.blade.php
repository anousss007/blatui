{{--
    Slider — single value, or a two-handle min–max range; horizontal or vertical.
      range        enable two thumbs. With range, pass :value="[low, high]"; a `name` submits
                   {name}[min] and {name}[max] as hidden inputs.
      orientation  horizontal (default) | vertical. Vertical needs a height on the slider
                   (defaults to h-40).
      min/max/step/value/disabled/ariaLabel as usual.
    A11y: each thumb is role="slider" with live aria-valuenow and bounds; full keyboard
          (arrows, home/end, page up/down). In range mode each thumb's bound is the other handle.
--}}
@props([
    'name' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => 0,
    'range' => false,
    'orientation' => 'horizontal',
    'disabled' => false,
    'ariaLabel' => 'Value',
])

@php
    if ($range) {
        $vals = is_array($value) ? array_values($value) : [$min, $max];
        $low = $vals[0] ?? $min;
        $high = $vals[1] ?? $max;
    }
    $vertical = $orientation === 'vertical';
    $containerCls = $vertical
        ? 'relative flex h-40 w-fit touch-none flex-col items-center select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50'
        : 'relative flex w-full touch-none items-center select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50';
    $trackCls = $vertical
        ? 'bg-muted relative grow overflow-hidden rounded-full w-1.5 h-full'
        : 'bg-muted relative grow overflow-hidden rounded-full h-1.5 w-full';
    $thumbCls = 'border-primary bg-background ring-ring/50 absolute block size-4 shrink-0 rounded-full border shadow-sm transition-[color,box-shadow] hover:ring-4 focus-visible:ring-4 focus-visible:outline-hidden'
        .($vertical ? ' left-1/2 -translate-x-1/2 translate-y-1/2' : ' top-1/2 -translate-x-1/2 -translate-y-1/2');

    // Livewire bridge — bind the single-value slider to a consumer's wire:model when present, via
    // $blatModel (blatui-core.js): the property path travels as a data attribute so a morph can
    // re-point it.
    // No-op (and stripped) without Livewire. Range mode keeps its min/max hidden inputs.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) {
        $attributes = $attributes->whereDoesntStartWith('wire:model');
        // Range mode carries its own pair of hidden inputs and is not bound through $blatModel, so the
        // data attribute — which is what turns the binding on — is only rendered for a single value.
        if (! $range) {
            $attributes = $attributes->merge(array_filter([
                'data-blat-model' => $wireModel->value(),
                'data-blat-model-live' => $wireModel->hasModifier('live') ? '1' : null,
            ]));
        }
    }
@endphp

<div
    data-slot="slider"
    data-orientation="{{ $orientation }}"
    @if ($range) data-range @endif
    @if ($disabled) data-disabled @endif
    x-data="{
        min: {{ $min }},
        max: {{ $max }},
        step: {{ $step }},
        disabled: {{ $disabled ? 'true' : 'false' }},
        range: {{ $range ? 'true' : 'false' }},
        vertical: {{ $vertical ? 'true' : 'false' }},
        _model: $blatModel({{ $range ? 0 : $value }}),
        get value() { return this._model.value; },
        set value(v) { this._model.value = v; },
        low: {{ $range ? $low : 0 }},
        high: {{ $range ? $high : 0 }},
        dragging: false,
        active: null,
        pct(v) { return ((v - this.min) / (this.max - this.min)) * 100 },
        get percent() { return this.pct(this.value) },
        get lowPercent() { return this.pct(this.low) },
        get highPercent() { return this.pct(this.high) },
        clamp(v, lo, hi) { return Math.max(lo, Math.min(hi, v)) },
        // Every move goes through $blatNumber so the value stays on the steps the author
        // declared: `0.1 + 0.1 + 0.1` is 0.30000000000000004, and under wire:model that drift
        // is written straight into the consumer's property.
        snap(raw) { return this.clamp(this.$blatNumber.snap(raw, this.step), this.min, this.max) },
        valAt(e) {
            const r = this.$refs.track.getBoundingClientRect();
            let ratio = this.vertical ? (1 - (e.clientY - r.top) / r.height) : ((e.clientX - r.left) / r.width);
            ratio = Math.max(0, Math.min(1, ratio));
            return this.snap(this.min + ratio * (this.max - this.min));
        },
        nearest(e) {
            const v = this.valAt(e);
            return Math.abs(v - this.low) <= Math.abs(v - this.high) ? 'low' : 'high';
        },
        thumbStyle(p) { return this.vertical ? `bottom: ${p}%` : `left: ${p}%` },
        fillStyle(a, b) { return this.vertical ? `bottom: ${a}%; height: ${b}%` : `left: ${a}%; width: ${b}%` },
        start(e, thumb) {
            if (this.disabled) return;
            this.dragging = true;
            if (this.range) { this.active = thumb || this.nearest(e); this.move(e); }
            else { this.value = this.valAt(e); }
        },
        move(e) {
            if (!this.dragging) return;
            if (!this.range) { this.value = this.valAt(e); return; }
            const v = this.valAt(e);
            if (this.active === 'low') this.low = this.clamp(v, this.min, this.high);
            else this.high = this.clamp(v, this.low, this.max);
        },
        stop() { this.dragging = false; this.active = null; },
        bump(d) { if (this.disabled) return; this.value = this.clamp(this.$blatNumber.step(this.value, d * this.step, this.step), this.min, this.max); },
        bumpLow(d) { if (this.disabled) return; this.low = this.clamp(this.$blatNumber.step(this.low, d * this.step, this.step), this.min, this.high); },
        bumpHigh(d) { if (this.disabled) return; this.high = this.clamp(this.$blatNumber.step(this.high, d * this.step, this.step), this.low, this.max); },
        page(d) { if (this.disabled) return; const big = Math.max(this.step, (this.max - this.min) / 10); this.value = this.clamp(this.$blatNumber.step(this.value, d * big, this.step), this.min, this.max); }
    }"
    @pointermove.window="move($event)"
    @pointerup.window="stop()"
    {{ $attributes->twMerge($containerCls) }}
>
    @if ($range)
        @if ($name)
            <input type="hidden" name="{{ $name }}[min]" :value="low">
            <input type="hidden" name="{{ $name }}[max]" :value="high">
        @endif
        <span data-slot="slider-track" x-ref="track" @pointerdown="start($event)" class="{{ $trackCls }}">
            <span data-slot="slider-range" class="bg-primary absolute {{ $vertical ? 'w-full' : 'h-full' }}" :style="fillStyle(lowPercent, highPercent - lowPercent)"></span>
        </span>
        <span
            data-slot="slider-thumb" role="slider" aria-orientation="{{ $orientation }}" aria-label="{{ $ariaLabel }} minimum"
            :tabindex="disabled ? -1 : 0" :aria-disabled="disabled" :aria-valuemin="min" :aria-valuemax="high" :aria-valuenow="low"
            @pointerdown.stop="start($event, 'low')"
            @keydown.left.prevent="bumpLow(-1)" @keydown.down.prevent="bumpLow(-1)"
            @keydown.right.prevent="bumpLow(1)" @keydown.up.prevent="bumpLow(1)"
            @keydown.home.prevent="low = min" @keydown.end.prevent="low = high"
            :style="thumbStyle(lowPercent)"
            class="{{ $thumbCls }}"
        ></span>
        <span
            data-slot="slider-thumb" role="slider" aria-orientation="{{ $orientation }}" aria-label="{{ $ariaLabel }} maximum"
            :tabindex="disabled ? -1 : 0" :aria-disabled="disabled" :aria-valuemin="low" :aria-valuemax="max" :aria-valuenow="high"
            @pointerdown.stop="start($event, 'high')"
            @keydown.left.prevent="bumpHigh(-1)" @keydown.down.prevent="bumpHigh(-1)"
            @keydown.right.prevent="bumpHigh(1)" @keydown.up.prevent="bumpHigh(1)"
            @keydown.home.prevent="high = low" @keydown.end.prevent="high = max"
            :style="thumbStyle(highPercent)"
            class="{{ $thumbCls }}"
        ></span>
    @else
        @if ($name)
            <input type="hidden" name="{{ $name }}" :value="value">
        @endif
        <span data-slot="slider-track" x-ref="track" @pointerdown="start($event)" class="{{ $trackCls }}">
            <span data-slot="slider-range" class="bg-primary absolute {{ $vertical ? 'w-full' : 'h-full' }}" :style="fillStyle(0, percent)"></span>
        </span>
        <span
            data-slot="slider-thumb" role="slider" aria-orientation="{{ $orientation }}" aria-label="{{ $ariaLabel }}"
            :tabindex="disabled ? -1 : 0" :aria-disabled="disabled" :aria-valuemin="min" :aria-valuemax="max" :aria-valuenow="value"
            @pointerdown="start($event)"
            @keydown.left.prevent="bump(-1)" @keydown.down.prevent="bump(-1)"
            @keydown.right.prevent="bump(1)" @keydown.up.prevent="bump(1)"
            @keydown.home.prevent="value = min" @keydown.end.prevent="value = max"
            @keydown.page-up.prevent="page(1)" @keydown.page-down.prevent="page(-1)"
            :style="thumbStyle(percent)"
            class="{{ $thumbCls }}"
        ></span>
    @endif
</div>
