{{-- Two handles for a min–max range. A `name` submits {name}[min] and {name}[max]. --}}
<div class="grid w-full max-w-sm gap-3">
    <x-ui.label>Price range</x-ui.label>
    <x-ui.slider range :value="[25, 75]" name="price" aria-label="Price" />
</div>
