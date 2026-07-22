{{--
    Sonner toaster. Listens for window 'toast' events (use window.toast(...) — see blatui-core.js).
      position  top/bottom + left/center/right (default bottom-right)
      expand    keep toasts always expanded as a list. Default false → collapsed stack that
                fans out on hover/focus (Sonner-style).
    A11y: region labelled "Notifications"; each toast is a status/alert with aria-live; the stack
          expands on focus-within so keyboard users can reach every toast's close button.
--}}
@props([
    'position' => 'bottom-right',
    'expand' => false,
])

@php
    $positions = [
        'top-left' => 'top-0 left-0 sm:items-start',
        'top-center' => 'top-0 left-1/2 -translate-x-1/2 sm:items-center',
        'top-right' => 'top-0 right-0 sm:items-end',
        'bottom-left' => 'bottom-0 left-0 sm:items-start',
        'bottom-center' => 'bottom-0 left-1/2 -translate-x-1/2 sm:items-center',
        'bottom-right' => 'bottom-0 right-0 sm:items-end',
    ];
    $isTop = str_starts_with($position, 'top');
    $posClass = $positions[$position] ?? $positions['bottom-right'];
    $anchor = $isTop ? 'top-0' : 'bottom-0';
    $origin = $isTop ? 'origin-top' : 'origin-bottom';
@endphp

<div
    data-slot="sonner-toaster"
    x-data="{
        toasts: [],
        heights: {},
        hovered: false,
        isTop: {{ $isTop ? 'true' : 'false' }},
        forceExpand: {{ $expand ? 'true' : 'false' }},
        gap: 14,
        disabled: false,
        init() {
            // The toaster is a singleton — if one is already mounted on the page, this extra
            // instance stays inert (prevents duplicate toasts when x-ui.sonner appears twice).
            if (window.__blatToasterActive) { this.disabled = true; return; }
            window.__blatToasterActive = true;
        },
        destroy() { if (! this.disabled) window.__blatToasterActive = false; },
        add(t) {
            if (this.disabled) return;
            const id = t.id != null ? t.id : (Date.now() + Math.random());
            this.toasts.push({ type: 'default', duration: 4000, ...t, id });
            const d = t.duration || 4000;
            if (d !== Infinity) setTimeout(() => this.remove(id), d);
        },
        update(d) {
            if (this.disabled) return;
            if (! this.toasts.some(t => t.id === d.id)) return;
            this.toasts = this.toasts.map(t => t.id === d.id ? { ...t, ...d } : t);
            const dur = d.duration || 4000;
            if (dur !== Infinity) setTimeout(() => this.remove(d.id), dur);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
            const { [id]: _, ...rest } = this.heights;
            this.heights = rest;
        },
        measure(id, el) { this.heights = { ...this.heights, [id]: el.offsetHeight }; },
        get expanded() { return this.forceExpand || this.hovered; },
        front(idx) { return this.isTop ? idx : (this.toasts.length - 1 - idx); },
        stackHeight() {
            const n = this.toasts.length;
            if (n === 0) return 0;
            if (this.expanded) {
                let sum = 0;
                this.toasts.forEach(t => { sum += (this.heights[t.id] || 0); });
                return sum + (n - 1) * this.gap;
            }
            let frontH = 0;
            this.toasts.forEach((t, i) => { if (this.front(i) === 0) frontH = this.heights[t.id] || 0; });
            return frontH + Math.min(n - 1, 2) * this.gap;
        },
        style(idx) {
            const fi = this.front(idx);
            const dir = this.isTop ? 1 : -1;
            const z = 100 - fi;
            if (this.expanded) {
                let off = 0;
                this.toasts.forEach((t, k) => { if (this.front(k) < fi) off += (this.heights[t.id] || 0) + this.gap; });
                return `transform: translateY(${dir * off}px) scale(1); opacity:1; z-index:${z};`;
            }
            const lift = fi * this.gap;
            const scale = Math.max(0.85, 1 - fi * 0.05);
            const op = fi <= 2 ? 1 : 0;
            return `transform: translateY(${dir * lift}px) scale(${scale}); opacity:${op}; z-index:${z}; pointer-events:${op ? 'auto' : 'none'};`;
        }
    }"
    @toast.window="add($event.detail)"
    @toast-update.window="update($event.detail)"
    role="region"
    aria-label="Notifications"
    tabindex="-1"
    class="pointer-events-none fixed z-[100] flex w-full p-4 sm:max-w-[420px] {{ $posClass }}"
    {{ $attributes }}
>
    <div
        class="pointer-events-auto relative w-full"
        @mouseenter="hovered = true"
        @mouseleave="hovered = false"
        @focusin="hovered = true"
        @focusout="hovered = false"
        :style="'height:' + stackHeight() + 'px'"
        style="transition: height .3s ease"
    >
        <template x-for="(t, idx) in toasts" :key="t.id">
            <div
                x-init="$nextTick(() => measure(t.id, $el))"
                :style="style(idx)"
                :role="t.type === 'error' || t.type === 'warning' ? 'alert' : 'status'"
                :aria-live="t.type === 'error' || t.type === 'warning' ? 'assertive' : 'polite'"
                aria-atomic="true"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 {{ $isTop ? '-translate-y-2' : 'translate-y-2' }}"
                x-transition:enter-end="opacity-100 translate-y-0"
                data-slot="sonner-toast"
                :data-type="t.type"
                class="bg-background text-foreground absolute inset-x-0 {{ $anchor }} {{ $origin }} flex w-full items-start gap-3 rounded-md border p-4 shadow-lg transition-all duration-300 ease-out data-[type=success]:border-emerald-500/40 data-[type=error]:border-destructive/50 data-[type=warning]:border-amber-500/40 data-[type=info]:border-sky-500/40"
            >
                <template x-if="t.type === 'success'"><x-lucide-circle-check class="text-emerald-500 mt-0.5 size-4 shrink-0" /></template>
                <template x-if="t.type === 'error'"><x-lucide-circle-x class="text-destructive mt-0.5 size-4 shrink-0" /></template>
                <template x-if="t.type === 'warning'"><x-lucide-triangle-alert class="text-amber-500 mt-0.5 size-4 shrink-0" /></template>
                <template x-if="t.type === 'info'"><x-lucide-info class="text-sky-500 mt-0.5 size-4 shrink-0" /></template>
                <template x-if="t.type === 'loading'"><x-lucide-loader-circle class="text-muted-foreground mt-0.5 size-4 shrink-0 animate-spin" /></template>
                <div class="flex-1 space-y-1">
                    <div x-show="t.title" x-text="t.title" class="text-sm font-semibold"></div>
                    <div x-show="t.description" x-text="t.description" class="text-muted-foreground text-sm"></div>
                </div>
                <template x-if="t.action">
                    <button type="button" @click="t.action.onClick && t.action.onClick(); remove(t.id)"
                        class="border-input hover:bg-accent shrink-0 self-center rounded-md border px-2.5 py-1 text-xs font-medium transition-colors" x-text="t.action.label"></button>
                </template>
                <button
                    type="button"
                    @click="remove(t.id)"
                    class="text-foreground/50 hover:text-foreground shrink-0 transition-colors"
                    aria-label="Close"
                >
                    <x-lucide-x class="size-4" aria-hidden="true" />
                </button>
            </div>
        </template>
    </div>
</div>
