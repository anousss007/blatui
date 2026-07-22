{{-- Tune the speeds; pass :cursor="false" to hide the caret, :loop="false" to stop on the last word. --}}
<p class="text-xl">
    I'm a <x-ui.typewriter
        :words="['developer', 'designer', 'maker']"
        :type-speed="70"
        :delete-speed="35"
        class="text-primary font-semibold"
    />
</p>
