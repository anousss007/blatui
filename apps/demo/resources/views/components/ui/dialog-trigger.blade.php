{{-- for: when set, opens a dispatchable dialog defined elsewhere (decoupled from this
     trigger's scope) via $dispatch('open-dialog-{for}'). Otherwise opens the dialog in
     the same x-data scope (default Radix-style behavior). --}}
@props(['for' => null])

<span
    @if ($for)
        x-data
        @click="$dispatch('open-dialog-{{ $for }}')"
        aria-haspopup="dialog"
    @else
        @click="open = true"
        x-blat-trigger="{ haspopup: 'dialog', controls: $id('blat-dialog') }"
    @endif
    data-slot="dialog-trigger"
    {{ $attributes->twMerge('inline-block') }}
>
    {{ $slot }}
</span>
