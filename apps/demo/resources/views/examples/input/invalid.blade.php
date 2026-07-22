<div class="grid w-full max-w-sm items-center gap-2">
    <x-ui.label for="email-invalid">Email</x-ui.label>
    <x-ui.input type="email" id="email-invalid" value="not-an-email" aria-invalid="true" aria-describedby="email-invalid-hint" />
    <p id="email-invalid-hint" role="alert" class="text-destructive text-sm">Please enter a valid email address.</p>
</div>
