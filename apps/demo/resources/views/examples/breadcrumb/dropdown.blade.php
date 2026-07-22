<x-ui.breadcrumb>
    <x-ui.breadcrumb-list>
        <x-ui.breadcrumb-item>
            <x-ui.breadcrumb-link href="#">Home</x-ui.breadcrumb-link>
        </x-ui.breadcrumb-item>
        <x-ui.breadcrumb-separator />
        <x-ui.breadcrumb-item>
            <x-ui.dropdown-menu>
                <x-ui.dropdown-menu-trigger>
                    <button type="button" aria-label="Show more breadcrumbs" class="hover:text-foreground flex size-6 items-center justify-center rounded-md">
                        <x-lucide-more-horizontal class="size-4" aria-hidden="true" />
                    </button>
                </x-ui.dropdown-menu-trigger>
                <x-ui.dropdown-menu-content align="start">
                    <x-ui.dropdown-menu-item>Documentation</x-ui.dropdown-menu-item>
                    <x-ui.dropdown-menu-item>Themes</x-ui.dropdown-menu-item>
                    <x-ui.dropdown-menu-item>GitHub</x-ui.dropdown-menu-item>
                </x-ui.dropdown-menu-content>
            </x-ui.dropdown-menu>
        </x-ui.breadcrumb-item>
        <x-ui.breadcrumb-separator />
        <x-ui.breadcrumb-item>
            <x-ui.breadcrumb-link href="#">Components</x-ui.breadcrumb-link>
        </x-ui.breadcrumb-item>
        <x-ui.breadcrumb-separator />
        <x-ui.breadcrumb-item>
            <x-ui.breadcrumb-page>Breadcrumb</x-ui.breadcrumb-page>
        </x-ui.breadcrumb-item>
    </x-ui.breadcrumb-list>
</x-ui.breadcrumb>
