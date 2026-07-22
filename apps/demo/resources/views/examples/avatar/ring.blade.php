{{-- Avatars with a ring / coloured border. --}}
<div class="flex items-center gap-5">
    <x-ui.avatar class="ring-ring size-10 ring-2 ring-offset-2 ring-offset-background">
        <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
        <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
    </x-ui.avatar>
    <x-ui.avatar class="size-10 ring-2 ring-green-600 ring-offset-2 ring-offset-background dark:ring-green-400">
        <x-ui.avatar-image src="https://github.com/leerob.png" alt="@leerob" />
        <x-ui.avatar-fallback>LR</x-ui.avatar-fallback>
    </x-ui.avatar>
    <x-ui.avatar class="ring-primary size-10 ring-2">
        <x-ui.avatar-image src="https://github.com/evilrabbit.png" alt="@evilrabbit" />
        <x-ui.avatar-fallback>ER</x-ui.avatar-fallback>
    </x-ui.avatar>
    <x-ui.avatar class="border-primary size-10 border-2">
        <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
        <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
    </x-ui.avatar>
</div>
