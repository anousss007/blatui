{{-- A custom icon (and colour) instead of stars. --}}
<div class="flex flex-col gap-4">
    <x-ui.rating :value="3" icon="heart" color="text-rose-500" />
    <x-ui.rating :value="4" icon="star" color="text-amber-500" />
    <x-ui.rating :value="2" icon="circle" color="text-sky-500" />
</div>
