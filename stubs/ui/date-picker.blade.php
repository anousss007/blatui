{{--
    BlatUI date-picker — calendar in a popover.
      mode            single | range
      name            single -> name; range -> name[from] and name[to]
      value           single: "Y-m-d"; range: ['from' => "Y-m-d", 'to' => "Y-m-d"]
      min / max       date bounds ("Y-m-d") for the calendar
      minNights / maxNights  range length bound (nights between from and to)
      numberOfMonths  calendar months shown (defaults: single -> 1, range -> 2)
--}}
@props([
    'mode' => 'single',
    'name' => null,
    'value' => null,
    'placeholder' => null,
    'numberOfMonths' => null,
    'captionLayout' => 'label',
    'weekStart' => 0,
    'defaultMonth' => null,
    'min' => null,
    'max' => null,
    'minNights' => null,
    'maxNights' => null,
    'outOfRange' => 'disable',  // 'disable' (prevent picking out-of-range) | 'flag' (allow + red)
    'showOutsideDays' => true,
    'width' => null,
    'presets' => null,          // false/null → none | true → sensible defaults for the mode |
                                // array of named keys (['today','last7Days',…]) and/or custom
                                // ['My label' => ['from'=>'Y-m-d','to'=>'Y-m-d']] / ['date'=>'Y-m-d']
])

