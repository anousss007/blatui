{{-- for: when set, opens a dispatchable alert-dialog defined elsewhere via
     $dispatch('open-alert-dialog-{for}'). Pass row context in the event detail:
     x-on:click="$dispatch('open-alert-dialog-{for}', { id: row.id })". Otherwise opens
     the alert-dialog in the same scope. --}}
@props(['for' => null])

<span
    @if ($for)
        x-data
        @click="$dispatch('open-alert-dialog-{{ $for }}')"
        aria-haspopup="dialog"
    @else
        @click="open = true"
        x-blat-trigger="{ haspopup: 'dialog', controls: $id('blat-alert-dialog') }"
    @endif
    data-slot="alert-dialog-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
