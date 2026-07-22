{{-- Let low/high/optimum auto-pick the colour, like the native <meter>. --}}
{{-- Here lower is better (optimum below low), so a high value reads as danger. --}}
<div class="flex w-full max-w-sm flex-col gap-4">
    <x-ui.meter :value="35" :low="50" :high="80" :optimum="20" label="CPU load" />
    <x-ui.meter :value="68" :low="50" :high="80" :optimum="20" label="CPU load" />
    <x-ui.meter :value="91" :low="50" :high="80" :optimum="20" label="CPU load" />
</div>
