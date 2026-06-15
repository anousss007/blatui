{{-- No header row: pass an aria-label for the accessible name. --}}
<div class="w-full max-w-sm">
    <x-ui.meter :value="58" :show-value="false" aria-label="Battery level" />
</div>