@php
    $isRange = $mode === 'range';
    $months = $numberOfMonths !== null ? max(1, (int) $numberOfMonths) : ($isRange ? 2 : 1);

    $fromDate = $toDate = null;
    if ($isRange && is_array($value)) {
        $fromDate = $value['from'] ?? null;
        $toDate = $value['to'] ?? null;
    }
    $calValue = $isRange
        ? (array_filter(['from' => $fromDate, 'to' => $toDate], fn ($x) => $x !== null) ?: null)
        : $value;

    $placeholder ??= $isRange ? 'Pick a date range' : 'Pick a date';
    $width ??= $isRange ? 'w-[300px]' : 'w-[240px]';

    // weekStart → 0–6 number, so JS presets (thisWeek/lastWeek) honour the same first day.
    $weekStartNum = is_numeric($weekStart)
        ? (((int) $weekStart % 7) + 7) % 7
        : (['sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6][strtolower(trim((string) $weekStart))] ?? 0);

    // Quick-pick presets. Dates resolve client-side (relative to the user's "today") in Alpine,
    // so a cached view never serves a stale "Last 7 days".
    $presetDefaults = $isRange
        ? ['today', 'yesterday', 'thisWeek', 'last7Days', 'thisMonth', 'yearToDate', 'allTime']
        : ['today', 'yesterday', 'tomorrow'];
    $presetLabels = [
        'today' => __('Today'), 'yesterday' => __('Yesterday'), 'tomorrow' => __('Tomorrow'),
        'thisWeek' => __('This week'), 'lastWeek' => __('Last week'),
        'last7Days' => __('Last 7 days'), 'last14Days' => __('Last 14 days'), 'last30Days' => __('Last 30 days'),
        'thisMonth' => __('This month'), 'lastMonth' => __('Last month'),
        'thisYear' => __('This year'), 'yearToDate' => __('Year to date'), 'allTime' => __('All time'),
    ];
    $rawPresets = $presets === true ? $presetDefaults : (is_array($presets) ? $presets : []);
    $presetList = [];
    foreach ($rawPresets as $k => $v) {
        if (is_string($v)) {                      // named key: 'today', 'last7Days', …
            $presetList[] = ['label' => $presetLabels[$v] ?? \Illuminate\Support\Str::headline($v), 'key' => $v];
        } elseif (is_array($v)) {                 // custom: ['Label' => ['from'=>…,'to'=>…]] or ['date'=>…]
            $v['label'] = is_string($k) ? $k : ($v['label'] ?? '');
            $presetList[] = $v;
        }
    }
    $hasPresets = count($presetList) > 0;

    // Livewire bridge — entangle the single-date value with a consumer's wire:model when present.
    // No-op (and stripped) without Livewire. Range mode keeps its from/to hidden inputs.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) { $attributes = $attributes->whereDoesntStartWith('wire:model'); }
@endphp

<div
    data-slot="date-picker"
    x-data="{
        open: false,
        mode: @js($mode),
        value: @if ($hasWire && ! $isRange)@entangle($wireModel)@else @js($isRange ? null : $value)@endif,
        from: @js($fromDate), to: @js($toDate),
        minNights: @js($minNights !== null ? (int) $minNights : null),
        maxNights: @js($maxNights !== null ? (int) $maxNights : null),
        minDate: @js($min), maxDate: @js($max),
        weekStart: @js($weekStartNum),
        _keepOpen: false,   // presets apply without closing the popover, so the pick stays visible
        _pad(n) { return String(n).padStart(2, '0'); },
        _ymd(d) { return d.getFullYear() + '-' + this._pad(d.getMonth() + 1) + '-' + this._pad(d.getDate()); },
        // Resolve a preset to concrete {from, to} 'Y-m-d' strings. Literal specs win over named keys.
        presetDates(p) {
            if (p.date) return { from: p.date, to: p.date };
            if (p.from || p.to) return { from: p.from ?? null, to: p.to ?? null };
            const now = new Date();
            const t = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            const add = (d, n) => { const x = new Date(d); x.setDate(x.getDate() + n); return x; };
            const som = (d) => new Date(d.getFullYear(), d.getMonth(), 1);
            const sow = (d) => add(d, -(((d.getDay() - this.weekStart) % 7 + 7) % 7));
            const y = (d) => this._ymd(d);
            switch (p.key) {
                case 'today':      return { from: y(t), to: y(t) };
                case 'yesterday':  return { from: y(add(t, -1)), to: y(add(t, -1)) };
                case 'tomorrow':   return { from: y(add(t, 1)), to: y(add(t, 1)) };
                case 'thisWeek':   return { from: y(sow(t)), to: y(t) };
                case 'lastWeek':   { const s = add(sow(t), -7); return { from: y(s), to: y(add(s, 6)) }; }
                case 'last7Days':  return { from: y(add(t, -6)), to: y(t) };
                case 'last14Days': return { from: y(add(t, -13)), to: y(t) };
                case 'last30Days': return { from: y(add(t, -29)), to: y(t) };
                case 'thisMonth':  return { from: y(som(t)), to: y(t) };
                case 'lastMonth':  return { from: y(new Date(t.getFullYear(), t.getMonth() - 1, 1)), to: y(new Date(t.getFullYear(), t.getMonth(), 0)) };
                case 'thisYear':
                case 'yearToDate': return { from: y(new Date(t.getFullYear(), 0, 1)), to: y(t) };
                case 'allTime':    return { from: this.minDate || null, to: this.maxDate || y(t) };
                default:           return { from: null, to: null };
            }
        },
        applyPreset(p) {
            const { from, to } = this.presetDates(p);
            // $refs.cal is the flex wrapper (no x-data of its own, so the ref lands in THIS scope);
            // the calendar itself owns an x-data, so we reach its root element via its data-slot.
            const cal = this.$refs.cal && this.$refs.cal.querySelector('[data-slot=calendar]');
            if (!cal) return;
            // Non-bubbling dispatch on THIS calendar only — never leaks to other pickers on the page.
            this._keepOpen = true;
            if (this.mode === 'range') {
                cal.dispatchEvent(new CustomEvent('calendar:set-range', { detail: { from, to }, bubbles: false }));
            } else {
                const d = to || from;
                if (d) cal.dispatchEvent(new CustomEvent('calendar:set', { detail: d, bubbles: false }));
            }
            this._keepOpen = false;
        },
        isActivePreset(p) {
            const { from, to } = this.presetDates(p);
            return this.mode === 'range' ? (this.from === from && this.to === to) : (this.value === (to || from));
        },
        fmt(d) { return d ? new Date(d + 'T00:00:00').toLocaleDateString('default', { year: 'numeric', month: 'short', day: 'numeric' }) : ''; },
        nights() { return (this.from && this.to) ? Math.round((new Date(this.to + 'T00:00:00') - new Date(this.from + 'T00:00:00')) / 86400000) : null; },
        get errors() {
            const e = []; const n = this.nights();
            // Out-of-range dates — reachable only when outOfRange='flag' (else they're disabled).
            const lo = this.minDate, hi = this.maxDate;
            if (this.mode === 'range') {
                if (this.from && lo && this.from < lo) e.push('Start is before the earliest allowed date.');
                if (this.to && hi && this.to > hi) e.push('End is after the latest allowed date.');
            } else if (this.value) {
                if (lo && this.value < lo) e.push('Date is before the earliest allowed.');
                if (hi && this.value > hi) e.push('Date is after the latest allowed.');
            }
            if (n !== null && this.minNights !== null && n < this.minNights) e.push('Minimum ' + this.minNights + ' night' + (this.minNights > 1 ? 's' : '') + '.');
            if (n !== null && this.maxNights !== null && n > this.maxNights) e.push('Maximum ' + this.maxNights + ' night' + (this.maxNights > 1 ? 's' : '') + '.');
            return e;
        },
        get invalid() { return this.errors.length > 0; },
        get label() {
            if (this.mode === 'range') {
                if (!this.from) return '';
                return this.fmt(this.from) + ' – ' + (this.to ? this.fmt(this.to) : '…');
            }
            return this.value
                ? new Date(this.value + 'T00:00:00').toLocaleDateString('default', { year: 'numeric', month: 'long', day: 'numeric' })
                : '';
        },
    }"
    x-id="['blat-datepicker']"
    {{ $attributes->twMerge('relative '.$width) }}
>
    @if ($name)
        @if ($isRange)
            <input type="hidden" name="{{ $name }}[from]" :value="from" :aria-invalid="invalid ? 'true' : null">
            <input type="hidden" name="{{ $name }}[to]" :value="to" :aria-invalid="invalid ? 'true' : null">
        @else
            <input type="hidden" name="{{ $name }}" :value="value">
        @endif
    @endif

    <button
        type="button"
        x-ref="trigger"
        @click="open = !open"
        aria-haspopup="dialog"
        :aria-expanded="open"
        :aria-controls="$id('blat-datepicker')"
        :class="{ 'text-muted-foreground': !label }"
        :aria-invalid="invalid ? 'true' : null"
        class="{{ $width }} border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 items-center justify-start gap-2 rounded-md border bg-transparent px-3 py-2 text-start text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-transparent focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:border-destructive aria-invalid:ring-destructive/20"
    >
        <x-lucide-calendar class="size-4 opacity-50" aria-hidden="true" />
        <span class="truncate" x-text="label || @js($placeholder)"></span>
    </button>

    {{-- Teleported to <body> so the popover is never clipped by an overflow-hidden ancestor
         (a card, table cell, the docs preview…). x-anchor still positions it at the trigger. --}}
    <template x-teleport="body" wire:ignore>
    <div
        x-blat-dialog-layer
        x-show="open"
        x-cloak
        x-blat-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        {{-- Listener lives here (inside the teleported popover) so it catches the calendar's
             bubbling event; the popover shares the picker's x-data scope, so `value` updates. --}}
        @calendar-change="mode === 'range'
            ? (from = $event.detail.from, to = $event.detail.to, (!_keepOpen && from && to && !invalid) && (open = false))
            : (value = $event.detail, _keepOpen || (open = false))"
        x-trap="open"
        :id="$id('blat-datepicker')"
        role="dialog"
        aria-label="{{ $isRange ? 'Choose a date range' : 'Choose date' }}"
        tabindex="-1"
        class="bg-popover text-popover-foreground z-50 flex w-auto origin-top flex-col overflow-y-auto overscroll-contain rounded-md border p-0 shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <div x-ref="cal" class="flex flex-col sm:flex-row">
            @if ($hasPresets)
                <div class="flex shrink-0 flex-row gap-1 overflow-x-auto border-b p-2 sm:max-w-[9rem] sm:flex-col sm:gap-0.5 sm:overflow-visible sm:border-e sm:border-b-0"
                    role="group" aria-label="{{ __('Presets') }}">
                    @foreach ($presetList as $p)
                        <button
                            type="button"
                            @click="applyPreset(@js($p))"
                            :data-active="isActivePreset(@js($p))"
                            class="hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground focus-visible:ring-ring/50 inline-flex shrink-0 cursor-pointer items-center rounded-md px-2.5 py-1.5 text-start text-sm whitespace-nowrap transition-colors outline-none focus-visible:ring-[2px] sm:w-full"
                        >{{ $p['label'] }}</button>
                    @endforeach
                </div>
            @endif

            <x-ui.calendar
                :mode="$mode"
                :value="$calValue"
                :caption-layout="$captionLayout"
                :week-start="$weekStart"
                :number-of-months="$months"
                :default-month="$defaultMonth"
                :show-outside-days="$showOutsideDays"
                :min-date="$min"
                :max-date="$max"
                :out-of-range="$outOfRange"
                class="border-0"
            />
        </div>

        <template x-if="errors.length">
            <ul class="border-t px-3 py-2" role="alert">
                <template x-for="msg in errors" :key="msg">
                    <li class="text-destructive flex items-start gap-1 text-xs">
                        <x-lucide-circle-alert class="mt-0.5 size-3 shrink-0" aria-hidden="true" />
                        <span x-text="msg"></span>
                    </li>
                </template>
            </ul>
        </template>
    </div>
    </template>
</div>
