@props([
    'position' => 'bottom-right',
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
@endphp

<div
    data-slot="sonner-toaster"
    x-data="{
        toasts: [],
        add(t) {
            const id = Date.now() + Math.random();
            this.toasts.push({ id, type: 'default', duration: 4000, ...t });
            const d = t.duration || 4000;
            if (d !== Infinity) setTimeout(() => this.remove(id), d);
        },
        remove(id) { this.toasts = this.toasts.filter(t => t.id !== id) }
    }"
    @toast.window="add($event.detail)"
    class="fixed z-[100] flex max-h-screen w-full flex-col {{ $isTop ? '' : 'flex-col-reverse' }} gap-2 p-4 sm:max-w-[420px] {{ $posClass }}"
    {{ $attributes }}
>
    <template x-for="t in toasts" :key="t.id">
        <div
            role="status"
            aria-live="polite"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            data-slot="sonner-toast"
            :data-type="t.type"
            class="bg-background text-foreground pointer-events-auto flex w-full items-start gap-3 rounded-md border p-4 shadow-lg data-[type=success]:border-emerald-500/40 data-[type=error]:border-destructive/50 data-[type=warning]:border-amber-500/40 data-[type=info]:border-sky-500/40"
        >
            <template x-if="t.type === 'success'"><x-lucide-circle-check class="text-emerald-500 mt-0.5 size-4 shrink-0" /></template>
            <template x-if="t.type === 'error'"><x-lucide-circle-x class="text-destructive mt-0.5 size-4 shrink-0" /></template>
            <template x-if="t.type === 'warning'"><x-lucide-triangle-alert class="text-amber-500 mt-0.5 size-4 shrink-0" /></template>
            <template x-if="t.type === 'info'"><x-lucide-info class="text-sky-500 mt-0.5 size-4 shrink-0" /></template>
            <div class="flex-1 space-y-1">
                <div x-show="t.title" x-text="t.title" class="text-sm font-semibold"></div>
                <div x-show="t.description" x-text="t.description" class="text-muted-foreground text-sm"></div>
            </div>
            <button
                type="button"
                @click="remove(t.id)"
                class="text-foreground/50 hover:text-foreground shrink-0 transition-colors"
                aria-label="Close"
            >
                <x-lucide-x class="size-4" />
            </button>
        </div>
    </template>
</div>
