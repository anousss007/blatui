{{-- Stacked group where each avatar lifts on hover. --}}
<div class="flex -space-x-3">
    <x-ui.avatar class="ring-background size-10 ring-2 transition-all duration-300 ease-in-out hover:z-10 hover:-translate-y-1 hover:shadow-md">
        <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
        <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
    </x-ui.avatar>
    <x-ui.avatar class="ring-background size-10 ring-2 transition-all duration-300 ease-in-out hover:z-10 hover:-translate-y-1 hover:shadow-md">
        <x-ui.avatar-image src="https://github.com/leerob.png" alt="@leerob" />
        <x-ui.avatar-fallback>LR</x-ui.avatar-fallback>
    </x-ui.avatar>
    <x-ui.avatar class="ring-background size-10 ring-2 transition-all duration-300 ease-in-out hover:z-10 hover:-translate-y-1 hover:shadow-md">
        <x-ui.avatar-image src="https://github.com/evilrabbit.png" alt="@evilrabbit" />
        <x-ui.avatar-fallback>ER</x-ui.avatar-fallback>
    </x-ui.avatar>
    <x-ui.avatar class="ring-background bg-muted size-10 ring-2 transition-all duration-300 ease-in-out hover:z-10 hover:-translate-y-1 hover:shadow-md">
        <x-ui.avatar-fallback class="text-xs font-medium">+5</x-ui.avatar-fallback>
    </x-ui.avatar>
</div>
