{{--
    Video — a styled HTML5 <video> with a custom poster/play facade.
      src       video URL (or pass <source>/<track> elements via the slot)
      poster    image shown before playback
      aspect    "video" (16/9, default), "square", or a custom ratio like "4/3"
      controls  native controls (default true) — revealed once playback starts
      autoplay/loop/muted  passthrough booleans (autoplay implies no play overlay)
      rounded   corner rounding utility (default rounded-xl)
    A11y: the <video> keeps native controls; the poster overlay is a labelled Play button.
--}}
@props([
    'src' => null,
    'poster' => null,
    'aspect' => 'video',
    'controls' => true,
    'autoplay' => false,
    'loop' => false,
    'muted' => false,
    'rounded' => 'rounded-xl',
])

@php
    $aspectClass = match ($aspect) {
        'square' => 'aspect-square',
        'video' => 'aspect-video',
        default => '',
    };
    $aspectStyle = $aspectClass === '' ? "aspect-ratio: {$aspect};" : '';
@endphp

<div
    data-slot="video"
    x-data="{ started: {{ $autoplay ? 'true' : 'false' }} }"
    {{ $attributes->twMerge('group bg-muted relative overflow-hidden border '.$rounded.' '.$aspectClass) }}
    @if ($aspectStyle) style="{{ $aspectStyle }}" @endif
>
    <video
        x-ref="player"
        class="size-full object-cover"
        @if ($poster) poster="{{ $poster }}" @endif
        @if ($controls) controls @endif
        @if ($autoplay) autoplay @endif
        @if ($loop) loop @endif
        @if ($muted) muted @endif
        playsinline
        preload="metadata"
        @play="started = true"
        @ended="started = false"
    >
        @if ($src)<source src="{{ $src }}" />@endif
        {{ $slot }}
        Your browser does not support the video tag.
    </video>

    @unless ($autoplay)
        <button
            type="button"
            x-show="! started"
            x-transition.opacity
            @click="$refs.player.play()"
            aria-label="Play video"
            class="absolute inset-0 grid place-items-center bg-black/20 outline-none transition-colors hover:bg-black/30 focus-visible:bg-black/30"
        >
            <span class="grid size-16 place-items-center rounded-full bg-white/90 text-black shadow-lg transition-transform group-hover:scale-105">
                <x-lucide-play class="size-7 translate-x-0.5 fill-current" />
            </span>
        </button>
    @endunless
</div>
