<div class="grid w-full max-w-sm gap-3">
    <div class="flex items-center justify-between">
        <span class="text-sm font-medium">Volume</span>
        <span class="text-muted-foreground text-sm tabular-nums">33%</span>
    </div>
    <x-ui.slider :value="33" :max="100" :step="1" ariaLabel="Volume" />
</div>
