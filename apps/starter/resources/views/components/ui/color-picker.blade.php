@props([
    'name' => null,
    'value' => '#6366f1',
    'swatches' => null,
    'disabled' => false,
    'inline' => false,   // render the panel inline (always visible) instead of inside a popover
    'id' => null,
])

@php
    // A tasteful default palette of common, readable hex values.
    $palette = $swatches ?: [
        '#ef4444', // red
        '#f97316', // orange
        '#eab308', // yellow
        '#22c55e', // green
        '#14b8a6', // teal
        '#3b82f6', // blue
        '#6366f1', // indigo
        '#a855f7', // purple
        '#ec4899', // pink
        '#111827', // near-black
    ];

    // Stable id so the sr-only <label> can target the hex <input>.
    $fieldId = $id ?: 'color-picker-'.\Illuminate\Support\Str::random(6);
@endphp

<div
    data-slot="color-picker"
    x-data="{
        open: false,
        disabled: @js((bool) $disabled),
        inline: @js((bool) $inline),
        hex: @js($value),
        hue: 0,
        input: @js($value),
        swatches: @js(array_values((array) $palette)),

        init() {
            // Seed the visible text input + hue from the resolved starting colour.
            const norm = this.normalize(this.hex);
            if (norm) { this.hex = norm; this.input = norm; }
            this.hue = this.hexToHue(this.hex);
        },

        // Accept #rgb / #rrggbb (with or without leading #); return a normalized
        // lower-case #rrggbb string, or null when invalid.
        normalize(v) {
            if (typeof v !== 'string') return null;
            let s = v.trim().replace(/^#/, '').toLowerCase();
            if (/^[0-9a-f]{3}$/.test(s)) {
                s = s.split('').map((c) => c + c).join('');
            }
            if (/^[0-9a-f]{6}$/.test(s)) return '#' + s;
            return null;
        },

        // HSL(h, 90%, 50%) → #rrggbb. Used while dragging the hue slider.
        hslToHex(h) {
            const s = 0.9, l = 0.5;
            const c = (1 - Math.abs(2 * l - 1)) * s;
            const x = c * (1 - Math.abs(((h / 60) % 2) - 1));
            const m = l - c / 2;
            let r = 0, g = 0, b = 0;
            if (h < 60)       { r = c; g = x; b = 0; }
            else if (h < 120) { r = x; g = c; b = 0; }
            else if (h < 180) { r = 0; g = c; b = x; }
            else if (h < 240) { r = 0; g = x; b = c; }
            else if (h < 300) { r = x; g = 0; b = c; }
            else              { r = c; g = 0; b = x; }
            const to = (n) => Math.round((n + m) * 255).toString(16).padStart(2, '0');
            return '#' + to(r) + to(g) + to(b);
        },

        // #rrggbb → hue (0..360) so a typed/picked colour positions the slider.
        hexToHue(hex) {
            const n = this.normalize(hex);
            if (!n) return 0;
            const r = parseInt(n.slice(1, 3), 16) / 255;
            const g = parseInt(n.slice(3, 5), 16) / 255;
            const b = parseInt(n.slice(5, 7), 16) / 255;
            const max = Math.max(r, g, b), min = Math.min(r, g, b), d = max - min;
            if (d === 0) return 0;
            let h = 0;
            if (max === r)      h = ((g - b) / d) % 6;
            else if (max === g) h = (b - r) / d + 2;
            else                h = (r - g) / d + 4;
            h = Math.round(h * 60);
            return h < 0 ? h + 360 : h;
        },

        setHue(h) {
            this.hue = Number(h);
            this.hex = this.hslToHex(this.hue);
            this.input = this.hex;
        },

        // Live-validate the text field; only commit when it parses.
        commit(v) {
            const n = this.normalize(v);
            if (n) {
                this.hex = n;
                this.hue = this.hexToHue(n);
            }
        },

        // On blur, snap the visible text back to the last valid colour.
        sync() {
            this.input = this.hex;
        },

        pick(c) {
            const n = this.normalize(c);
            if (!n) return;
            this.hex = n;
            this.input = n;
            this.hue = this.hexToHue(n);
        },

        get isValid() { return this.normalize(this.input) !== null; },
    }"
    x-init="init()"
    {{ $attributes->twMerge('relative inline-block text-start') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="hex">
    @endif

    {{-- Trigger: shown only in popover mode. --}}
    <template x-if="!inline">
        <button
            type="button"
            :disabled="disabled"
            aria-haspopup="dialog"
            :aria-expanded="open"
            @click="open = !open"
            class="border-input bg-background ring-offset-background hover:bg-accent hover:text-accent-foreground focus-visible:ring-ring inline-flex h-9 items-center gap-2 rounded-md border px-3 text-sm font-medium shadow-xs transition-colors outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
        >
            <span class="border-border/50 size-4 rounded-sm border" :style="`background-color: ${hex}`" aria-hidden="true"></span>
            <span class="font-mono" x-text="hex"></span>
        </button>
    </template>

    {{-- Panel. In popover mode it floats absolutely below the trigger; inline mode renders it in flow. --}}
    <div
        x-show="inline || open"
        x-cloak
        @if (! $inline)
            @click.outside="open = false"
            @keydown.escape.window="open = false"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-1"
        @endif
        role="dialog"
        aria-label="Choose colour"
        @class([
            'bg-popover text-popover-foreground border-border z-50 w-64 rounded-lg border p-4 shadow-md',
            'absolute start-0 top-full mt-2' => ! $inline,
        ])
        @unless ($inline) style="display: none;" @endunless
    >
        <div class="flex flex-col gap-4">
            {{-- Large preview swatch --}}
            <div
                class="border-border/50 h-16 w-full rounded-md border"
                :style="`background-color: ${hex}`"
                aria-hidden="true"
            ></div>

            {{-- Hue slider: track painted with a rainbow gradient. --}}
            <div class="flex flex-col gap-1.5">
                <input
                    type="range"
                    min="0"
                    max="360"
                    step="1"
                    :value="hue"
                    @input="setHue($event.target.value)"
                    aria-label="Hue"
                    class="focus-visible:ring-ring h-3 w-full cursor-pointer appearance-none rounded-full outline-none focus-visible:ring-2"
                    style="background: linear-gradient(to right, #ff0000 0%, #ffff00 17%, #00ff00 33%, #00ffff 50%, #0000ff 67%, #ff00ff 83%, #ff0000 100%);"
                />
            </div>

            {{-- Hex text input with sr-only label. --}}
            <div class="flex flex-col gap-1.5">
                <label for="{{ $fieldId }}" class="sr-only">Hex colour value</label>
                <input
                    id="{{ $fieldId }}"
                    type="text"
                    inputmode="text"
                    autocomplete="off"
                    spellcheck="false"
                    maxlength="7"
                    x-model="input"
                    @input="commit($event.target.value)"
                    @blur="sync()"
                    :aria-invalid="!isValid"
                    placeholder="#rrggbb"
                    class="border-input bg-transparent dark:bg-input/30 focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:border-destructive aria-invalid:ring-destructive/20 flex h-9 w-full min-w-0 rounded-md border px-3 py-1 font-mono text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px]"
                />
            </div>

            {{-- Preset swatch grid. --}}
            <div class="grid grid-cols-5 gap-2" role="group" aria-label="Preset colours">
                <template x-for="c in swatches" :key="c">
                    <button
                        type="button"
                        @click="pick(c)"
                        :aria-label="c"
                        :aria-pressed="hex === normalize(c)"
                        class="border-border/50 focus-visible:ring-ring aspect-square w-full rounded-md border outline-none focus-visible:ring-2 focus-visible:ring-offset-1"
                        :class="hex === normalize(c) ? 'ring-ring ring-2 ring-offset-1' : ''"
                        :style="`background-color: ${c}`"
                    ></button>
                </template>
            </div>
        </div>
    </div>
</div>
