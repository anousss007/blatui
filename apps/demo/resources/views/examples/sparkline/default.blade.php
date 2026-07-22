<div class="flex flex-wrap items-center gap-8">
    <div class="flex flex-col gap-1">
        <span class="text-muted-foreground text-xs">Revenue</span>
        <span class="inline-flex items-center gap-2 text-lg font-semibold tabular-nums">
            $12.4k
            <x-ui.sparkline :data="[4, 8, 5, 10, 7, 12, 9, 14, 11, 16]" :width="96" :height="28" />
        </span>
    </div>
    <div class="flex flex-col gap-1">
        <span class="text-muted-foreground text-xs">Churn</span>
        <span class="inline-flex items-center gap-2 text-lg font-semibold tabular-nums">
            2.1%
            <x-ui.sparkline :data="[16, 12, 14, 8, 10, 6, 9, 4]" :width="96" :height="28" class="text-rose-500" />
        </span>
    </div>
    <x-ui.sparkline :data="[2, 3, 2, 4, 3, 5, 6, 5, 7, 6, 8]" :width="160" :height="40" class="text-emerald-500" />
</div>
