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
    'min' => null,
    'max' => null,
    'required' => false,
    'startMonth' => null,
    'endMonth' => null,
    'disableNavigation' => false,
    'modifiers' => [],
    'modifiersClass' => [],
    'buttonVariant' => 'ghost',
])

@php
    $cfg = array_filter([
        'mode' => $mode,
        'value' => $value,
        'locale' => $locale,
        'numberOfMonths' => (int) $numberOfMonths,
        'weekStart' => (int) $weekStart,
        'captionLayout' => $captionLayout,
        'showWeekNumber' => (bool) $showWeekNumber,
        'disableNavigation' => (bool) $disableNavigation,
        'min' => $min,
        'max' => $max,
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
        'data-[outside]:text-muted-foreground data-[outside]:opacity-50',
        'data-[disabled]:text-muted-foreground data-[disabled]:opacity-50 data-[disabled]:pointer-events-none',
        'data-[selected]:bg-primary data-[selected]:text-primary-foreground data-[selected]:hover:bg-primary data-[selected]:hover:text-primary-foreground',
        'data-[range-start]:bg-primary data-[range-start]:text-primary-foreground data-[range-start]:rounded-r-none',
        'data-[range-end]:bg-primary data-[range-end]:text-primary-foreground data-[range-end]:rounded-l-none',
        'data-[range-middle]:bg-accent data-[range-middle]:text-accent-foreground data-[range-middle]:rounded-none',
    ]);
@endphp

<div
    data-slot="calendar"
    x-data="calendar({{ \Illuminate\Support\Js::from($cfg) }})"
    style="--cell-size: 2rem;"
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
        <button type="button" @click="prev()" :aria-disabled="!canPrev" class="{{ $navBtn }} absolute left-0 top-0 z-10">
            <x-lucide-chevron-left class="size-4" />
            <span class="sr-only">Previous month</span>
        </button>
        <button type="button" @click="next()" :aria-disabled="!canNext" class="{{ $navBtn }} absolute right-0 top-0 z-10">
            <x-lucide-chevron-right class="size-4" />
            <span class="sr-only">Next month</span>
        </button>

        <template x-for="(m, mi) in months" :key="mi">
            <div class="flex w-full flex-col gap-4">
                {{-- Caption --}}
                <div class="flex h-(--cell-size) items-center justify-center">
                    <template x-if="captionLayout === 'dropdown'">
                        <div class="flex items-center gap-1.5 text-sm font-medium">
                            <div class="relative rounded-md border border-input bg-background px-2 py-1 shadow-xs hover:bg-accent">
                                <select class="absolute inset-0 cursor-pointer opacity-0" @change="setMonth($event.target.value)">
                                    <template x-for="(mn, idx) in monthNames" :key="idx">
                                        <option :value="idx" :selected="idx === m.getMonth()" x-text="mn"></option>
                                    </template>
                                </select>
                                <span x-text="m.toLocaleString(locale, { month: 'long' })"></span>
                            </div>
                            <div class="relative rounded-md border border-input bg-background px-2 py-1 shadow-xs hover:bg-accent">
                                <select class="absolute inset-0 cursor-pointer opacity-0" @change="setYear($event.target.value)">
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
                <table class="w-full border-collapse">
                    <thead>
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
                        <template x-for="(week, wi) in weeksFor(m)" :key="wi">
                            <tr class="mt-1 flex w-full">
                                @if ($showWeekNumber)
                                    <td class="text-muted-foreground flex size-(--cell-size) items-center justify-center text-[0.8rem]" x-text="weekNumber(week)"></td>
                                @endif
                                <template x-for="(day, di) in week" :key="di">
                                    <td class="relative flex-1 p-0 text-center">
                                        <button
                                            type="button"
                                            @click="select(day)"
                                            @mouseenter="if (mode === 'range') hover = day"
                                            x-text="day.getDate()"
                                            :data-selected="(mode !== 'range' && isSelected(day)) ? true : null"
                                            :data-range-start="(mode === 'range' && rangeIs(day).start) ? true : null"
                                            :data-range-middle="(mode === 'range' && rangeIs(day).middle) ? true : null"
                                            :data-range-end="(mode === 'range' && rangeIs(day).end) ? true : null"
                                            :data-today="isToday(day) ? true : null"
                                            :data-outside="isOutside(day, m) ? true : null"
                                            :data-disabled="isDisabled(day) ? true : null"
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
