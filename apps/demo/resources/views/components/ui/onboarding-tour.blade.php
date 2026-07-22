{{--
    onboarding-tour — a guided product tour (spotlight coachmarks).

    @props
      steps   array of steps. Each step:
                  target      '#css-selector' of the element to spotlight (querySelector)
                  title       string — the step heading (used as the dialog's accessible name)
                  body        string — the step description
                  placement?  'bottom' (default) | 'top' | 'left' | 'right' — preferred card side
      open    bool — start the tour immediately. Prefer a "Start tour" button (set open via
              x-data / an event) so the page isn't permanently covered on first paint.

    Drive it from outside with the bound Alpine store: this component dispatches nothing, but
    you can open it by setting `open = true` on a shared scope, or render it with :open="true".

    A11y: the step card is role="dialog" aria-modal="true", named by its title and described by
    its body; focus moves into the card every step; Escape / Skip ends the tour; Back / Next /
    Finish / Skip are real <button>s. The spotlit target is referenced via aria-describedby on
    the dialog (the title/body live in the dialog itself). RTL-safe (logical insets / no l-r math).
--}}
@props([
    'steps' => [],
    'open' => false,
])

@php
    // Normalise steps server-side so the JS driver gets a clean, predictable shape.
    $normalized = [];
    foreach ($steps as $s) {
        $normalized[] = [
            'target' => $s['target'] ?? null,
            'title' => $s['title'] ?? '',
            'body' => $s['body'] ?? '',
            'placement' => $s['placement'] ?? 'bottom',
        ];
    }
@endphp

<div
    data-slot="onboarding-tour"
    x-id="['blat-tour-title', 'blat-tour-body']"
    x-data="{
        steps: @js($normalized),
        index: 0,
        active: @js((bool) $open),
        rect: { top: 0, left: 0, width: 0, height: 0 },
        card: { top: 0, left: 0, placement: 'bottom' },
        gap: 12,
        get step() { return this.steps[this.index] || {}; },
        get count() { return this.steps.length; },
        get isFirst() { return this.index === 0; },
        get isLast() { return this.index >= this.count - 1; },
        get hasTarget() { return this.rect.width > 0 || this.rect.height > 0; },
        start() {
            if (!this.count) return;
            this.index = 0;
            this.active = true;
            this.$nextTick(() => this.go());
        },
        go() {
            const sel = this.step.target;
            const el = sel ? document.querySelector(sel) : null;
            if (el) {
                try { el.scrollIntoView({ block: 'center', inline: 'center', behavior: 'smooth' }); } catch (e) { el.scrollIntoView(); }
                this.measure(el);
            } else {
                // No target found: center the card and skip the spotlight for this step.
                this.rect = { top: 0, left: 0, width: 0, height: 0 };
            }
            this.recompute();
            this.$nextTick(() => this.focusCard());
        },
        measure(el) {
            const r = el.getBoundingClientRect();
            const pad = 6;
            this.rect = {
                top: r.top - pad,
                left: r.left - pad,
                width: r.width + pad * 2,
                height: r.height + pad * 2,
            };
        },
        recompute() {
            // Re-measure the live target (rect can drift after scroll/resize) and place the card.
            const sel = this.step.target;
            const el = sel ? document.querySelector(sel) : null;
            if (el) this.measure(el);

            const cardEl = this.$refs.cardEl;
            const cw = cardEl ? cardEl.offsetWidth : 320;
            const ch = cardEl ? cardEl.offsetHeight : 160;
            const vw = window.innerWidth;
            const vh = window.innerHeight;
            const m = 12; // viewport margin

            if (!this.hasTarget) {
                this.card = { top: Math.max(m, (vh - ch) / 2), left: Math.max(m, (vw - cw) / 2), placement: 'center' };
                return;
            }

            const r = this.rect;
            let placement = this.step.placement || 'bottom';
            let top, left;

            const place = (p) => {
                switch (p) {
                    case 'top':    return { top: r.top - ch - this.gap, left: r.left + r.width / 2 - cw / 2 };
                    case 'left':   return { top: r.top + r.height / 2 - ch / 2, left: r.left - cw - this.gap };
                    case 'right':  return { top: r.top + r.height / 2 - ch / 2, left: r.left + r.width + this.gap };
                    default:       return { top: r.top + r.height + this.gap, left: r.left + r.width / 2 - cw / 2 };
                }
            };

            // Flip to the opposite side if the preferred placement overflows the viewport.
            let p = place(placement);
            if (placement === 'bottom' && p.top + ch > vh - m) { placement = 'top'; p = place('top'); }
            else if (placement === 'top' && p.top < m) { placement = 'bottom'; p = place('bottom'); }
            else if (placement === 'right' && p.left + cw > vw - m) { placement = 'left'; p = place('left'); }
            else if (placement === 'left' && p.left < m) { placement = 'right'; p = place('right'); }

            top = Math.min(Math.max(m, p.top), vh - ch - m);
            left = Math.min(Math.max(m, p.left), vw - cw - m);
            this.card = { top, left, placement };
        },
        focusCard() {
            const c = this.$refs.cardEl;
            if (c) c.focus({ preventScroll: true });
        },
        next() { if (this.isLast) { this.end(); } else { this.index++; this.go(); } },
        back() { if (!this.isFirst) { this.index--; this.go(); } },
        end() { this.active = false; },
    }"
    x-init="if (active) start()"
    @keydown.escape.window="active && end()"
    @resize.window="active && recompute()"
    @scroll.window.passive="active && recompute()"
    {{ $attributes->twMerge('contents') }}
