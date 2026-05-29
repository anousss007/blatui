@props(['n', 'title', 'last' => false])

<div class="relative grid grid-cols-[2rem_1fr] gap-x-5 pb-10">
    @unless ($last)
        <div class="bg-border absolute left-4 top-9 bottom-0 w-px -translate-x-1/2"></div>
    @endunless
    <div class="bg-primary text-primary-foreground ring-background z-10 flex size-8 items-center justify-center rounded-full text-sm font-semibold ring-4">{{ $n }}</div>
    <div class="min-w-0 space-y-3 pt-0.5">
        <h3 class="text-lg font-semibold tracking-tight">{{ $title }}</h3>
        {{ $slot }}
    </div>
</div>
