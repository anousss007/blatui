{{--
    Dialog root. Holds the open state.
      open  initial open state
      id    optional — enables "dispatchable" mode: the dialog also opens/closes from
            anywhere via $dispatch('open-dialog-{id}') / $dispatch('close-dialog-{id}').
            Lets a trigger inside a @foreach/partial drive a single shared modal defined
            elsewhere (use <x-ui.dialog-trigger for="{id}"> or dispatch the event yourself).
      wire:model  optional — binds the open state to a Livewire boolean, both ways:
            `$this->open = true` opens it from the server, Escape / the overlay / a close
            button sets it back to false, and `$wire.open = true` opens it from the browser
            with no request at all. Deferred like any wire:model (.live sends each change).
--}}
@props(['open' => false, 'id' => null])

<div
    data-slot="dialog"
    x-data="{ open: @js((bool) $open) }"
    {{-- What wire:model binds to: Livewire's wire:model on an element that is not a form
         control goes through Alpine's x-modelable, so this one attribute is the whole bridge. --}}
    x-modelable="open"
    @if ($id)
        @open-dialog-{{ $id }}.window="open = true"
        @close-dialog-{{ $id }}.window="open = false"
    @endif
    x-id="['blat-dialog']"
    {{ $attributes }}
>
    {{ $slot }}
</div>
