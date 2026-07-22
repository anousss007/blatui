{{-- Fully rounded "pill" buttons, including an icon pill and an avatar pill. --}}
<div class="flex flex-wrap items-center gap-3">
    <x-ui.button class="rounded-full">Get started</x-ui.button>
    <x-ui.button variant="outline" class="rounded-full">Learn more</x-ui.button>
    <x-ui.button size="icon" variant="outline" class="rounded-full" aria-label="Like"><x-lucide-heart aria-hidden="true" /></x-ui.button>
    <x-ui.button variant="outline" class="h-11 rounded-full pr-4 pl-1.5">
        <x-ui.avatar class="size-8">
            <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
            <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
        </x-ui.avatar>
        shadcn
        <x-lucide-chevron-down class="opacity-60" aria-hidden="true" />
    </x-ui.button>
</div>
