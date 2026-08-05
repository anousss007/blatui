@props([
    'mode' => 'single',
    'value' => null,
    'name' => null,
    'locale' => null,
    'numberOfMonths' => 1,
    'defaultMonth' => null,
    'weekStart' => 0,
    'captionLayout' => 'label',
    'showWeekNumber' => false,
    'disabled' => null,
    'min' => null,        // range duration bounds in DAYS (legacy name; prefer minDays/maxDays)
    'max' => null,
    'minDays' => null,    // explicit range-duration bounds in days (clearer than min/max)
    'maxDays' => null,
    'required' => false,
    'startMonth' => null,
    'endMonth' => null,
    'disableNavigation' => false,
    'modifiers' => [],
    'modifiersClass' => [],
    'buttonVariant' => 'ghost',
    'showOutsideDays' => true,
    'minDate' => null,   // out-of-range date bound (Y-m-d)
    'maxDate' => null,
    'outOfRange' => 'disable',  // 'disable' (prevent selection) | 'flag' (allow + show red)
    'prevMonthLabel' => null,   // nav accessible name; defaults via __() below (no hardcoded English)
    'nextMonthLabel' => null,
    'todayLabel' => null,       // day aria-label prefix for today; ":date" is the localised date
    'selectedLabel' => null,    // day aria-label suffix when the day is selected
    'calendarId' => null,       // instance handle for targeted calendar:* events (see below)
])

