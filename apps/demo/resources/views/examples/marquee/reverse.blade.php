{{-- direction="right" scrolls the other way; pause-on-hover is on by default. --}}
<x-ui.marquee direction="right" duration="25s" fade class="w-full max-w-xl py-1">
    @foreach (['🚀 Fast', '♿ Accessible', '🎨 Themeable', '📦 Copy & own', '🌙 Dark mode'] as $f)
        <x-ui.badge tone="neutral" class="whitespace-nowrap">{{ $f }}</x-ui.badge>
    @endforeach
</x-ui.marquee>
