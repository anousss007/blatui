@props(['open' => false])

{{-- A sidebar link marked `current` reports becoming the page with `blat-current`: the group
     around it opens, wherever the visit came from. #54 --}}
<div
    data-slot="collapsible"
    x-on:blat-current="open = true"
    x-data="{ open: @js((bool) $open) }"
    x-id="['blat-collapsible']"
    {{ $attributes }}
>
    {{ $slot }}
</div>
