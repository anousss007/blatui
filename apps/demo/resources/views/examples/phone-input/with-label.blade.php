{{-- With a label and a non-default starting country. --}}
<div class="grid w-full max-w-xs gap-2">
    <x-ui.label for="phone-field">Phone number</x-ui.label>
    <x-ui.phone-input id="phone-field" name="phone" country="GB" placeholder="20 7946 0000" />
</div>
