{{--
    Knob — a rotary dial input. Drag (pointer), scroll (wheel) or use the keyboard to set a value.
      The value sweeps a 270° arc (-135° → +135°). The center shows the current value.
      name      when set, a hidden <input> mirrors the value for form submission.
      min/max/step/value/size/label/disabled as usual. size: sm | default | lg.
    A11y: the knob is role="slider" with live aria-valuenow and bounds, an aria-label, tabindex=0,
          and full keyboard support (arrows, home/end, page up/down). Visible focus ring. RTL-safe.
--}}
@props([
    'name' => null,
    'value' => 50,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'size' => 'default',
    'label' => 'Value',
    'disabled' => false,
])

@php
    $dims = [
        'sm' => ['box' => 'size-16', 'text' => 'text-sm'],
        'default' => ['box' => 'size-24', 'text' => 'text-base'],
        'lg' => ['box' => 'size-32', 'text' => 'text-lg'],
    ];
    $dim = $dims[$size] ?? $dims['default'];

    // Geometry — fixed 100×100 viewBox, 270° sweep from -135° to +135°.
    $vb = 100;
    $center = 50;
    $thickness = 8;
    $radius = ($vb - $thickness) / 2;          // leave room for the stroke
    $circ = 2 * M_PI * $radius;
    $sweep = 0.75;                              // 270° of the full circle
    $arcLen = $circ * $sweep;

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
    data-slot="knob"
    data-disabled="@js((bool) $disabled)"
    x-data="{
        min: @js((float) $min),
        max: @js((float) $max),
        step: @js((float) $step),
        disabled: @js((bool) $disabled),
        _model: $blatModel(@js((float) $value)),
        get value() { return this._model.value; },
        set value(v) { this._model.value = v; },
        dragging: false,
        circ: @js($circ),
        arcLen: @js($arcLen),
        startAngle: -135,
        sweepDeg: 270,
        clamp(v) { return Math.max(this.min, Math.min(this.max, v)) },
        // Every move goes through $blatNumber so the value stays on the steps the author
        // declared: `0.1 + 0.1 + 0.1` is 0.30000000000000004, and under wire:model that drift
        // is written straight into the consumer's property.
        snap(raw) { return this.clamp(this.$blatNumber.snap(raw, this.step, this.min)); },
        get ratio() { return (this.value - this.min) / (this.max - this.min || 1) },
        get dashOffset() { return this.circ - this.arcLen * this.ratio },
        get angle() { return this.startAngle + this.sweepDeg * this.ratio },
        get display() {
            // show as integer when step is whole, else trim trailing zeros
            return Number.isInteger(this.step) ? Math.round(this.value) : parseFloat(this.value.toFixed(3));
        },
        bump(d) { if (this.disabled) return; this.value = this.clamp(this.$blatNumber.step(this.value, d * this.step, this.step)) },
        page(d) {
            if (this.disabled) return;
            const big = Math.max(this.step, (this.max - this.min) / 10);
            this.value = this.clamp(this.$blatNumber.step(this.value, d * big, this.step));
        },
        wheel(e) {
            if (this.disabled) return;
            e.preventDefault();
            this.bump(e.deltaY < 0 ? 1 : -1);
        },
        valFromEvent(e) {
            const r = this.$refs.dial.getBoundingClientRect();
            const cx = r.left + r.width / 2;
            const cy = r.top + r.height / 2;
            // degrees from the top, clockwise positive, in [-180, 180]
            let deg = Math.atan2(e.clientX - cx, cy - e.clientY) * 180 / Math.PI;
            const end = this.startAngle + this.sweepDeg;   // +135
            let ratio;
            if (deg < this.startAngle || deg > end) {
                // bottom dead zone (the unused 90°) → snap to the nearer end
                ratio = deg < 0 ? 0 : 1;
            } else {
                ratio = (deg - this.startAngle) / this.sweepDeg;
            }
            return this.snap(this.min + ratio * (this.max - this.min));
        },
        start(e) {
            if (this.disabled) return;
            this.dragging = true;
            this.value = this.valFromEvent(e);
            this.$refs.dial.focus();
        },
        move(e) { if (this.dragging) this.value = this.valFromEvent(e) },
        stop() { this.dragging = false },
    }"
    @pointermove.window="move($event)"
    @pointerup.window="stop()"
    {{ $attributes->twMerge('text-primary inline-flex flex-col items-center gap-2 select-none data-[disabled=true]:pointer-events-none data-[disabled=true]:opacity-50') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif

    <div
        x-ref="dial"
        role="slider"
        tabindex="{{ $disabled ? -1 : 0 }}"
        aria-label="{{ $label }}"
        aria-valuemin="{{ $min }}"
        aria-valuemax="{{ $max }}"
        :aria-valuenow="value"
        :aria-disabled="disabled"
        @pointerdown.prevent="start($event)"
        @wheel="wheel($event)"
        @keydown.up.prevent="bump(1)"
        @keydown.right.prevent="bump(1)"
        @keydown.down.prevent="bump(-1)"
        @keydown.left.prevent="bump(-1)"
        @keydown.home.prevent="value = min"
        @keydown.end.prevent="value = max"
        @keydown.page-up.prevent="page(1)"
        @keydown.page-down.prevent="page(-1)"
        @class([
            $dim['box'],
            'relative grid touch-none place-items-center rounded-full outline-none not-data-[disabled=true]:cursor-grab focus-visible:ring-ring/50 focus-visible:ring-[3px]',
        ])
        :class="dragging && 'cursor-grabbing'"
    >
        <svg viewBox="0 0 {{ $vb }} {{ $vb }}" fill="none" aria-hidden="true" class="size-full -rotate-[135deg]">
            {{-- background track (270° arc) --}}
            <circle
                cx="{{ $center }}" cy="{{ $center }}" r="{{ $radius }}"
                class="stroke-border" stroke-width="{{ $thickness }}" stroke-linecap="round"
                stroke-dasharray="{{ $arcLen }} {{ $circ }}"
            />
            {{-- value arc --}}
            <circle
                cx="{{ $center }}" cy="{{ $center }}" r="{{ $radius }}"
                stroke="currentColor" stroke-width="{{ $thickness }}" stroke-linecap="round"
                stroke-dasharray="{{ $circ }}" :stroke-dashoffset="dashOffset"
                class="transition-[stroke-dashoffset] duration-100 ease-out"
            />
            {{-- indicator notch at the current angle (rotates around centre) --}}
            <line
                x1="{{ $center }}" y1="{{ $thickness + 3 }}" x2="{{ $center }}" y2="{{ $thickness + 11 }}"
                stroke="currentColor" stroke-width="{{ $thickness * 0.5 }}" stroke-linecap="round"
                :style="`transform: rotate(${angle + 135}deg); transform-origin: {{ $center }}px {{ $center }}px;`"
            />
        </svg>
        <span
            data-slot="knob-value"
            @class(['absolute font-semibold tabular-nums', $dim['text']])
            x-text="display"
        ></span>
    </div>
</div>
