<x-ui.chat class="h-80 w-full max-w-md rounded-lg border bg-background">
    <x-ui.chat-message
        role="assistant"
        name="Ada"
        time="14:02"
        avatar="https://picsum.photos/seed/ada/64/64"
    >
        Morning! Did the deploy finish overnight?
    </x-ui.chat-message>

    <x-ui.chat-message
        role="user"
        name="Sam"
        time="14:03"
        avatar="https://picsum.photos/seed/sam/64/64"
    >
        Yep, green across the board. No rollbacks.
    </x-ui.chat-message>

    <x-ui.chat-message
        role="assistant"
        name="Ada"
        time="14:03"
        avatar="https://picsum.photos/seed/ada/64/64"
    >
        Perfect. I'll close the change ticket then.
    </x-ui.chat-message>
</x-ui.chat>
