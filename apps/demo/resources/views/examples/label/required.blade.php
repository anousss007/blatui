{{-- Required field — asterisk indicator in the label. --}}
<div class="grid w-full max-w-sm gap-2">
    <x-ui.label for="req-email">Email <span class="text-destructive">*</span></x-ui.label>
    <x-ui.input id="req-email" type="email" placeholder="you@example.com" required />
</div>
