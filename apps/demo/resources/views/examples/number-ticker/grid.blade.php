{{-- Three tickers laid out as a stats row — each animates in on scroll. --}}
<div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
    <div class="flex flex-col gap-1 rounded-lg border p-6">
        <span class="text-muted-foreground text-sm">Total users</span>
        <span class="text-3xl font-semibold">
            <x-ui.number-ticker :value="48213" />
        </span>
    </div>
    <div class="flex flex-col gap-1 rounded-lg border p-6">
        <span class="text-muted-foreground text-sm">Monthly revenue</span>
        <span class="text-3xl font-semibold">
            <x-ui.number-ticker :value="92480" prefix="$" />
        </span>
    </div>
    <div class="flex flex-col gap-1 rounded-lg border p-6">
        <span class="text-muted-foreground text-sm">Uptime</span>
        <span class="text-3xl font-semibold text-emerald-500">
            <x-ui.number-ticker :value="99.98" :decimals="2" suffix="%" />
        </span>
    </div>
</div>
