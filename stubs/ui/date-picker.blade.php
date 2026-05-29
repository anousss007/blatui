@props([
    'name' => null,
    'value' => null,
    'placeholder' => 'Pick a date',
    'width' => 'w-[240px]',
])

<div
    data-slot="date-picker"
    x-data="{
        open: false,
        value: @js($value),
        get label() {
            return this.value
                ? new Date(this.value + 'T00:00:00').toLocaleDateString('default', { year: 'numeric', month: 'long', day: 'numeric' })
                : '';
        }
    }"
    @calendar-change="value = $event.detail; open = false"
    {{ $attributes->twMerge('relative '.$width) }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif

    <button
        type="button"
        x-ref="trigger"
        @click="open = !open"
        :class="!value && 'text-muted-foreground'"
        class="{{ $width }} border-input dark:bg-input/30 dark:hover:bg-input/50 inline-flex h-9 items-center justify-start gap-2 rounded-md border bg-transparent px-3 py-2 text-left text-sm font-normal whitespace-nowrap shadow-xs transition-[color,box-shadow] outline-none hover:bg-transparent focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
    >
        <x-lucide-calendar class="size-4 opacity-50" />
        <span x-text="label || @js($placeholder)"></span>
    </button>

    <div
        x-show="open"
        x-cloak
        x-anchor.bottom-start.offset.4="$refs.trigger"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        x-trap="open"
        class="bg-popover text-popover-foreground z-50 w-auto origin-top overflow-hidden rounded-md border p-0 shadow-md"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
    >
        <x-ui.calendar :value="$value" class="border-0" />
    </div>
</div>
