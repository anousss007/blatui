@props([
    'name' => null,
    'id' => null,
    'value' => '',          // phone number (national part)
    'country' => 'US',      // default ISO country code
    'placeholder' => 'Phone number',
])

@php
    // A curated set of common countries (flag emoji + dial code). Extend as needed.
    $countries = [
        ['code' => 'US', 'name' => 'United States', 'dial' => '+1', 'flag' => '🇺🇸'],
        ['code' => 'GB', 'name' => 'United Kingdom', 'dial' => '+44', 'flag' => '🇬🇧'],
        ['code' => 'CA', 'name' => 'Canada', 'dial' => '+1', 'flag' => '🇨🇦'],
        ['code' => 'AU', 'name' => 'Australia', 'dial' => '+61', 'flag' => '🇦🇺'],
        ['code' => 'FR', 'name' => 'France', 'dial' => '+33', 'flag' => '🇫🇷'],
        ['code' => 'DE', 'name' => 'Germany', 'dial' => '+49', 'flag' => '🇩🇪'],
        ['code' => 'ES', 'name' => 'Spain', 'dial' => '+34', 'flag' => '🇪🇸'],
        ['code' => 'IT', 'name' => 'Italy', 'dial' => '+39', 'flag' => '🇮🇹'],
        ['code' => 'NL', 'name' => 'Netherlands', 'dial' => '+31', 'flag' => '🇳🇱'],
        ['code' => 'BE', 'name' => 'Belgium', 'dial' => '+32', 'flag' => '🇧🇪'],
        ['code' => 'IN', 'name' => 'India', 'dial' => '+91', 'flag' => '🇮🇳'],
        ['code' => 'JP', 'name' => 'Japan', 'dial' => '+81', 'flag' => '🇯🇵'],
        ['code' => 'BR', 'name' => 'Brazil', 'dial' => '+55', 'flag' => '🇧🇷'],
        ['code' => 'MX', 'name' => 'Mexico', 'dial' => '+52', 'flag' => '🇲🇽'],
        ['code' => 'MA', 'name' => 'Morocco', 'dial' => '+212', 'flag' => '🇲🇦'],
        ['code' => 'AE', 'name' => 'United Arab Emirates', 'dial' => '+971', 'flag' => '🇦🇪'],
    ];
@endphp

<div
    data-slot="phone-input"
    x-data="{
        open: false,
        country: @js($country),
        query: '',
        countries: @js($countries),
        get selected() { return this.countries.find(c => c.code === this.country) || this.countries[0] },
        get visible() {
            const q = this.query.toLowerCase().replace('+', '');
            if (!q) return this.countries;
            return this.countries.filter(c => c.name.toLowerCase().includes(q) || c.dial.replace('+', '').includes(q));
        },
        choose(code) { this.country = code; this.open = false; this.query = '' },
    }"
    {{ $attributes->twMerge('relative flex w-full max-w-xs') }}
>
    @if ($name)
        <input type="hidden" :name="@js($name) + '_country'" :value="country">
        <input type="hidden" :name="@js($name) + '_dial'" :value="selected.dial">
    @endif

    <button
        type="button"
        @click="open = !open"
        :aria-expanded="open"
        aria-label="Select country"
        class="border-input dark:bg-input/30 inline-flex h-9 shrink-0 items-center gap-1.5 rounded-l-md border border-r-0 bg-transparent px-3 text-sm shadow-xs outline-none focus-visible:z-10 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
    >
        <span class="text-base leading-none" x-text="selected.flag"></span>
        <span class="text-muted-foreground" x-text="selected.dial"></span>
        <x-lucide-chevron-down class="size-4 shrink-0 opacity-50 transition-transform" ::class="open && 'rotate-180'" aria-hidden="true" />
    </button>

    <input
        type="tel"
        @if ($id) id="{{ $id }}" @endif
        @if ($name) name="{{ $name }}" @endif
        value="{{ $value }}"
        inputmode="numeric"
        autocomplete="tel-national"
        placeholder="{{ $placeholder }}"
        class="border-input dark:bg-input/30 placeholder:text-muted-foreground flex h-9 w-full min-w-0 rounded-r-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:z-10 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] md:text-sm"
    >

    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        @keydown.escape.stop="open = false"
        class="bg-popover text-popover-foreground absolute top-full left-0 z-50 mt-1 w-64 overflow-hidden rounded-md border shadow-md"
    >
        <div class="flex h-9 items-center gap-2 border-b px-3">
            <x-lucide-search class="size-4 shrink-0 opacity-50" aria-hidden="true" />
            <input x-model="query" x-init="$watch('open', v => v && $nextTick(() => $el.focus()))" type="text" placeholder="Search country..." class="placeholder:text-muted-foreground w-full bg-transparent text-sm outline-none" />
        </div>
        <div class="max-h-60 overflow-y-auto p-1">
            <p x-show="visible.length === 0" class="py-6 text-center text-sm">No country found.</p>
            <template x-for="c in visible" :key="c.code">
                <button
                    type="button"
                    @click="choose(c.code)"
                    class="hover:bg-accent hover:text-accent-foreground flex w-full items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-hidden"
                    :class="c.code === country && 'bg-accent'"
                >
                    <span class="text-base leading-none" x-text="c.flag"></span>
                    <span class="truncate" x-text="c.name"></span>
                    <span class="text-muted-foreground ml-auto" x-text="c.dial"></span>
                </button>
            </template>
        </div>
    </div>
</div>
