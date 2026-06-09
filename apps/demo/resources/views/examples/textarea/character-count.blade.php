{{-- Live "characters left" counter backed by maxlength. --}}
<div x-data="{ text: '', max: 200 }" class="w-full max-w-md space-y-2">
    <x-ui.textarea
        x-model="text"
        maxlength="200"
        placeholder="Leave us some feedback…"
        aria-describedby="ta-count"
    />
    <p id="ta-count" class="text-muted-foreground text-right text-xs">
        <span x-text="max - text.length"></span> characters left
    </p>
</div>
