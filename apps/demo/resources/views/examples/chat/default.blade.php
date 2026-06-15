<x-ui.chat class="h-80 w-full max-w-md rounded-lg border bg-background">
    <x-ui.chat-message role="assistant" name="Assistant" time="09:41">
        Hi! How can I help you today?
    </x-ui.chat-message>

    <x-ui.chat-message role="user" name="You" time="09:41">
        I'm trying to center a div and it won't behave.
    </x-ui.chat-message>

    <x-ui.chat-message role="assistant" name="Assistant" time="09:42">
        Classic. Try a flex parent with items-center and justify-center — that handles both axes at once.
    </x-ui.chat-message>

    <x-ui.chat-message role="user" name="You" time="09:42">
        That did it. Thank you!
    </x-ui.chat-message>
</x-ui.chat>
