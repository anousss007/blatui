{{-- Each crumb rendered as an outline badge / pill. --}}
<x-ui.breadcrumb>
    <x-ui.breadcrumb-list>
        <x-ui.breadcrumb-item>
            <x-ui.badge variant="outline" href="#" class="text-muted-foreground hover:text-foreground font-normal">Home</x-ui.badge>
        </x-ui.breadcrumb-item>
        <x-ui.breadcrumb-separator />
        <x-ui.breadcrumb-item>
            <x-ui.badge variant="outline" href="#" class="text-muted-foreground hover:text-foreground font-normal">Components</x-ui.badge>
        </x-ui.breadcrumb-item>
        <x-ui.breadcrumb-separator />
        <x-ui.breadcrumb-item>
            <x-ui.badge variant="outline" class="border-primary text-primary font-normal">Breadcrumb</x-ui.badge>
        </x-ui.breadcrumb-item>
    </x-ui.breadcrumb-list>
</x-ui.breadcrumb>
