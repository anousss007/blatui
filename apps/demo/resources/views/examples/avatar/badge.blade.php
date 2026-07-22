{{-- Avatars with a count badge or an icon badge. --}}
<div class="flex items-center gap-6">
    <div class="relative inline-flex">
        <x-ui.avatar class="size-10">
            <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
            <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
        </x-ui.avatar>
        <span class="bg-primary text-primary-foreground absolute -end-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full px-1 text-xs font-medium tabular-nums">3</span>
    </div>
    <div class="relative inline-flex">
        <x-ui.avatar class="size-10">
            <x-ui.avatar-image src="https://github.com/leerob.png" alt="@leerob" />
            <x-ui.avatar-fallback>LR</x-ui.avatar-fallback>
        </x-ui.avatar>
        <span class="border-background bg-background absolute end-0 bottom-0 flex size-5 items-center justify-center rounded-full border-2" role="img" aria-label="Verified">
            <x-lucide-badge-check class="size-3.5 text-green-600 dark:text-green-400" />
        </span>
    </div>
    <div class="relative inline-flex">
        <x-ui.avatar class="size-10">
            <x-ui.avatar-image src="https://github.com/evilrabbit.png" alt="@evilrabbit" />
            <x-ui.avatar-fallback>ER</x-ui.avatar-fallback>
        </x-ui.avatar>
        <span class="border-background bg-primary text-primary-foreground absolute -end-1 -bottom-1 flex size-5 items-center justify-center rounded-full border-2">
            <x-lucide-plus class="size-3" />
        </span>
    </div>
</div>
