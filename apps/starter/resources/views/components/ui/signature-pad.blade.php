@props([
    'name' => null,        // hidden input name → submits the signature data URL
    'height' => 200,       // canvas drawing height in CSS px (width is fluid)
    'penColor' => null,    // any CSS color; defaults to the foreground ink (currentColor)
    'id' => null,
])

@php
    // The ink defaults to the theme foreground. We resolve `currentColor` at runtime in JS by
    // reading the computed color of the root, so the stroke tracks the token in light/dark.
    $resolvedPen = $penColor ? "'".addslashes($penColor)."'" : 'null';
@endphp

<div
    data-slot="signature-pad"
    x-data="{
        pen: {{ $resolvedPen }},
        height: @js((int) $height),
        ctx: null,
        canvas: null,
        drawing: false,
        hasInk: false,
        last: { x: 0, y: 0 },
        strokes: [],        // history of completed strokes for Undo (each = array of points)
        current: null,

        init() {
            this.canvas = this.$refs.canvas;
            this.ctx = this.canvas.getContext('2d');
            this.resize();
            // Re-fit on container resize so the pad stays crisp & responsive.
            if (window.ResizeObserver) {
                this._ro = new ResizeObserver(() => this.resize());
                this._ro.observe(this.canvas);
            }
        },

        // Resolve the pen colour: explicit prop, else the root's computed text colour.
        penColor() {
            if (this.pen) return this.pen;
            return getComputedStyle(this.$root).color || '#000';
        },

        // Size the backing store to devicePixelRatio for sharp lines, then replay history.
        resize() {
            const dpr = window.devicePixelRatio || 1;
            const rect = this.canvas.getBoundingClientRect();
            if (!rect.width) return;
            this.canvas.width = Math.round(rect.width * dpr);
            this.canvas.height = Math.round(rect.height * dpr);
            this.ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            this.redraw();
        },

        point(e) {
            const rect = this.canvas.getBoundingClientRect();
            return { x: e.clientX - rect.left, y: e.clientY - rect.top };
        },

        start(e) {
            e.preventDefault();
            this.canvas.setPointerCapture?.(e.pointerId);
            this.drawing = true;
            this.hasInk = true;
            const p = this.point(e);
            this.last = p;
            this.current = [p];
        },

        move(e) {
            if (!this.drawing) return;
            e.preventDefault();
            const p = this.point(e);
            this.stroke(this.last, p);
            this.last = p;
            this.current.push(p);
        },

        end(e) {
            if (!this.drawing) return;
            this.drawing = false;
            if (this.current && this.current.length) this.strokes.push(this.current);
            this.current = null;
            this.sync();
        },

        // Draw one smooth segment between two points.
        stroke(a, b) {
            const c = this.ctx;
            c.strokeStyle = this.penColor();
            c.lineWidth = 2;
            c.lineCap = 'round';
            c.lineJoin = 'round';
            c.beginPath();
            c.moveTo(a.x, a.y);
            c.lineTo(b.x, b.y);
            c.stroke();
        },

        // Repaint the whole history (used after resize / undo).
        redraw() {
            const c = this.ctx;
            const rect = this.canvas.getBoundingClientRect();
            c.clearRect(0, 0, rect.width, rect.height);
            for (const s of this.strokes) {
                for (let i = 1; i < s.length; i++) this.stroke(s[i - 1], s[i]);
            }
            this.hasInk = this.strokes.length > 0;
        },

        undo() {
            this.strokes.pop();
            this.redraw();
            this.sync();
        },

        clear() {
            this.strokes = [];
            this.current = null;
            this.drawing = false;
            this.redraw();
            this.sync();
        },

        // Write the current canvas as a data URL into the hidden input (empty when blank).
        sync() {
            if (!this.$refs.field) return;
            this.$refs.field.value = this.hasInk ? this.canvas.toDataURL('image/png') : '';
            this.$refs.field.dispatchEvent(new Event('input', { bubbles: true }));
        },
    }"
    {{ $attributes->twMerge('text-foreground flex w-full flex-col gap-2') }}
>
    <div class="border-input bg-background relative overflow-hidden rounded-md border">
        {{-- Baseline + "Sign here" hint; fades out once any ink lands on the pad. --}}
        <div
            x-show="!hasInk"
            x-transition.opacity
            class="pointer-events-none absolute inset-x-0 bottom-0 flex flex-col items-center"
            aria-hidden="true"
        >
            <span class="text-muted-foreground mb-2 text-xs">Sign here</span>
            <span class="bg-border mb-7 h-px w-3/4"></span>
        </div>

        <canvas
            x-ref="canvas"
            aria-label="Signature pad — draw your signature"
            role="img"
            class="block w-full touch-none"
            :style="`height: ${height}px`"
            @pointerdown="start($event)"
            @pointermove="move($event)"
            @pointerup="end($event)"
            @pointercancel="end($event)"
            @pointerleave="end($event)"
        ></canvas>
    </div>

    <div class="flex items-center gap-2">
        <x-ui.button type="button" variant="outline" size="sm" x-on:click="undo()" x-bind:disabled="strokes.length === 0">
            <x-lucide-undo-2 aria-hidden="true" />
            Undo
        </x-ui.button>
        <x-ui.button type="button" variant="ghost" size="sm" x-on:click="clear()" x-bind:disabled="!hasInk">
            <x-lucide-eraser aria-hidden="true" />
            Clear
        </x-ui.button>
    </div>

    @if ($name)
        <input type="hidden" x-ref="field" name="{{ $name }}" @if ($id) id="{{ $id }}" @endif>
    @endif
</div>
