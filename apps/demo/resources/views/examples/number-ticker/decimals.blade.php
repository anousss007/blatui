{{-- Fixed decimal places with a suffix — handy for percentages and rates. --}}
<div class="text-4xl font-semibold text-emerald-500">
    <x-ui.number-ticker :value="99.9" :decimals="1" suffix="%" />
</div>
