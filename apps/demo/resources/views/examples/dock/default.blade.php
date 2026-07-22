{{-- A roomy relative container gives the icons headroom to magnify upward. --}}
<div class="relative flex min-h-44 items-end justify-center pb-6">
    <x-ui.dock>
        <x-ui.dock-item icon="folder" label="Finder" :active="true" />
        <x-ui.dock-item icon="mail" label="Mail" href="#" />
        <x-ui.dock-item icon="calendar" label="Calendar" href="#" />
        <x-ui.dock-item icon="image" label="Photos" href="#" />
        <x-ui.dock-item icon="music" label="Music" href="#" />
        <x-ui.dock-item icon="settings" label="Settings" href="#" />
    </x-ui.dock>
</div>
