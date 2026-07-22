{{--
    Marquee — seamless infinite scroll of its slot content (logos, testimonials, badges…).
      direction     left | right | up | down  (up/down need a fixed height on the element)
      duration      CSS time for one full loop (e.g. "40s")
      gap           spacing between items / between the two groups (CSS length)
      pauseOnHover  pause the scroll on hover (default true)
      fade          fade the leading/trailing edges with a mask
    Reduced-motion: the animation is disabled under prefers-reduced-motion (content stays put).
    A11y: the second (duplicate) group is aria-hidden so screen readers read the content once.
--}}
@props([
    'direction' => 'left',
    'duration' => '40s',
    'gap' => '1rem',
    'pauseOnHover' => true,
    'fade' => false,
])

@php
    $vertical = in_array($direction, ['up', 'down'], true);
    $reverse = in_array($direction, ['right', 'down'], true);
    $anim = $vertical ? 'blat-marquee-y' : 'blat-marquee-x';
    $flexDir = $vertical ? 'flex-col' : 'flex-row';
    $padSide = $vertical ? 'padding-bottom' : 'padding-right';
    $fadeMask = ! $fade ? '' : ($vertical
        ? '[mask-image:linear-gradient(to_bottom,transparent,#000_12%,#000_88%,transparent)]'
        : '[mask-image:linear-gradient(to_right,transparent,#000_12%,#000_88%,transparent)]');
    $groupStyle = "gap: {$gap}; {$padSide}: {$gap};";
@endphp

<div data-slot="marquee" data-direction="{{ $direction }}" {{ $attributes->twMerge('group/marquee relative flex overflow-hidden '.($vertical ? 'flex-col' : 'flex-row').' '.$fadeMask) }}>
    <div
        class="flex {{ $flexDir }} w-max shrink-0 {{ $vertical ? 'h-max' : '' }} {{ $pauseOnHover ? 'hover:[animation-play-state:paused]' : '' }} motion-reduce:!animate-none"
        style="animation: {{ $anim }} {{ $duration }} linear infinite{{ $reverse ? ' reverse' : '' }};"
    >
        <div class="flex {{ $flexDir }} shrink-0 items-center justify-around" style="{{ $groupStyle }}">{{ $slot }}</div>
        <div class="flex {{ $flexDir }} shrink-0 items-center justify-around" aria-hidden="true" style="{{ $groupStyle }}">{{ $slot }}</div>
    </div>
</div>
