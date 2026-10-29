{{--
    Alert-dialog root (confirm). Holds the open state.
      open  initial open state
      id    optional — enables "dispatchable" mode: opens/closes from anywhere via
            $dispatch('open-alert-dialog-{id}') / $dispatch('close-alert-dialog-{id}').
            Ideal for a single shared confirm driven by per-row delete buttons in a
            @foreach (use <x-ui.alert-dialog-trigger for="{id}">). Pass row context in the
            event detail and read it from $event.detail in the dialog scope.
      wire:model  optional — binds the open state to a Livewire boolean, both ways (see
            dialog.blade.php).
--}}
@props(['open' => false, 'id' => null])

<div
    data-slot="alert-dialog"
    x-data="{ open: @js((bool) $open) }"
    {{-- What wire:model binds to: Livewire's wire:model on an element that is not a form
         control goes through Alpine's x-modelable, so this one attribute is the whole bridge. --}}
    x-modelable="open"
    @if ($id)
        @open-alert-dialog-{{ $id }}.window="open = true"
        @close-alert-dialog-{{ $id }}.window="open = false"
    @endif
    x-id="['blat-alert-dialog']"
    {{ $attributes }}
>
    {{ $slot }}
</div>
