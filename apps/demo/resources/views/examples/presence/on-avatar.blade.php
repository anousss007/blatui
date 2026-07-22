{{-- The presence dot composes onto an avatar corner via a relative wrapper. --}}
<div class="relative inline-flex">
    <x-ui.avatar class="size-12">
        <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
        <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
    </x-ui.avatar>

    <x-ui.presence status="online" class="absolute end-0 bottom-0" />
</div>
