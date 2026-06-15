{{--
    Number Ticker — animates a number counting up to a target when it scrolls into view.
      value      the target number to count up to (default 0)
      from       the starting number (default 0)
      duration   animation length in ms (default 1500)
      decimals   number of decimal places to show (default 0)
      prefix     text shown before the number (e.g. "$")
      suffix     text shown after the number (e.g. "%")
      separator  thousands separator (default ",")
    Scroll-trigger: a raw IntersectionObserver (created in x-init) starts the count the
      first time the element enters the viewport — no Alpine intersect plugin required.
      If IntersectionObserver is unavailable, the animation starts immediately.
    Reduced-motion: shows the final formatted value immediately (no count animation).
    A11y: the animating digits are aria-hidden; an sr-only span carries the final
      formatted value so assistive tech and no-JS read the real number.
--}}
@props([
    'value' => 0,
    'from' => 0,
    'duration' => 1500,
    'decimals' => 0,
    'prefix' => '',
    'suffix' => '',
    'separator' => ',',
])

@php
    $decimals = max(0, (int) $decimals);
    $finalFormatted = $prefix.number_format((float) $value, $decimals, '.', $separator).$suffix;
@endphp

<span
    data-slot="number-ticker"
    x-data="{
        value: @js((float) $value),
        from: @js((float) $from),
        duration: @js(max(0, (int) $duration)),
        decimals: @js($decimals),
        separator: @js((string) $separator),
        current: @js((float) $from),
        started: false,
        raf: null,
        format(n) {
            const parts = n.toFixed(this.decimals).split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, this.separator);
            return parts.join('.');
        },
        init() {
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || this.duration === 0) {
                this.current = this.value;
                this.started = true;
                return;
            }
            if (typeof IntersectionObserver === 'undefined') {
                this.run();
                return;
            }
            const io = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting && ! this.started) {
                        this.run();
                        io.disconnect();
                    }
                });
            }, { threshold: 0.2 });
            io.observe(this.$el);
        },
        run() {
            this.started = true;
            const start = performance.now();
            const delta = this.value - this.from;
            const tick = (now) => {
                const t = this.duration === 0 ? 1 : Math.min(1, (now - start) / this.duration);
                const eased = 1 - Math.pow(1 - t, 3);
                this.current = this.from + delta * eased;
                if (t < 1) {
                    this.raf = requestAnimationFrame(tick);
                } else {
                    this.current = this.value;
                }
            };
            this.raf = requestAnimationFrame(tick);
        },
        destroy() {
            if (this.raf) cancelAnimationFrame(this.raf);
        }
    }"
    {{ $attributes->twMerge('inline-block tabular-nums text-foreground') }}
>
    {{-- Final formatted value up front for a11y / SEO / no-JS. --}}
    <span class="sr-only">{{ $finalFormatted }}</span>

    {{-- Animated digits (hidden from assistive tech to avoid per-frame chatter). --}}
    <span aria-hidden="true">@if($prefix !== ''){{ $prefix }}@endif<span x-text="format(current)"></span>@if($suffix !== ''){{ $suffix }}@endif</span>
</span>
