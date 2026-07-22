@props([
    'name' => null,
    'value' => null,        // 'HH:mm' or 'HH:mm:ss'
    'variant' => 'input',   // 'input' (native <input type=time>) | 'select' (native dropdowns)
    'hourCycle' => 'auto',  // 'auto' | '12' | '24'  (select variant + display)
    'seconds' => false,
    'minuteStep' => 1,
    'secondStep' => 1,
    'min' => null,          // 'HH:mm' (input variant)
    'max' => null,          // 'HH:mm' (input variant)
    'disabled' => false,
    'id' => null,
    'part' => null,         // composition tag echoed back in the time-change event
])

@php
    // Native <input type=time> step is in seconds: 60 = minute precision (default),
    // 1 = second precision, 900 = 15-minute stepping, etc.
    $step = $seconds ? max(1, (int) $secondStep) : ((int) $minuteStep > 1 ? (int) $minuteStep * 60 : null);

    $selCls = 'appearance-none border-input bg-background dark:bg-input/30 h-9 rounded-md border ps-2.5 pe-7 text-sm shadow-xs outline-none transition-[color,box-shadow] focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:opacity-50 disabled:pointer-events-none';

    // Forward an author-provided aria-label onto the real control — otherwise it lands on the
    // wrapper div and the native <input type=time> stays unnamed.
    $ariaLabel = $attributes->get('aria-label');
    $attributes = $attributes->except('aria-label');
@endphp

