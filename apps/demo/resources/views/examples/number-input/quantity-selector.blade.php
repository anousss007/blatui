{{-- A cart / product quantity stepper: number-input with a floor of 1 and a
     compact footprint. Replaces the former standalone quantity-selector. --}}
<x-ui.number-input name="quantity" :value="1" :min="1" :max="10" step="1" size="sm" class="w-32" />
