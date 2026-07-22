{{--
    Alert-dialog root (confirm). Holds the open state.
      open  initial open state
      id    optional — enables "dispatchable" mode: opens/closes from anywhere via
            $dispatch('open-alert-dialog-{id}') / $dispatch('close-alert-dialog-{id}').
            Ideal for a single shared confirm driven by per-row delete buttons in a
            @foreach (use <x-ui.alert-dialog-trigger for="{id}">). Pass row context in the
            event detail and read it from $event.detail in the dialog scope.
--}}
@props(['open' => false, 'id' => null])

<div
    data-slot="alert-dialog"
    x-data="{ open: @js((bool) $open) }"
    @if ($id)
        @open-alert-dialog-{{ $id }}.window="open = true"
        @close-alert-dialog-{{ $id }}.window="open = false"
    @endif
    x-id="['blat-alert-dialog']"
    {{ $attributes }}
>
    {{ $slot }}
</div>
