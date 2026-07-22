{{-- Vertical orientation — single and range. --}}
<div class="flex items-start gap-10">
    <x-ui.slider orientation="vertical" :value="40" aria-label="Volume" />
    <x-ui.slider orientation="vertical" range :value="[20, 70]" aria-label="Price range" />
</div>
