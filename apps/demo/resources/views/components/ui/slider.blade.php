@props([
    'name' => null,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'value' => 0,
    'disabled' => false,
])

<div
    data-slot="slider"
    data-orientation="horizontal"
    @if ($disabled) data-disabled @endif
    x-data="{
        min: {{ $min }},
        max: {{ $max }},
        step: {{ $step }},
        value: {{ $value }},
        disabled: {{ $disabled ? 'true' : 'false' }},
        dragging: false,
        get percent() { return ((this.value - this.min) / (this.max - this.min)) * 100 },
        setFromClientX(clientX) {
            const rect = this.$refs.track.getBoundingClientRect();
            let ratio = (clientX - rect.left) / rect.width;
            ratio = Math.max(0, Math.min(1, ratio));
            let raw = this.min + ratio * (this.max - this.min);
            let stepped = Math.round(raw / this.step) * this.step;
            this.value = Math.max(this.min, Math.min(this.max, stepped));
        },
        start(e) { if (this.disabled) return; this.dragging = true; this.setFromClientX(e.clientX); },
        move(e) { if (this.dragging) this.setFromClientX(e.clientX); },
        stop() { this.dragging = false; },
        bump(d) { if (this.disabled) return; this.value = Math.max(this.min, Math.min(this.max, this.value + d * this.step)); }
    }"
    @pointermove.window="move($event)"
    @pointerup.window="stop()"
    {{ $attributes->twMerge('relative flex w-full touch-none items-center select-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif
    <span
        data-slot="slider-track"
        x-ref="track"
        @pointerdown="start($event)"
        class="bg-muted relative grow overflow-hidden rounded-full h-1.5 w-full"
    >
        <span data-slot="slider-range" class="bg-primary absolute h-full" :style="`width: ${percent}%`"></span>
    </span>
    <span
        data-slot="slider-thumb"
        role="slider"
        tabindex="0"
        :aria-valuemin="min"
        :aria-valuemax="max"
        :aria-valuenow="value"
        @pointerdown="start($event)"
        @keydown.left.prevent="bump(-1)"
        @keydown.down.prevent="bump(-1)"
        @keydown.right.prevent="bump(1)"
        @keydown.up.prevent="bump(1)"
        :style="`left: ${percent}%`"
        class="border-primary bg-background ring-ring/50 absolute top-1/2 block size-4 shrink-0 -translate-x-1/2 -translate-y-1/2 rounded-full border shadow-sm transition-[color,box-shadow] hover:ring-4 focus-visible:ring-4 focus-visible:outline-hidden disabled:pointer-events-none disabled:opacity-50"
    ></span>
</div>
