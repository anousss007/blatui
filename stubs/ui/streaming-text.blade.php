{{--
    Streaming Text — reveals a passage token-by-token (LLM-style), once.
      text        the full passage to stream (or use the slot)
      speed       ms per revealed chunk (default 18)
      startDelay  ms to wait before the first chunk appears (default 0)
      by          reveal granularity: 'char' or 'word' (default 'char')
      caret       show the blinking caret while streaming (default true)
      autostart   begin streaming on init (default true)
    Reduced-motion: shows the full passage immediately (no animation).
    A11y: the streamed copy is aria-hidden; an aria-live="polite" region carries the
          complete text up front, so assistive tech and no-JS get the whole passage.
--}}
@props([
    'text' => '',
    'speed' => 18,
    'startDelay' => 0,
    'by' => 'char',
    'caret' => true,
    'autostart' => true,
])

@php
    $full = trim((string) $text);
    if ($full === '') {
        $full = trim(strip_tags($slot));
    }
    $by = $by === 'word' ? 'word' : 'char';
@endphp

<span
    data-slot="streaming-text"
    x-data="{
        full: @js($full),
        by: @js($by),
        speed: @js(max(0, (int) $speed)),
        startDelay: @js(max(0, (int) $startDelay)),
        out: '',
        done: false,
        started: false,
        timer: null,
        units: [],
        idx: 0,
        init() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || this.full === '') {
                this.out = this.full;
                this.done = true;
                return;
            }
            this.units = this.by === 'word'
                ? this.full.match(/\s*\S+/g) || []
                : Array.from(this.full);
            if (@js((bool) $autostart)) {
                this.timer = setTimeout(() => this.start(), this.startDelay);
            }
        },
        start() {
            if (this.started || this.done) return;
            this.started = true;
            this.step();
        },
        step() {
            if (this.idx >= this.units.length) { this.finish(); return; }
            this.out += this.units[this.idx++];
            this.timer = setTimeout(() => this.step(), this.speed);
        },
        finish() {
            this.out = this.full;
            this.done = true;
        },
        destroy() {
            if (this.timer) clearTimeout(this.timer);
        }
    }"
    {{ $attributes->twMerge('inline whitespace-pre-wrap text-foreground') }}
>
    {{-- Complete text up front for a11y / SEO / no-JS; announced politely. --}}
    <span class="sr-only" aria-live="polite">{{ $full }}</span>

    {{-- Animated stream (hidden from assistive tech to avoid per-chunk chatter). --}}
    <span aria-hidden="true" x-text="out"></span>
    @if ($caret)
        <span
            x-show="! done"
            aria-hidden="true"
            class="animate-caret-blink ms-px inline-block h-[1em] w-[0.5em] translate-y-[0.12em] bg-primary align-text-bottom"
        ></span>
    @endif
</span>
