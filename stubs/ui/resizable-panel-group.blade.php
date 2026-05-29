@props(['direction' => 'horizontal'])

<div
    data-slot="resizable-panel-group"
    data-direction="{{ $direction }}"
    x-data="{
        direction: @js($direction),
        size: 50,
        dragging: false,
        start() { this.dragging = true; document.body.style.userSelect = 'none' },
        stop() { this.dragging = false; document.body.style.userSelect = '' },
        move(e) {
            if (!this.dragging) return;
            const rect = this.$el.getBoundingClientRect();
            let pct = this.direction === 'horizontal'
                ? (e.clientX - rect.left) / rect.width * 100
                : (e.clientY - rect.top) / rect.height * 100;
            this.size = Math.max(10, Math.min(90, pct));
        }
    }"
    @pointermove.window="move($event)"
    @pointerup.window="stop()"
    {{ $attributes->twMerge('flex h-full w-full data-[direction=vertical]:flex-col') }}
>
    {{ $slot }}
</div>
