{{-- Badges carrying an avatar or richer leading content. --}}
<div class="flex flex-wrap items-center gap-2">
    <x-ui.badge variant="outline" class="h-auto gap-1.5 rounded-full py-1 pl-1">
        <x-ui.avatar class="size-4">
            <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
            <x-ui.avatar-fallback class="text-[0.5rem]">CN</x-ui.avatar-fallback>
        </x-ui.avatar>
        shadcn
    </x-ui.badge>
    <x-ui.badge variant="secondary" class="rounded-full">
        <span class="size-1.5 rounded-full bg-emerald-500" aria-hidden="true"></span> Active
    </x-ui.badge>
    <x-ui.badge variant="outline" class="rounded-full">
        v1.8.0 <x-lucide-arrow-right aria-hidden="true" />
    </x-ui.badge>
</div>
