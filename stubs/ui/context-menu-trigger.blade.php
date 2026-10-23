@php
    // A consumer x-init runs after the component's own: two x-init attributes on one element
    // and the browser keeps only the first, silently dropping the consumer's (issue #46).
    $xInit = $attributes->get('x-init');
    $attributes = $attributes->except('x-init');
@endphp

<div
    data-slot="context-menu-trigger"
    x-init="_trigger = $el{{ $xInit ? '; '.$xInit : '' }}"
    tabindex="-1"
    @contextmenu="openAt($event)"
    {{ $attributes->twMerge('outline-none') }}
>
    {{ $slot }}
</div>
