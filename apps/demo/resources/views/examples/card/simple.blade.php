{{-- The default card is now a simple padded box — drop content straight in, no fighting
     imposed flex/gap/py. Use variant="sectioned" when you want header/content/footer. --}}
<x-ui.card class="w-full max-w-sm">
    <p class="text-sm">
        <span class="font-medium">Simple box.</span>
        The base card is just <code class="text-xs">p-6</code> with a rounded border — no flex,
        no imposed gaps. Compose freely inside it.
    </p>
</x-ui.card>
