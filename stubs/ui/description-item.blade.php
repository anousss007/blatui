@props([
    'term' => null,  // simple text term; or pass a term slot (x-slot:term) for richer markup
])

{{-- Inherit the parent <x-ui.description-list> layout/bordered props so each
     row lays itself out consistently without prop drilling. --}}
@aware([
    'layout' => 'horizontal',
    'bordered' => false,
])

@php
    $isHorizontal = $layout === 'horizontal';

    // Horizontal: on sm+ become a 2-part grid (term gets col 1, value spans the rest).
    // Vertical: term stacks above value with a small gap.
    $rowClasses = $isHorizontal
        ? 'grid gap-1 sm:grid-cols-3 sm:gap-4'
        : 'flex flex-col gap-1';

    // When bordered, the dividers come from the parent's divide-y, so each row
    // only needs inner padding. Logical block/inline padding keeps it RTL-safe.
    $rowClasses .= $bordered ? ' px-4 py-3' : '';
@endphp

<div data-slot="description-item" {{ $attributes->twMerge($rowClasses) }}>
    <dt @class(['text-muted-foreground text-sm', 'sm:col-span-1' => $isHorizontal])>
        {{ $term }}
    </dt>
    <dd @class(['text-foreground text-sm', 'sm:col-span-2' => $isHorizontal])>
        {{ $slot }}
    </dd>
</div>
