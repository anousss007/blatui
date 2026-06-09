{{-- Presence indicators pinned to the avatar corner. --}}
<div class="flex items-center gap-5">
    <div class="relative inline-flex">
        <x-ui.avatar class="size-10">
            <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
            <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
        </x-ui.avatar>
        <span class="border-background absolute end-0 bottom-0 size-3 rounded-full border-2 bg-green-600 dark:bg-green-400" aria-label="Online"></span>
    </div>
    <div class="relative inline-flex">
        <x-ui.avatar class="size-10">
            <x-ui.avatar-image src="https://github.com/leerob.png" alt="@leerob" />
            <x-ui.avatar-fallback>LR</x-ui.avatar-fallback>
        </x-ui.avatar>
        <span class="border-background absolute end-0 bottom-0 size-3 rounded-full border-2 bg-amber-500" aria-label="Away"></span>
    </div>
    <div class="relative inline-flex">
        <x-ui.avatar class="size-10">
            <x-ui.avatar-image src="https://github.com/evilrabbit.png" alt="@evilrabbit" />
            <x-ui.avatar-fallback>ER</x-ui.avatar-fallback>
        </x-ui.avatar>
        <span class="border-background bg-destructive absolute end-0 bottom-0 size-3 rounded-full border-2" aria-label="Busy"></span>
    </div>
    <div class="relative inline-flex">
        <x-ui.avatar class="size-10">
            <x-ui.avatar-fallback>JD</x-ui.avatar-fallback>
        </x-ui.avatar>
        <span class="border-background bg-muted-foreground/50 absolute end-0 bottom-0 size-3 rounded-full border-2" aria-label="Offline"></span>
    </div>
</div>
