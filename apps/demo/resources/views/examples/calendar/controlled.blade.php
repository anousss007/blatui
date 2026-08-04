{{--
    Controlled calendar in a popover — the pattern a search bar needs: two triggers sharing
    ONE calendar, a value that is seeded up front, and quick-picks that push a range in.

    The two contracts that make this work without a re-entrancy flag:
      • x-model on the calendar keeps `stay` and the selection entangled both ways, so the
        popover never has to be re-seeded on open;
      • only a real day click emits `calendar-change`, so "close when the range is complete"
        can be written literally — seeding it (here, the quick-picks) leaves it open.
    A quick-pick is aimed at THIS calendar by id, so a second picker on the page is untouched.
--}}
<div
    x-data="{
        open: false,
        field: 'from',
        stay: { from: '{{ now()->addDays(7)->format('Y-m-d') }}', to: '{{ now()->addDays(12)->format('Y-m-d') }}' },
        fmt(d) { return d ? new Date(d + 'T00:00:00').toLocaleDateString(undefined, { day: 'numeric', month: 'short' }) : '—'; },
        show(which) { this.field = which; this.open = true; },
    }"
    {{-- Read the value off the event, not off `stay`: the entangled binding settles on
         Alpine's next tick, the event detail is authoritative right now. --}}
    @calendar:updated="$event.detail.source === 'select'
        && $event.detail.value.from && $event.detail.value.to && (open = false)"
    class="relative flex w-full max-w-md flex-col gap-3"
>
    <div class="border-input flex items-stretch rounded-md border shadow-xs">
        <button type="button" @click="show('from')" :data-active="open && field === 'from'"
            class="data-[active=true]:bg-accent flex-1 rounded-s-md px-3 py-2 text-start text-sm transition-colors">
            <span class="text-muted-foreground block text-xs">{{ __('Check in') }}</span>
            <span class="font-medium" x-text="fmt(stay.from)"></span>
        </button>
        <button type="button" @click="show('to')" :data-active="open && field === 'to'"
            class="data-[active=true]:bg-accent flex-1 rounded-e-md border-s px-3 py-2 text-start text-sm transition-colors">
            <span class="text-muted-foreground block text-xs">{{ __('Check out') }}</span>
            <span class="font-medium" x-text="fmt(stay.to)"></span>
        </button>
    </div>

    <div x-show="open" x-cloak @click.outside="open = false" @keydown.escape.window="open = false"
        class="bg-popover text-popover-foreground z-50 w-fit rounded-md border p-0 shadow-md">
        {{-- Quick-picks dispatch at one instance by id, so other calendars on the page ignore them. --}}
        <div class="flex flex-wrap gap-2 border-b p-2">
            @foreach ([__('This weekend') => [5, 7], __('Next week') => [7, 14]] as $label => $offsets)
                <x-ui.button variant="outline" size="sm"
                    x-on:click="$dispatch('calendar:set-range', {
                        id: 'stay',
                        from: '{{ now()->addDays($offsets[0])->format('Y-m-d') }}',
                        to: '{{ now()->addDays($offsets[1])->format('Y-m-d') }}',
                    })">{{ $label }}</x-ui.button>
            @endforeach
            <x-ui.button variant="ghost" size="sm" x-on:click="$dispatch('calendar:clear', { id: 'stay' })">
                {{ __('Clear') }}
            </x-ui.button>
        </div>

        <x-ui.calendar
            calendar-id="stay"
            mode="range"
            x-model="stay"
            week-start="monday"
            :number-of-months="2"
            :min-date="now()->format('Y-m-d')"
            :show-outside-days="false"
            class="border-0"
        />
    </div>

    <p class="text-muted-foreground text-xs">
        {{ __('Selected') }}: <span x-text="fmt(stay.from) + ' → ' + fmt(stay.to)"></span>
    </p>
</div>