<div
    data-slot="time-field"
    x-data="{
        value: @js($value),
        cycle: @js($hourCycle),
        seconds: @js((bool) $seconds),
        part: @js($part),
        minStep: {{ max(1, (int) $minuteStep) }},
        secStep: {{ max(1, (int) $secondStep) }},
        h: null, m: null, s: 0,
        init() {
            if (this.value) {
                const p = String(this.value).split(':').map(Number);
                this.h = Number.isFinite(p[0]) ? p[0] : null;
                this.m = Number.isFinite(p[1]) ? p[1] : null;
                this.s = Number.isFinite(p[2]) ? p[2] : 0;
            }
        },
        get cyc() {
            if (this.cycle !== 'auto') return this.cycle;
            try { return Intl.DateTimeFormat().resolvedOptions().hour12 ? '12' : '24'; } catch (e) { return '24'; }
        },
        get hourOpts() { return this.cyc === '12' ? Array.from({ length: 12 }, (_, i) => i + 1) : Array.from({ length: 24 }, (_, i) => i); },
        get minOpts() { const o = []; for (let i = 0; i < 60; i += this.minStep) o.push(i); return o; },
        get secOpts() { const o = []; for (let i = 0; i < 60; i += this.secStep) o.push(i); return o; },
        get period() { return this.h === null ? 'AM' : (this.h < 12 ? 'AM' : 'PM'); },
        get hour12() { return this.h === null ? null : ((this.h + 11) % 12) + 1; },
        pad(n) { return String(n ?? 0).padStart(2, '0'); },
        setH(v) { this.h = +v; if (this.m === null) this.m = 0; this.sync(); },
        setH12(v) { const base = (+v) % 12; this.h = this.period === 'PM' ? base + 12 : base; if (this.m === null) this.m = 0; this.sync(); },
        setM(v) { this.m = +v; if (this.h === null) this.h = 0; this.sync(); },
        setS(v) { this.s = +v; if (this.h === null) this.h = 0; if (this.m === null) this.m = 0; this.sync(); },
        setPeriod(p) {
            if (this.h === null) { this.h = p === 'PM' ? 12 : 0; }
            else { const base = this.h % 12; this.h = p === 'PM' ? base + 12 : base; }
            if (this.m === null) this.m = 0;
            this.sync();
        },
        fromInput(v) { this.value = v || null; this.$dispatch('time-change', { value: this.value, part: this.part }); },
        sync() {
            this.value = (this.h !== null && this.m !== null)
                ? this.pad(this.h) + ':' + this.pad(this.m) + (this.seconds ? ':' + this.pad(this.s) : '')
                : null;
            this.$dispatch('time-change', { value: this.value, part: this.part });
        },
    }"
    {{ $attributes->twMerge('inline-flex items-center gap-1.5') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value ?? ''">
    @endif

    @if ($variant === 'select')
        {{-- Native, fully-accessible dropdowns (same pattern as the calendar's month/year). --}}
        {{-- 24h hours --}}
        <div class="relative" x-show="cyc !== '12'">
            <select aria-label="Hour" @if ($disabled) disabled @endif class="{{ $selCls }}" @change="setH($event.target.value)">
                <option value="" :selected="h === null" disabled hidden>--</option>
                <template x-for="o in hourOpts" :key="o">
                    <option :value="o" :selected="h === o" x-text="pad(o)"></option>
                </template>
            </select>
            <x-lucide-chevron-down class="pointer-events-none absolute end-2 top-1/2 size-3.5 -translate-y-1/2 opacity-50" aria-hidden="true" />
        </div>

        {{-- 12h hours --}}
        <div class="relative" x-show="cyc === '12'">
            <select aria-label="Hour" @if ($disabled) disabled @endif class="{{ $selCls }}" @change="setH12($event.target.value)">
                <option value="" :selected="h === null" disabled hidden>--</option>
                <template x-for="o in hourOpts" :key="o">
                    <option :value="o" :selected="hour12 === o" x-text="pad(o)"></option>
                </template>
            </select>
            <x-lucide-chevron-down class="pointer-events-none absolute end-2 top-1/2 size-3.5 -translate-y-1/2 opacity-50" aria-hidden="true" />
        </div>

        <span class="text-muted-foreground">:</span>

        {{-- minutes --}}
        <div class="relative">
            <select aria-label="Minute" @if ($disabled) disabled @endif class="{{ $selCls }}" @change="setM($event.target.value)">
                <option value="" :selected="m === null" disabled hidden>--</option>
                <template x-for="o in minOpts" :key="o">
                    <option :value="o" :selected="m === o" x-text="pad(o)"></option>
                </template>
            </select>
            <x-lucide-chevron-down class="pointer-events-none absolute end-2 top-1/2 size-3.5 -translate-y-1/2 opacity-50" aria-hidden="true" />
        </div>

        @if ($seconds)
            <span class="text-muted-foreground">:</span>
            <div class="relative">
                <select aria-label="Second" @if ($disabled) disabled @endif class="{{ $selCls }}" @change="setS($event.target.value)">
                    <option value="" :selected="h === null" disabled hidden>--</option>
                    <template x-for="o in secOpts" :key="o">
                        <option :value="o" :selected="s === o" x-text="pad(o)"></option>
                    </template>
                </select>
                <x-lucide-chevron-down class="pointer-events-none absolute end-2 top-1/2 size-3.5 -translate-y-1/2 opacity-50" aria-hidden="true" />
            </div>
        @endif

        {{-- AM / PM --}}
        <div class="relative" x-show="cyc === '12'">
            <select aria-label="AM or PM" @if ($disabled) disabled @endif class="{{ $selCls }}" @change="setPeriod($event.target.value)">
                <option value="AM" :selected="period === 'AM'">AM</option>
                <option value="PM" :selected="period === 'PM'">PM</option>
            </select>
            <x-lucide-chevron-down class="pointer-events-none absolute end-2 top-1/2 size-3.5 -translate-y-1/2 opacity-50" aria-hidden="true" />
        </div>
    @else
        {{-- Native time input: free segmented editing, keyboard, mobile wheel, IME. --}}
        {{-- Conditional attrs use :bindings (Blade omits null/false). Never put @if inside an <x-...> tag. --}}
        <x-ui.input
            type="time"
            :id="$id"
            :step="$step"
            :min="$min"
            :max="$max"
            :disabled="$disabled"
            :aria-label="$ariaLabel"
            x-bind:value="value"
            x-on:input="fromInput($event.target.value)"
            class="bg-background w-auto [&::-webkit-calendar-picker-indicator]:hidden"
        />
    @endif
</div>
