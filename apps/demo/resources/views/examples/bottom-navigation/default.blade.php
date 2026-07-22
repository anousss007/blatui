{{-- Rendered inside a phone-ish framed container to show the bar in context. --}}
<div class="bg-card mx-auto w-full max-w-sm overflow-hidden rounded-xl border shadow-sm">
    <div class="text-muted-foreground flex h-72 items-center justify-center text-sm">
        App content
    </div>

    <x-ui.bottom-navigation>
        <x-ui.bottom-navigation-item icon="house" label="Home" active />
        <x-ui.bottom-navigation-item icon="search" label="Search" />
        <x-ui.bottom-navigation-item icon="plus" label="Add" />
        <x-ui.bottom-navigation-item icon="bell" label="Alerts" badge="3" />
        <x-ui.bottom-navigation-item icon="user" label="Profile" />
    </x-ui.bottom-navigation>
</div>