>
    {{-- Author-supplied trigger UI (e.g. a "Start tour" button) renders here. --}}
    {{ $slot }}

    <template x-teleport="body">
        <div x-show="active" x-cloak class="fixed inset-0 z-[100]" role="presentation">
            {{-- Spotlight cutout: a transparent box over the target whose huge box-shadow dims
                 everything else. When there's no target, fall back to a flat dimming overlay. --}}
            <div
                x-show="active && hasTarget"
                data-slot="onboarding-tour-spotlight"
                aria-hidden="true"
                class="pointer-events-none fixed rounded-lg ring-2 ring-ring transition-all duration-200 ease-out"
                style="box-shadow: 0 0 0 9999px rgb(0 0 0 / 0.6);"
                :style="`top:${rect.top}px; left:${rect.left}px; width:${rect.width}px; height:${rect.height}px; box-shadow: 0 0 0 9999px rgb(0 0 0 / 0.6);`"
            ></div>

            <div
                x-show="active && !hasTarget"
                data-slot="onboarding-tour-overlay"
                aria-hidden="true"
                class="fixed inset-0 bg-foreground/50"
            ></div>

            {{-- The step card / coachmark. --}}
            <div
                x-ref="cardEl"
                x-show="active"
                x-trap="active"
                tabindex="-1"
                role="dialog"
                aria-modal="true"
                data-slot="onboarding-tour-card"
                :aria-labelledby="$id('blat-tour-title')"
                :aria-describedby="$id('blat-tour-body')"
                :data-placement="card.placement"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="bg-popover text-popover-foreground fixed z-[101] w-[min(20rem,calc(100vw-1.5rem))] rounded-lg border p-4 shadow-lg outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                :style="`top:${card.top}px; left:${card.left}px;`"
            >
                <div class="flex flex-col gap-1.5">
                    <p class="text-muted-foreground text-xs font-medium" aria-hidden="true">
                        <span x-text="index + 1"></span> of <span x-text="count"></span>
                    </p>
                    <h2 :id="$id('blat-tour-title')" data-slot="onboarding-tour-title" class="text-sm leading-none font-semibold" x-text="step.title"></h2>
                    <p :id="$id('blat-tour-body')" data-slot="onboarding-tour-body" class="text-muted-foreground text-sm" x-text="step.body"></p>
                </div>

                {{-- Step dots --}}
                <div class="mt-3 flex items-center gap-1.5" aria-hidden="true">
                    <template x-for="i in count" :key="i">
                        <span
                            class="size-1.5 rounded-full transition-colors"
                            :class="(i - 1) === index ? 'bg-primary' : 'bg-muted-foreground/30'"
                        ></span>
                    </template>
                </div>

                <div class="mt-4 flex items-center justify-between gap-2">
                    <button
                        type="button"
                        @click="end()"
                        data-slot="onboarding-tour-skip"
                        class="text-muted-foreground hover:text-foreground inline-flex h-8 items-center rounded-md px-2 text-sm font-medium transition-colors outline-none focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                    >Skip</button>

                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            x-show="!isFirst"
                            @click="back()"
                            data-slot="onboarding-tour-back"
                            class="border-input bg-background hover:bg-accent hover:text-accent-foreground inline-flex h-8 items-center rounded-md border px-3 text-sm font-medium shadow-xs transition-colors outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        >Back</button>
                        <button
                            type="button"
                            @click="next()"
                            data-slot="onboarding-tour-next"
                            class="bg-primary text-primary-foreground hover:bg-primary/90 inline-flex h-8 items-center rounded-md px-3 text-sm font-medium shadow-xs transition-colors outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                        >
                            <span x-show="!isLast">Next</span>
                            <span x-show="isLast">Done</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
