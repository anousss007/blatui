{{-- Card expiry + CVC. --}}
<div class="flex w-full max-w-sm gap-3">
    <x-ui.input-mask mask="99/99" placeholder="MM/YY" inputmode="numeric" aria-label="Expiry date" />
    <x-ui.input-mask mask="999" placeholder="CVC" inputmode="numeric" aria-label="CVC" class="max-w-24" />
</div>
