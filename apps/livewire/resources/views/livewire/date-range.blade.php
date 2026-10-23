<div>
    <h1 class="text-2xl font-bold">A range picker bound live, with :value</h1>

    <div class="mt-6 flex flex-wrap items-start gap-4">
        <x-ui.date-picker mode="range" :value="$dateRange" wire:model.live="dateRange" data-testid="range" />
        <x-ui.button wire:click="endsToday" data-testid="ends-today">Last 4 days</x-ui.button>
        {{-- The same property without :value: the calendar has to show the range it holds. --}}
        <x-ui.date-picker mode="range" wire:model.live="dateRange" data-testid="range-plain" />
    </div>
    <p class="mt-2 text-sm">
        from <span data-testid="echo-from">{{ $dateRange['from'] ?? '' }}</span>
        to <span data-testid="echo-to">{{ $dateRange['to'] ?? 'null' }}</span>
        · renders <span data-testid="renders">{{ $renders }}</span>
    </p>

    {{-- #52: the picker's locale reaches the calendar and the trigger. --}}
    <x-ui.date-picker locale="es" default-month="2026-10-01" wire:model.live="spanish" class="mt-6" data-testid="spanish" />

    {{-- Other components that carried their value in x-data, bound the same way. --}}
    <div class="mt-6 flex flex-wrap items-center gap-4">
        <x-ui.tags-input :value="$tags" wire:model.live="tags" data-testid="tags" />
        <x-ui.toggle-group type="single" :value="$view" wire:model.live="view" data-testid="view">
            <x-ui.toggle-group-item value="day">Day</x-ui.toggle-group-item>
            <x-ui.toggle-group-item value="week">Week</x-ui.toggle-group-item>
        </x-ui.toggle-group>
    </div>
</div>
