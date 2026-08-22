{{--
    BlatUI datetime-picker — calendar + time-field in one popover.
      mode         single | range
      name         single -> name; range -> name[from] and name[to]
      value        single: "Y-m-d\TH:i" (or "Y-m-d H:i"); range: ['from' => ..., 'to' => ...]
      hourCycle    auto | 12 | 24
      timeVariant  input | select   (forwarded to <x-ui.time-field>)
      min / max    bound, "Y-m-d" OR full "Y-m-d\TH:i". The date part bounds the calendar; the
                   time part bounds the time-of-day on that boundary day (validated for both
                   time variants).
      minNights / maxNights  range length bound (nights between from and to).
      numberOfMonths  calendar months shown (defaults: single -> 1, range -> 2)
    A range is "valid" only when it sits within [min, max], end >= start, and its length is
    within [minNights, maxNights]; otherwise the errors show and "Done" is disabled.
--}}
@props([
    'mode' => 'single',
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'hourCycle' => 'auto',
    'timeVariant' => 'input',
    'seconds' => false,
    'minuteStep' => 1,
    'captionLayout' => 'dropdown',
    'min' => null,
    'max' => null,
    'minNights' => null,
    'maxNights' => null,
    'outOfRange' => 'disable',  // 'disable' (prevent out-of-range dates) | 'flag' (allow + red)
    'weekStart' => 0,
    'numberOfMonths' => null,
    'defaultMonth' => null,
    'showOutsideDays' => true,
    'width' => null,
])

@php
    $parseDT = function ($v) {
        if (! $v) {
            return [null, null];
        }
        $v = str_replace(' ', 'T', trim((string) $v));
        $p = explode('T', $v, 2);

        return [$p[0] ?? null, $p[1] ?? null];
    };

    $isRange = $mode === 'range';

    // Range shows two months by default (like a typical date-range picker); single shows one.
    $months = $numberOfMonths !== null ? max(1, (int) $numberOfMonths) : ($isRange ? 2 : 1);

    [$initDate, $initTime] = $parseDT($isRange ? null : $value);

    $fromDate = $fromTime = $toDate = $toTime = null;
    if ($isRange && is_array($value)) {
        [$fromDate, $fromTime] = $parseDT($value['from'] ?? null);
        [$toDate, $toTime] = $parseDT($value['to'] ?? null);
    }
    $calRange = array_filter(['from' => $fromDate, 'to' => $toDate], fn ($x) => $x !== null) ?: null;

    // Split min/max into date (-> calendar) and time (-> validation) parts.
    [$minDate, $minTime] = $parseDT($min);
    [$maxDate, $maxTime] = $parseDT($max);

    $placeholder ??= $isRange ? 'Pick a date range' : 'Pick a date & time';
    $width ??= $isRange ? 'w-[320px]' : 'w-[280px]';

    $triggerCls = 'border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 items-center justify-start gap-2 rounded-md border bg-transparent px-3 py-2 text-start text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-transparent focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:border-destructive aria-invalid:ring-destructive/20';

    // Livewire bridge — bind to a consumer's wire:model when present, via $blatModel
    // (blatui-core.js): the property path travels as a data attribute so a morph can re-point it.
    // The bound value is whatever the `value` prop already takes for this mode — a combined
    // "Y-m-d\TH:i" for a single date+time, ['from' => …, 'to' => …] of the same for a range — so
    // `:value="$x" wire:model="x"` round-trips. No-op (and stripped) without Livewire.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) {
        $attributes = $attributes->whereDoesntStartWith('wire:model')->merge(array_filter([
            'data-blat-model' => $wireModel->value(),
            'data-blat-model-live' => $wireModel->hasModifier('live') ? '1' : null,
        ]));
    }

    // What the binding holds before the user touches anything: the same shape the `value` prop
    // takes, rebuilt from the parts parsed above so both paths agree.
    $combine = fn ($d, $t) => $d ? $d.'T'.($t ?: '00:00') : '';
    $modelInit = $isRange
        ? ['from' => $combine($fromDate, $fromTime), 'to' => $combine($toDate, $toTime)]
        : $combine($initDate, $initTime);
