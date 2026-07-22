{{-- Options laid out in a row. --}}
<x-ui.radio-group value="card" class="flex flex-wrap items-center gap-5">
    <div class="flex items-center gap-2">
        <x-ui.radio-group-item value="card" id="pay-card" />
        <x-ui.label for="pay-card">Card</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.radio-group-item value="paypal" id="pay-paypal" />
        <x-ui.label for="pay-paypal">PayPal</x-ui.label>
    </div>
    <div class="flex items-center gap-2">
        <x-ui.radio-group-item value="apple" id="pay-apple" />
        <x-ui.label for="pay-apple">Apple Pay</x-ui.label>
    </div>
</x-ui.radio-group>
