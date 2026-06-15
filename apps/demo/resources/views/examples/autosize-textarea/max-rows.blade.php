<div class="grid w-full max-w-sm gap-2">
    <x-ui.label for="autosize-capped">Capped at 6 rows</x-ui.label>
    <x-ui.autosize-textarea
        id="autosize-capped"
        name="capped"
        :max-rows="6"
        placeholder="Grows up to 6 rows, then scrolls…"
    />
    <p class="text-muted-foreground text-sm">After six lines the field stops growing and scrolls.</p>
</div>
