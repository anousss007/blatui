<x-ui.chat class="h-80 w-full max-w-md rounded-lg border bg-background">
    <x-ui.chat-message role="user" name="You" time="11:20">
        Can you summarize the meeting notes?
    </x-ui.chat-message>

    <x-ui.chat-message role="assistant" name="Assistant" :typing="true" />
</x-ui.chat>
