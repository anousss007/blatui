<div class="flex w-full max-w-xl flex-col gap-3">
    <x-ui.alert tone="success">
        <x-lucide-circle-check />
        <x-ui.alert-title>Payment received</x-ui.alert-title>
        <x-ui.alert-description>Your booking is confirmed.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert tone="warning">
        <x-lucide-triangle-alert />
        <x-ui.alert-title>Awaiting confirmation</x-ui.alert-title>
        <x-ui.alert-description>The agency has not approved this reservation yet.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert tone="danger">
        <x-lucide-circle-x />
        <x-ui.alert-title>Reservation declined</x-ui.alert-title>
        <x-ui.alert-description>Please pick another vehicle or date.</x-ui.alert-description>
    </x-ui.alert>
    <x-ui.alert tone="info">
        <x-lucide-info />
        <x-ui.alert-title>Heads up</x-ui.alert-title>
        <x-ui.alert-description>Pickup is available from 8am.</x-ui.alert-description>
    </x-ui.alert>
</div>
