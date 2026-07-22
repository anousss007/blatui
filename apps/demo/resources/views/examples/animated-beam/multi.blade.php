{{--
    Hub-and-spoke: a central node connected to three satellites by three beams.

    Each <x-ui.animated-beam> measures endpoints WITHIN its own root, so we stack three
    instances that all contain the same layout. The first layer renders the visible tiles;
    the others are absolutely overlaid and their tiles are made `invisible` (they still take
    up layout, so their centres line up exactly with the base layer for correct measurement).

    Endpoints are marked with data-* attributes (not ids) so the three stacked copies don't
    create duplicate-id a11y violations. The component accepts any CSS selector for from/to.
--}}
@php
    // The shared hub-and-spoke layout, reused by every beam layer so endpoints align.
    $hubLayout = function (bool $visible) {
        $tile = $visible ? '' : 'invisible';
        return <<<HTML
        <div class="grid grid-cols-3 items-center gap-8">
            <div class="flex flex-col gap-8">
                <div data-node="sat-1" class="{$tile} bg-background text-foreground flex size-12 items-center justify-center rounded-xl border shadow-sm">S1</div>
                <div data-node="sat-2" class="{$tile} bg-background text-foreground flex size-12 items-center justify-center rounded-xl border shadow-sm">S2</div>
            </div>
            <div class="flex justify-center">
                <div data-node="center" class="{$tile} bg-primary text-primary-foreground flex size-16 items-center justify-center rounded-2xl shadow-md">Hub</div>
            </div>
            <div class="flex justify-center">
                <div data-node="sat-3" class="{$tile} bg-background text-foreground flex size-12 items-center justify-center rounded-xl border shadow-sm">S3</div>
            </div>
        </div>
        HTML;
    };
@endphp

<div class="relative mx-auto max-w-md py-6">
    {{-- Base layer: visible tiles + the first beam (hub -> satellite 1). --}}
    <x-ui.animated-beam from="[data-node=center]" to="[data-node=sat-1]" :curvature="-30" class="relative">
        {!! $hubLayout(true) !!}
    </x-ui.animated-beam>

    {{-- Overlay beams: same layout (tiles invisible), each drawing one more spoke. --}}
    <x-ui.animated-beam from="[data-node=center]" to="[data-node=sat-2]" :curvature="30" :duration="3.6" class="absolute inset-0">
        {!! $hubLayout(false) !!}
    </x-ui.animated-beam>

    <x-ui.animated-beam from="[data-node=center]" to="[data-node=sat-3]" :duration="2.4" class="absolute inset-0">
        {!! $hubLayout(false) !!}
    </x-ui.animated-beam>
</div>
