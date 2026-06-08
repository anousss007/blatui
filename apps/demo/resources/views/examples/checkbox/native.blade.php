{{-- native: a real <input type=checkbox> styled via the .blat-checkbox utility — submits
     without JS, name-bound. Use the default (Alpine) checkbox if you need indeterminate. --}}
<div class="flex items-center gap-2">
    <x-ui.checkbox native id="terms" name="terms" :checked="true" />
    <x-ui.label for="terms">Accept terms &amp; conditions</x-ui.label>
</div>