@php
    // i18n-safe defaults: these are translation keys, localise them in your lang files.
    $prevMonthLabel ??= __('Go to the previous month');
    $nextMonthLabel ??= __('Go to the next month');
    $todayLabel ??= __('Today, :date');
    $selectedLabel ??= __('selected');
    // Address a single calendar among several on the page: `calendar-id="search"` (or a plain
    // `id`) makes `calendar:set` & co. targetable and stamps outgoing calendar:updated events.
    $calendarId ??= $attributes->get('id');
    // weekStart accepts 0–6 (0 = Sunday) OR a day name ("sunday", "monday", …).
    $weekStartNum = is_numeric($weekStart)
        ? (((int) $weekStart % 7) + 7) % 7
        : (['sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6][strtolower(trim((string) $weekStart))] ?? 0);

    $cfg = array_filter([
        'mode' => $mode,
        'value' => $value,
        'calendarId' => $calendarId,
        'todayLabel' => $todayLabel,
        'selectedLabel' => $selectedLabel,
        'locale' => $locale,
        'numberOfMonths' => (int) $numberOfMonths,
        'weekStart' => $weekStartNum,
        'captionLayout' => $captionLayout,
        'showWeekNumber' => (bool) $showWeekNumber,
        'disableNavigation' => (bool) $disableNavigation,
        'min' => $min,
        'max' => $max,
        'minDays' => $minDays,
        'maxDays' => $maxDays,
        'minDate' => $minDate,
        'maxDate' => $maxDate,
        'outOfRange' => $outOfRange,
        'disabled' => $disabled,
        'defaultMonth' => $defaultMonth,
        'startMonth' => $startMonth,
        'endMonth' => $endMonth,
        'required' => (bool) $required,
        'modifiers' => $modifiers,
        'modifiersClass' => $modifiersClass,
    ], fn ($v) => $v !== null && $v !== false && $v !== []);

    $navBtn = 'inline-flex size-(--cell-size) items-center justify-center rounded-md p-0 text-sm transition-colors hover:bg-accent hover:text-accent-foreground aria-disabled:opacity-40 aria-disabled:pointer-events-none select-none';
    if ($buttonVariant === 'outline') {
        $navBtn = 'border-input hover:bg-accent hover:text-accent-foreground dark:bg-input/30 dark:border-input '.$navBtn.' border bg-transparent shadow-xs';
    }

    $dayBtn = implode(' ', [
        'relative inline-flex size-(--cell-size) select-none items-center justify-center rounded-md p-0 text-sm font-normal transition-colors',
        'hover:bg-accent hover:text-accent-foreground',
        'data-[today]:bg-accent data-[today]:text-accent-foreground',
        'data-[outside]:text-muted-foreground',
        'data-[disabled]:text-muted-foreground data-[disabled]:opacity-40 data-[disabled]:line-through data-[disabled]:pointer-events-none',
        // outOfRange="flag": selectable but flagged red (overridden by the selected/range styles below).
        'data-[out-of-range]:text-destructive data-[out-of-range]:hover:bg-destructive/10 data-[out-of-range]:hover:text-destructive',
        'data-[selected]:bg-primary data-[selected]:text-primary-foreground data-[selected]:hover:bg-primary data-[selected]:hover:text-primary-foreground',
        'data-[range-start]:bg-primary data-[range-start]:text-primary-foreground data-[range-start]:rounded-e-none',
        'data-[range-end]:bg-primary data-[range-end]:text-primary-foreground data-[range-end]:rounded-s-none',
        'data-[range-middle]:bg-accent data-[range-middle]:text-accent-foreground data-[range-middle]:rounded-none',
    ]);
@endphp

<div
    data-slot="calendar"
    x-data="calendar({{ \Illuminate\Support\Js::from($cfg) }})"
    {{-- Controlled mode: a parent can drive/observe the whole selection with x-model.
         <x-ui.calendar mode="range" x-model="stay" /> — the parent's value wins on mount,
         then the binding stays live both ways (no re-seeding on every popover open). --}}
    x-modelable="value"
    {{-- Day-cell size tracks the spacing scale, like the p-3 padding around the grid:
         8 × .25rem = 2rem at the default, so this changes nothing until --spacing does. --}}
    style="--cell-size: calc(var(--spacing) * 8);"
    @if ($calendarId) data-calendar-id="{{ $calendarId }}" @endif
    @unless ($showOutsideDays) data-hide-outside-days @endunless
    {{ $attributes->twMerge('group/calendar bg-background w-fit rounded-md border p-3') }}
>
    @if ($name)
        @if ($mode === 'single')
            <input type="hidden" name="{{ $name }}" :value="fmt(single)">
        @elseif ($mode === 'multiple')
            <input type="hidden" name="{{ $name }}" :value="multipleValue">
        @else
            <input type="hidden" name="{{ $name }}[from]" :value="fmt(rangeFrom)">
            <input type="hidden" name="{{ $name }}[to]" :value="fmt(rangeTo)">
        @endif
    @endif

    <div class="relative flex flex-col gap-4 md:flex-row">
        {{-- Navigation --}}
        <button type="button" @click="prev()" :aria-disabled="!canPrev" aria-label="{{ $prevMonthLabel }}" class="{{ $navBtn }} absolute start-0 top-0 z-10">
            <x-lucide-chevron-left class="size-4 rtl:rotate-180" aria-hidden="true" />
            <span class="sr-only">{{ $prevMonthLabel }}</span>
        </button>
        <button type="button" @click="next()" :aria-disabled="!canNext" aria-label="{{ $nextMonthLabel }}" class="{{ $navBtn }} absolute end-0 top-0 z-10">
            <x-lucide-chevron-right class="size-4 rtl:rotate-180" aria-hidden="true" />
            <span class="sr-only">{{ $nextMonthLabel }}</span>
        </button>

        {{-- Announce the visible month(s) to assistive tech on navigation --}}
        <span role="status" aria-live="polite" class="sr-only" x-text="months.map(m => monthLabel(m)).join(', ')"></span>

        <template x-for="(m, mi) in months" :key="fmt(m)">
            <div class="flex w-full flex-col gap-4">
                {{-- Caption --}}
                <div class="flex h-(--cell-size) items-center justify-center">
                    <template x-if="captionLayout === 'dropdown'">
                        <div class="flex items-center gap-1.5 text-sm font-medium">
                            <div class="relative rounded-md border border-input bg-background px-2 py-1 shadow-xs hover:bg-accent">
                                <select aria-label="{{ __('Month') }}" class="absolute inset-0 cursor-pointer opacity-0" @change="setMonth($event.target.value)">
                                    <template x-for="(mn, idx) in monthNames" :key="idx">
                                        <option :value="idx" :selected="idx === m.getMonth()" x-text="mn"></option>
                                    </template>
                                </select>
                                <span x-text="m.toLocaleString(locale, { month: 'long' })"></span>
                            </div>
                            <div class="relative rounded-md border border-input bg-background px-2 py-1 shadow-xs hover:bg-accent">
                                <select aria-label="{{ __('Year') }}" class="absolute inset-0 cursor-pointer opacity-0" @change="setYear($event.target.value)">
                                    <template x-for="y in years" :key="y">
                                        <option :value="y" :selected="y === m.getFullYear()" x-text="y"></option>
                                    </template>
                                </select>
                                <span x-text="m.getFullYear()"></span>
                            </div>
                        </div>
                    </template>
                    <template x-if="captionLayout !== 'dropdown'">
                        <div class="text-sm font-medium" x-text="monthLabel(m)"></div>
                    </template>
                </div>

                {{-- Grid --}}
                <table role="grid" aria-multiselectable="false" :aria-label="monthLabel(m)" class="w-full border-collapse">
                    <thead aria-hidden="true">
                        <tr class="flex">
                            @if ($showWeekNumber)
                                <th class="text-muted-foreground size-(--cell-size) text-[0.8rem] font-normal" scope="col"></th>
                            @endif
                            <template x-for="(wd, i) in weekdays" :key="i">
                                <th class="text-muted-foreground flex size-(--cell-size) flex-1 items-center justify-center text-[0.8rem] font-normal" scope="col" x-text="wd"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(week, wi) in weeksFor(m)" :key="fmt(week[0])">
                            <tr class="mt-1 flex w-full">
                                @if ($showWeekNumber)
                                    <td class="text-muted-foreground flex size-(--cell-size) items-center justify-center text-[0.8rem]" x-text="weekNumber(week)"></td>
                                @endif
                                <template x-for="(day, di) in week" :key="fmt(day)">
                                    <td role="gridcell" :aria-selected="isSelected(day)" class="relative flex-1 p-0 text-center">
                                        <button
                                            type="button"
                                            @click="select(day)"
                                            @keydown="onDayKeydown($event, day)"
                                            @mouseenter="if (mode === 'range') hover = day"
                                            x-text="day.getDate()"
                                            :data-day="fmt(day)"
                                            :tabindex="isFocused(day) ? 0 : -1"
                                            :aria-label="dayLabel(day)"
                                            :aria-disabled="isDisabled(day)"
                                            :data-selected="(mode !== 'range' && isSelected(day)) ? true : null"
                                            :data-range-start="(mode === 'range' && rangeIs(day).start) ? true : null"
                                            :data-range-middle="(mode === 'range' && rangeIs(day).middle) ? true : null"
                                            :data-range-end="(mode === 'range' && rangeIs(day).end) ? true : null"
                                            :data-today="isToday(day) ? true : null"
                                            :data-outside="day.__outside ? true : null"
                                            :data-disabled="isDisabled(day) ? true : null"
                                            :data-out-of-range="(outOfRange === 'flag' && isOutOfRange(day)) ? true : null"
                                            :class="modifierClass(day)"
                                            class="{{ $dayBtn }}"
                                        ></button>
                                    </td>
                                </template>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </template>
    </div>
</div>