@endphp

<div
    data-slot="datetime-picker"
    x-data="{
        open: false,
        mode: @js($mode),
        cycle: @js($hourCycle),
        seconds: @js((bool) $seconds),
        minDate: @js($minDate), minTime: @js($minTime),
        maxDate: @js($maxDate), maxTime: @js($maxTime),
        minNights: @js($minNights !== null ? (int) $minNights : null),
        maxNights: @js($maxNights !== null ? (int) $maxNights : null),

        // A date and a time are the two halves of one value ('Y-m-d\TH:i'), and a range is two of
        // those. All four fields are therefore VIEWS over the bound value rather than copies of
        // it: assigning any of them rewrites the value, and a value assigned from anywhere else —
        // the server, a morph — is visible in all of them immediately, with nothing to re-seed.
        _model: $blatModel(@js($modelInit)),
        get model() { return this._model.value; },
        set model(v) { this._model.value = v; },
        _split(v) {
            if (! v) return { date: null, time: null };
            const p = String(v).replace(' ', 'T').split('T');

            return { date: p[0] || null, time: p[1] || null };
        },
        // A time picked before its date has nowhere to live in the value yet ('' carries no time),
        // so it waits here until a date arrives. Never a competing copy: the moment the value can
        // hold the time, the value is what every read returns.
        _pendingTime: null, _pendingFrom: null, _pendingTo: null,

        get date() { return this._split(this.model).date; },
        set date(v) { this.model = this.combined(v, this.time); },
        get time() { return this._split(this.model).time ?? this._pendingTime; },
        set time(v) { this._pendingTime = v; this.model = this.combined(this.date, v); },

        get from() { return this._split(this.model?.from).date; },
        set from(v) { this.setRange(this.combined(v, this.timeFrom), this.model?.to); },
        get timeFrom() { return this._split(this.model?.from).time ?? this._pendingFrom; },
        set timeFrom(v) { this._pendingFrom = v; this.setRange(this.combined(this.from, v), this.model?.to); },
        get to() { return this._split(this.model?.to).date; },
        set to(v) { this.setRange(this.model?.from, this.combined(v, this.timeTo)); },
        get timeTo() { return this._split(this.model?.to).time ?? this._pendingTo; },
        set timeTo(v) { this._pendingTo = v; this.setRange(this.model?.from, this.combined(this.to, v)); },

        onTime(d) {
            if (this.mode === 'range') {
                if (d.part === 'to') this.timeTo = d.value; else this.timeFrom = d.value;
            } else {
                this.time = d.value;
            }
        },
        setRange(from, to) {
            from = from ?? '';
            to = to ?? '';
            const now = this.model;
            // Writing an unchanged range would commit a request for nothing — and, because the
            // calendar is re-seeded from this value below, would bounce between the two forever.
            if (now && now.from === from && now.to === to) return;
            this.model = { from, to };
        },
        init() {
            // A value assigned anywhere but here has to reach the calendar as well. The popover is
            // teleported and wire:ignore'd, so nothing else ever re-seeds it, and it would keep
            // highlighting the days it opened with.
            this.$watch('_model.value', () => this.repaintCalendar());
        },
        repaintCalendar() {
            const cal = this.$refs.cal && this.$refs.cal.querySelector('[data-slot=calendar]');
            // Each ref is a wrapper with no x-data of its own (a ref on the component root would
            // register into ITS scope, not ours), so the field is reached by its data-slot.
            const push = (ref, v) => {
                const field = ref && ref.querySelector('[data-slot=time-field]');
                if (field) field.dispatchEvent(new CustomEvent('time:set', { detail: v ?? null, bubbles: false }));
            };
            if (this.mode === 'range') {
                if (cal) cal.dispatchEvent(new CustomEvent('calendar:set-range', { detail: { from: this.from, to: this.to }, bubbles: false }));
                push(this.$refs.tFrom, this.timeFrom);
                push(this.$refs.tTo, this.timeTo);
            } else {
                if (cal) cal.dispatchEvent(new CustomEvent('calendar:set', { detail: this.date || null, bubbles: false }));
                push(this.$refs.tOne, this.time);
            }
        },

        combined(d, t) { return d ? d + 'T' + (t || '00:00') : ''; },
        ms(d, t) { return d ? new Date(d + 'T' + (t || '00:00')).getTime() : null; },
        get loMs() { return this.minDate ? this.ms(this.minDate, this.minTime || '00:00') : null; },
        get hiMs() { return this.maxDate ? this.ms(this.maxDate, this.maxTime || '23:59:59') : null; },
        nights(a, b) { return (a && b) ? Math.round((new Date(b + 'T00:00:00') - new Date(a + 'T00:00:00')) / 86400000) : null; },
        plural(n) { return n > 1 ? 's' : ''; },
        fmt(d, t) {
            if (!d) return '';
            const dt = new Date(d + 'T' + (t || '00:00'));
            if (isNaN(dt)) return '';
            const ds = dt.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
            if (!t) return ds;
            const to = { hour: '2-digit', minute: '2-digit' };
            if (this.seconds) to.second = '2-digit';
            if (this.cycle !== 'auto') to.hourCycle = this.cycle === '12' ? 'h12' : 'h23';
            return ds + ', ' + dt.toLocaleTimeString(undefined, to);
        },
        get errors() {
            const e = [];
            const lo = this.loMs, hi = this.hiMs;
            if (this.mode === 'range') {
                const f = this.ms(this.from, this.timeFrom);
                const t = this.ms(this.to, this.timeTo);
                if (f !== null && lo !== null && f < lo) e.push('Start is before the earliest allowed date/time.');
                if (t !== null && hi !== null && t > hi) e.push('End is after the latest allowed date/time.');
                if (f !== null && t !== null && t < f) e.push('End is before start.');
                const n = this.nights(this.from, this.to);
                if (n !== null && this.minNights !== null && n < this.minNights) e.push('Minimum ' + this.minNights + ' night' + this.plural(this.minNights) + '.');
                if (n !== null && this.maxNights !== null && n > this.maxNights) e.push('Maximum ' + this.maxNights + ' night' + this.plural(this.maxNights) + '.');
            } else {
                const v = this.ms(this.date, this.time);
                if (v !== null && lo !== null && v < lo) e.push('Before the earliest allowed date/time.');
                if (v !== null && hi !== null && v > hi) e.push('After the latest allowed date/time.');
            }
            return e;
        },
        get invalid() { return this.errors.length > 0; },
        get label() {
            if (this.mode === 'range') {
                if (!this.from) return '';
                return this.fmt(this.from, this.timeFrom) + ' → ' + (this.to ? this.fmt(this.to, this.timeTo) : '…');
            }
            return this.fmt(this.date, this.time);
        },
    }"
    x-id="['blat-datetimepicker']"
    {{ $attributes->twMerge('relative '.$width) }}
