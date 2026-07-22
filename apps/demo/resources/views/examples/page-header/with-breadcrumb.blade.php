<x-ui.page-header
    title="Billing settings"
    description="Update your plan, payment method, and view past invoices."
    :separator="true"
>
    <x-slot:breadcrumb>
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-list>
                <x-ui.breadcrumb-item>
                    <x-ui.breadcrumb-link href="#">Home</x-ui.breadcrumb-link>
                </x-ui.breadcrumb-item>
                <x-ui.breadcrumb-separator />
                <x-ui.breadcrumb-item>
                    <x-ui.breadcrumb-link href="#">Settings</x-ui.breadcrumb-link>
                </x-ui.breadcrumb-item>
                <x-ui.breadcrumb-separator />
                <x-ui.breadcrumb-item>
                    <x-ui.breadcrumb-page>Billing</x-ui.breadcrumb-page>
                </x-ui.breadcrumb-item>
            </x-ui.breadcrumb-list>
        </x-ui.breadcrumb>
    </x-slot:breadcrumb>

    <x-slot:actions>
        <x-ui.button variant="outline">Cancel</x-ui.button>
        <x-ui.button>Save changes</x-ui.button>
    </x-slot:actions>
</x-ui.page-header>
