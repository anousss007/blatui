@props([
    'name' => 'items',          // base field name → submits as name[index][key]
    'fields' => [],             // array of ['key'=>, 'label'=>, 'placeholder'?, 'type'?] describing the columns
    'value' => [],              // seed rows: array of associative arrays keyed by field key
    'min' => 1,                 // minimum number of rows (Remove disabled at this floor)
    'max' => null,              // maximum number of rows (Add disabled at this ceiling); null = unlimited
    'addLabel' => 'Add row',
])

@php
    // Normalise the field schema. Default to a single text field if none is given.
    $cols = collect($fields)
        ->map(fn ($f) => [
            'key' => $f['key'] ?? 'value',
            'label' => $f['label'] ?? \Illuminate\Support\Str::headline($f['key'] ?? 'Value'),
            'placeholder' => $f['placeholder'] ?? '',
            'type' => $f['type'] ?? 'text',
        ])
        ->values()
        ->all();

    if (empty($cols)) {
        $cols = [['key' => 'value', 'label' => \Illuminate\Support\Str::headline($name), 'placeholder' => '', 'type' => 'text']];
    }

    $keys = array_column($cols, 'key');

    // Build a blank row template (every key present, empty string) so Add appends a consistent shape.
    $blank = array_fill_keys($keys, '');

    // Seed the initial rows from `value`, coercing each entry to the field shape; pad up to `min`.
    $minRows = max(1, (int) $min);
    $seed = collect($value)
        ->map(fn ($row) => array_merge($blank, is_array($row) ? array_intersect_key($row, $blank) : ['value' => $row]))
        ->values()
        ->all();

    while (count($seed) < $minRows) {
        $seed[] = $blank;
    }

    $multi = count($cols) > 1;

    // Field classes mirror the input component (size = sm), kept inline so the component is self-contained.
    $fieldClasses = "file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none md:text-sm disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]";
@endphp

<div
    data-slot="repeater"
    x-data="{
        rows: @js($seed),
        keys: @js($keys),
        min: @js($minRows),
        max: @js($max !== null ? (int) $max : null),
        blank() {
            const r = {};
            this.keys.forEach((k) => (r[k] = ''));
            return r;
        },
        get canAdd() {
            return this.max === null || this.rows.length < this.max;
        },
        get canRemove() {
            return this.rows.length > this.min;
        },
        add() {
            if (!this.canAdd) return;
            this.rows.push(this.blank());
            // Move focus into the first input of the newly added row once it renders.
            this.$nextTick(() => {
                const fields = this.$refs.rows?.querySelectorAll('[data-repeater-row]');
                fields?.[fields.length - 1]?.querySelector('input, textarea, select')?.focus();
            });
        },
        remove(index) {
            if (!this.canRemove) return;
            this.rows.splice(index, 1);
        },
        rowLabel(index) {
            return @js($name) + ' row ' + (index + 1);
        },
        fieldId(index, key) {
            // Space-free, unique id so <label for> / aria associations validate.
            return (@js($name) + '-' + index + '-' + key).replace(/[^a-zA-Z0-9_-]/g, '-');
        },
    }"
    {{ $attributes->twMerge('flex w-full flex-col gap-3') }}
>
    <div x-ref="rows" class="flex flex-col gap-2">
        <template x-for="(row, index) in rows" :key="index">
            <div
                data-repeater-row
                @class([
                    'flex gap-2',
                    'flex-col sm:flex-row sm:items-end' => $multi,
                    'items-center' => ! $multi,
                ])
            >
                @foreach ($cols as $col)
                    <div @class(['flex flex-col gap-1.5', 'flex-1' => true])>
                        @if ($multi)
                            {{-- Per-column labels are visible only on the first row; later rows reuse them via aria-label. --}}
                            <label
                                data-slot="repeater-label"
                                x-show="index === 0"
                                class="text-sm leading-none font-medium select-none"
                                :for="fieldId(index, '{{ $col['key'] }}')"
                            >{{ $col['label'] }}</label>
                        @endif

                        @if ($col['type'] === 'textarea')
                            <textarea
                                data-slot="repeater-input"
                                x-bind:name="@js($name) + '[' + index + '][{{ $col['key'] }}]'"
                                x-model="row['{{ $col['key'] }}']"
                                rows="2"
                                placeholder="{{ $col['placeholder'] }}"
                                :aria-label="rowLabel(index) + ' {{ $col['label'] }}'"
                                :id="fieldId(index, '{{ $col['key'] }}')"
                                class="{{ $fieldClasses }} field-sizing-content min-h-16 py-2"
                            ></textarea>
                        @else
                            <input
                                type="{{ $col['type'] }}"
                                data-slot="repeater-input"
                                x-bind:name="@js($name) + '[' + index + '][{{ $col['key'] }}]'"
                                x-model="row['{{ $col['key'] }}']"
                                placeholder="{{ $col['placeholder'] }}"
                                :aria-label="rowLabel(index) + ' {{ $col['label'] }}'"
                                :id="fieldId(index, '{{ $col['key'] }}')"
                                class="{{ $fieldClasses }}"
                            />
                        @endif
                    </div>
                @endforeach

                {{-- Remove control: aria-labelled per row, disabled at the `min` floor. --}}
                <button
                    type="button"
                    data-slot="repeater-remove"
                    @click="remove(index)"
                    :disabled="!canRemove"
                    :aria-label="'Remove ' + rowLabel(index)"
                    @class([
                        'inline-flex size-9 shrink-0 items-center justify-center rounded-md border bg-background text-muted-foreground shadow-xs outline-none transition-colors not-disabled:cursor-pointer hover:bg-accent hover:text-accent-foreground focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50 dark:bg-input/30 dark:border-input dark:hover:bg-input/50',
                        'sm:mb-0' => $multi,
                    ])
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
        </template>
    </div>

    <div class="flex items-center gap-3">
        <button
            type="button"
            data-slot="repeater-add"
            @click="add()"
            :disabled="!canAdd"
            class="inline-flex h-8 items-center justify-center gap-1.5 rounded-md border bg-background px-3 text-sm font-medium shadow-xs outline-none transition-colors not-disabled:cursor-pointer hover:bg-accent hover:text-accent-foreground focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50 dark:bg-input/30 dark:border-input dark:hover:bg-input/50"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            {{ $addLabel }}
        </button>

        <span x-show="max !== null" class="text-muted-foreground text-xs" aria-hidden="true">
            <span x-text="rows.length"></span> / <span x-text="max"></span>
        </span>
    </div>
</div>
