{{-- The whole trail sits inside a bordered container. --}}
<x-ui.breadcrumb>
    <x-ui.breadcrumb-list class="bg-background min-h-9 w-fit rounded-md border px-3 py-1">
        <x-ui.breadcrumb-item>
            <x-ui.breadcrumb-link href="#" class="inline-flex items-center gap-1.5"><x-lucide-house class="size-3.5" aria-hidden="true" /> Home</x-ui.breadcrumb-link>
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