>
    @if ($name)
        @if ($isRange)
            <input type="hidden" name="{{ $name }}[from]" :value="combined(from, timeFrom)" :aria-invalid="invalid ? 'true' : null">
            <input type="hidden" name="{{ $name }}[to]" :value="combined(to, timeTo)" :aria-invalid="invalid ? 'true' : null">
        @else
            <input type="hidden" name="{{ $name }}" :value="combined(date, time)" :aria-invalid="invalid ? 'true' : null">
        @endif
    @endif

    <button
        type="button"
        x-ref="trigger"
        @click="open = !open"
        aria-haspopup="dialog"
        :aria-expanded="open"
        :aria-controls="$id('blat-datetimepicker')"
        :aria-invalid="invalid ? 'true' : null"
        :class="{ 'text-muted-foreground': !label }"
        class="{{ $width }} {{ $triggerCls }}"
    >
        <x-lucide-calendar class="size-4 opacity-50" aria-hidden="true" />
        <span class="truncate" x-text="label || @js($placeholder)"></span>
    </button>

    {{-- Teleported to <body> so the popover is never clipped by an overflow-hidden ancestor
         (a card, table cell, the docs preview…). x-blat-anchor still positions it at the trigger. --}}
    <template x-teleport="body" wire:ignore>
    <div
        x-blat-dialog-layer
        x-show="open"
        x-cloak
        x-blat-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        {{-- Listeners live here (inside the teleported popover) so they catch the calendar's /
             time-field's bubbling events; the popover shares the picker's x-data scope.
             `calendar:updated` covers programmatic seeds too, so the label/hidden inputs stay
             in step when the calendar is driven from outside. --}}
        @calendar:updated="mode === 'range'
            ? setRange(combined($event.detail.value.from, timeFrom), combined($event.detail.value.to, timeTo))
            : (date = $event.detail.value)"
        @time-change="onTime($event.detail)"
        x-trap="open"
        :id="$id('blat-datetimepicker')"
        role="dialog"
        aria-label="{{ $isRange ? 'Choose a date and time range' : 'Choose date and time' }}"
        tabindex="-1"
        class="bg-popover text-popover-foreground z-50 flex w-auto origin-top flex-col overflow-y-auto overscroll-contain rounded-md border shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        {{-- `contents` so this wrapper is purely a handle for $refs and changes no layout. The ref
             cannot go on the calendar itself: an x-ref on an element that owns an x-data registers
             into THAT scope, not this one. --}}
        <div x-ref="cal" class="contents">
        <x-ui.calendar
            :mode="$mode"
            :value="$isRange ? $calRange : $initDate"
            :caption-layout="$captionLayout"
            :week-start="$weekStart"
            :number-of-months="$months"
            :default-month="$defaultMonth"
            :show-outside-days="$showOutsideDays"
            :min-date="$minDate"
            :max-date="$maxDate"
            :out-of-range="$outOfRange"
            class="rounded-none border-0"
        />
        </div>

        <div class="flex flex-col gap-3 border-t p-3">
            @if ($isRange)
                <div class="flex items-center justify-between gap-3" x-ref="tFrom">
                    <span class="text-sm font-medium">Start</span>
                    <x-ui.time-field part="from" :value="$fromTime" :variant="$timeVariant" :hour-cycle="$hourCycle" :seconds="$seconds" :minute-step="$minuteStep" />
                </div>
                <div class="flex items-center justify-between gap-3" x-ref="tTo">
                    <span class="text-sm font-medium">End</span>
                    <x-ui.time-field part="to" :value="$toTime" :variant="$timeVariant" :hour-cycle="$hourCycle" :seconds="$seconds" :minute-step="$minuteStep" />
                </div>
            @else
                <div class="flex items-center justify-between gap-3" x-ref="tOne">
                    <span class="text-sm font-medium">Time</span>
                    <x-ui.time-field :value="$initTime" :variant="$timeVariant" :hour-cycle="$hourCycle" :seconds="$seconds" :minute-step="$minuteStep" />
                </div>
            @endif

            <template x-if="errors.length">
                <ul class="flex flex-col gap-0.5" role="alert">
                    <template x-for="msg in errors" :key="msg">
                        <li class="text-destructive flex items-start gap-1 text-xs">
                            <x-lucide-circle-alert class="mt-0.5 size-3 shrink-0" aria-hidden="true" />
                            <span x-text="msg"></span>
                        </li>
                    </template>
                </ul>
            </template>
        </div>

        <div class="flex justify-end border-t p-3">
            <x-ui.button type="button" size="sm" ::disabled="invalid" @click="open = false">Done</x-ui.button>
        </div>
    </div>
    </template>
</div>
