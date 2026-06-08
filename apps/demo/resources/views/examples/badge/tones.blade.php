<div class="flex flex-col gap-3">
    {{-- soft (default for tones) --}}
    <div class="flex flex-wrap items-center gap-2">
        <x-ui.badge tone="success">Confirmed</x-ui.badge>
        <x-ui.badge tone="warning">Pending</x-ui.badge>
        <x-ui.badge tone="danger">Declined</x-ui.badge>
        <x-ui.badge tone="info">Info</x-ui.badge>
        <x-ui.badge tone="neutral">Draft</x-ui.badge>
    </div>
    {{-- solid --}}
    <div class="flex flex-wrap items-center gap-2">
        <x-ui.badge tone="success" variant="solid">Confirmed</x-ui.badge>
        <x-ui.badge tone="warning" variant="solid">Pending</x-ui.badge>
        <x-ui.badge tone="danger" variant="solid">Declined</x-ui.badge>
        <x-ui.badge tone="info" variant="solid">Info</x-ui.badge>
        <x-ui.badge tone="neutral" variant="solid">Draft</x-ui.badge>
    </div>
    {{-- outline --}}
    <div class="flex flex-wrap items-center gap-2">
        <x-ui.badge tone="success" variant="outline">Confirmed</x-ui.badge>
        <x-ui.badge tone="warning" variant="outline">Pending</x-ui.badge>
        <x-ui.badge tone="danger" variant="outline">Declined</x-ui.badge>
        <x-ui.badge tone="info" variant="outline">Info</x-ui.badge>
        <x-ui.badge tone="neutral" variant="outline">Draft</x-ui.badge>
    </div>
</div>
