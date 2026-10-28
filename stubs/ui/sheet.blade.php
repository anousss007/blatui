{{--
    Sheet root. Holds the open state.
      open  initial open state
      id    optional — enables "dispatchable" mode: the sheet also opens/closes from
            anywhere via $dispatch('open-sheet-{id}') / $dispatch('close-sheet-{id}').
            Use <x-ui.sheet-trigger for="{id}"> from inside a @foreach/partial.
      wire:model  optional — binds the open state to a Livewire boolean, both ways (see
            dialog.blade.php).
--}}
@props(['open' => false, 'id' => null])

<div
    data-slot="sheet"
    x-data="{ open: @js((bool) $open) }"
    {{-- What wire:model binds to: Livewire's wire:model on an element that is not a form
         control goes through Alpine's x-modelable, so this one attribute is the whole bridge. --}}
    x-modelable="open"
    @if ($id)
        @open-sheet-{{ $id }}.window="open = true"
        @close-sheet-{{ $id }}.window="open = false"
    @endif
    x-id="['blat-sheet']"
    {{ $attributes }}
>
    {{ $slot }}
</div>
