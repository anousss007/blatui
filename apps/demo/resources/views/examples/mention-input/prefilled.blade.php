{{-- Starts with text that already contains a mention; keep typing @ to add more. --}}
<div class="w-full max-w-md space-y-2">
    <x-ui.label for="mention-reply">Reply</x-ui.label>
    <x-ui.mention-input
        id="mention-reply"
        name="reply"
        rows="4"
        value="Thanks @grace for the review — pinging @alan to take a final look."
        placeholder="Type @ to mention a teammate…"
        :mentions="[
            'ada',
            'grace',
            'alan',
            'katherine',
            'linus',
            'margaret',
        ]"
    />
</div>
