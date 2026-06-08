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
@endphp

<div
    data-slot="date-picker"
    x-data="{
        open: false,
        mode: @js($mode),
        value: @js($isRange ? null : $value),
        from: @js($fromDate), to: @js($toDate),
        minNights: @js($minNights !== null ? (int) $minNights : null),
        maxNights: @js($maxNights !== null ? (int) $maxNights : null),
        minDate: @js($min), maxDate: @js($max),
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
        class="{{ $width }} border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 items-center justify-start gap-2 rounded-md border bg-transparent px-3 py-2 text-left text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-transparent focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:border-destructive aria-invalid:ring-destructive/20"
    >
        <x-lucide-calendar class="size-4 opacity-50" aria-hidden="true" />
        <span class="truncate" x-text="label || @js($placeholder)"></span>
    </button>

    {{-- Teleported to <body> so the popover is never clipped by an overflow-hidden ancestor
         (a card, table cell, the docs preview…). x-anchor still positions it at the trigger. --}}
    <template x-teleport="body">
    <div
        x-show="open"
        x-cloak
        x-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        {{-- Listener lives here (inside the teleported popover) so it catches the calendar's
             bubbling event; the popover shares the picker's x-data scope, so `value` updates. --}}
        @calendar-change="mode === 'range'
            ? (from = $event.detail.from, to = $event.detail.to, (from && to && !invalid) && (open = false))
            : (value = $event.detail, open = false)"
        x-trap="open"
        :id="$id('blat-datepicker')"
        role="dialog"
        aria-label="{{ $isRange ? 'Choose a date range' : 'Choose date' }}"
        tabindex="-1"
        class="bg-popover text-popover-foreground z-50 w-auto origin-top overflow-hidden rounded-md border p-0 shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
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
