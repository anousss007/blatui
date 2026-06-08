{{--
    Typewriter — types and deletes a cycling list of words (hero headlines, role taglines…).
      words       array of phrases to cycle through (e.g. :words="['design','build','ship']")
      typeSpeed   ms per typed character (default 90)
      deleteSpeed ms per deleted character (default 40)
      pause       ms to hold a fully-typed word before deleting (default 1600)
      loop        cycle forever (default true); when false, stops on the last word
      cursor      show the blinking caret (default true)
    Reduced-motion: shows the first word statically (no animation).
    A11y: the animated text is aria-hidden; a visually-hidden span carries the full word list,
          so assistive tech reads the content once instead of every keystroke.
--}}
@props([
    'words' => [],
    'typeSpeed' => 90,
    'deleteSpeed' => 40,
    'pause' => 1600,
    'loop' => true,
    'cursor' => true,
])

@php
    $words = is_array($words)
        ? array_values(array_filter(array_map(fn ($w) => trim((string) $w), $words), fn ($w) => $w !== ''))
        : [];
    if (empty($words)) {
        $fallback = trim(strip_tags($slot));
        $words = $fallback !== '' ? [$fallback] : [];
    }
@endphp

<span
    data-slot="typewriter"
    x-data="{
        words: @js($words),
        i: 0,
        out: '',
        del: false,
        done: false,
        init() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || this.words.length === 0) {
                this.out = this.words[0] ?? '';
                this.done = true;
                return;
            }
            this.tick();
        },
        tick() {
            const word = this.words[this.i % this.words.length] ?? '';
            if (! this.del) {
                this.out = word.slice(0, this.out.length + 1);
                if (this.out === word) {
                    if (! {{ $loop ? 'true' : 'false' }} && this.i === this.words.length - 1) { this.done = true; return; }
                    this.del = true;
                    setTimeout(() => this.tick(), {{ (int) $pause }});
                    return;
                }
                setTimeout(() => this.tick(), {{ (int) $typeSpeed }});
            } else {
                this.out = word.slice(0, this.out.length - 1);
                if (this.out === '') { this.del = false; this.i++; }
                setTimeout(() => this.tick(), {{ (int) $deleteSpeed }});
            }
        }
    }"
    {{ $attributes->twMerge('inline-flex items-baseline whitespace-pre') }}
>
    <span aria-hidden="true" x-text="out"></span>
    @if ($cursor)
        <span x-show="! done" aria-hidden="true" class="animate-caret-blink ms-px inline-block h-[1em] w-[2px] translate-y-[0.12em] bg-current"></span>
    @endif
    <span class="sr-only">{{ implode(', ', $words) }}</span>
</span>
