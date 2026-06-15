{{-- Type "@" anywhere in the field to surface the people list, then arrow + Enter to insert. --}}
<div class="w-full max-w-md space-y-2">
    <x-ui.label for="mention-comment">Comment</x-ui.label>
    <x-ui.mention-input
        id="mention-comment"
        name="comment"
        placeholder="Type @ to mention a teammate…"
        :mentions="[
            ['value' => 'ada', 'label' => 'Ada Lovelace', 'sub' => 'Engineering'],
            ['value' => 'grace', 'label' => 'Grace Hopper', 'sub' => 'Compilers'],
            ['value' => 'alan', 'label' => 'Alan Turing', 'sub' => 'Research'],
            ['value' => 'katherine', 'label' => 'Katherine Johnson', 'sub' => 'Orbital Mechanics'],
            ['value' => 'linus', 'label' => 'Linus Torvalds', 'sub' => 'Kernel'],
            ['value' => 'margaret', 'label' => 'Margaret Hamilton', 'sub' => 'Flight Software'],
        ]"
    />
    <p class="text-muted-foreground text-xs">Tip: type <code class="font-mono">@</code> to mention someone.</p>
</div>
