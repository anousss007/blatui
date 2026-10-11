{{-- Cents-style entry for a till or a price form: digits enter from the right, so typing
     1 9 0 shows 1.90 and Backspace drops the last digit. Pasting "1.9" keeps it 1.90. --}}
<div class="grid w-full max-w-xs items-center gap-2">
    <x-ui.label for="amount">Amount</x-ui.label>
    <x-ui.number-input id="amount" name="amount" :value="null" :min="0" :step="0.01" :decimals="2" mask class="w-40" />
</div>
