@props(['withHandle' => false])

<div
    data-slot="resizable-handle"
    role="separator"
    @pointerdown="start()"
    :class="direction === 'horizontal' ? 'cursor-col-resize' : 'cursor-row-resize'"
    {{ $attributes->twMerge('bg-border focus-visible:ring-ring relative flex w-px items-center justify-center after:absolute after:inset-y-0 after:left-1/2 after:w-1 after:-translate-x-1/2 focus-visible:ring-1 focus-visible:outline-hidden data-[direction=vertical]:h-px data-[direction=vertical]:w-full data-[direction=vertical]:after:left-0 data-[direction=vertical]:after:h-1 data-[direction=vertical]:after:w-full data-[direction=vertical]:after:-translate-y-1/2 data-[direction=vertical]:after:translate-x-0') }}
>
    @if ($withHandle)
        <div class="bg-border z-10 flex h-4 w-3 items-center justify-center rounded-xs border">
            <x-lucide-grip-vertical class="size-2.5" />
        </div>
    @endif
</div>
