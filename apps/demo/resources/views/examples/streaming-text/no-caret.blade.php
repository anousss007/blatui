{{-- Hide the blinking caret with :caret="false". --}}
<p class="max-w-prose text-base leading-relaxed">
    <x-ui.streaming-text
        :caret="false"
        text="Without the caret the passage simply fades in token by token, leaving no trailing cursor once it finishes."
    />
</p>
