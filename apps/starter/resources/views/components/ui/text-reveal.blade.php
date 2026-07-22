{{--
    Text Reveal — dims its words, then brightens them one by one as the element scrolls up
    through the viewport (the "scroll-linked text reveal" effect).
      as   the wrapper tag to render (default "p")
    Progressive enhancement: the full text is server-rendered at full opacity, so no-JS readers
    and crawlers get everything. With JS, the words dim and reveal on scroll.
    Reduced-motion: stays fully revealed (no dimming, no scroll listener).
    A11y: opacity only — the text stays in the DOM and fully readable by assistive tech.
--}}
@props(['as' => 'p'])

@php
    $text = trim(preg_replace('/\s+/', ' ', strip_tags($slot)));
    $words = $text === '' ? [] : explode(' ', $text);
    $tag = preg_replace('/[^a-z0-9]/i', '', (string) $as) ?: 'p';
@endphp

<{{ $tag }}
    data-slot="text-reveal"
    x-data="{
        total: {{ count($words) }},
        revealed: {{ count($words) }},
        apply() {
            this.$el.querySelectorAll('[data-w]').forEach((el, i) => {
                el.style.opacity = i < this.revealed ? '1' : '0.2';
            });
        },
        update() {
            const r = this.$el.getBoundingClientRect();
            const vh = window.innerHeight || document.documentElement.clientHeight;
            let p = (vh - r.top) / (vh - vh * 0.3);
            p = Math.max(0, Math.min(1, p));
            this.revealed = Math.round(p * this.total);
            this.apply();
        },
        init() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            this.revealed = 0;
            this.apply();
            const on = () => window.requestAnimationFrame(() => this.update());
            window.addEventListener('scroll', on, { passive: true });
            window.addEventListener('resize', on, { passive: true });
            this.update();
        }
    }"
    {{ $attributes->twMerge('leading-snug') }}
>@foreach ($words as $w)<span data-w class="transition-opacity duration-300 ease-out">{{ $w }}</span> @endforeach</{{ $tag }}>
