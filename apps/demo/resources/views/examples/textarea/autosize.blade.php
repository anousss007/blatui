{{-- Set maxRows to auto-grow with the content, then scroll once it hits the cap. --}}
<div class="grid w-full max-w-sm gap-2">
    <x-ui.label for="autosize-message">Your message</x-ui.label>
    <x-ui.textarea
        id="autosize-message"
        name="message"
        :rows="2"
        :max-rows="6"
        placeholder="Grows up to 6 rows as you type, then scrolls…"
    />
    <p class="text-muted-foreground text-sm">Starts at two rows and grows to six before it scrolls.</p>
</div>
