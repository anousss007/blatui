<x-ui.popover>
    <x-ui.popover-trigger>
        <x-ui.button variant="outline"><x-lucide-bell aria-hidden="true" /> Notifications</x-ui.button>
    </x-ui.popover-trigger>
    <x-ui.popover-content class="w-72">
        <div class="grid gap-3">
            <h4 class="leading-none font-medium">Notifications</h4>
            <div class="flex items-center justify-between gap-4">
                <x-ui.label for="pop-email">Email</x-ui.label>
                <x-ui.switch id="pop-email" checked />
            </div>
            <div class="flex items-center justify-between gap-4">
                <x-ui.label for="pop-push">Push</x-ui.label>
                <x-ui.switch id="pop-push" />
            </div>
            <div class="flex items-center justify-between gap-4">
                <x-ui.label for="pop-sms">SMS</x-ui.label>
                <x-ui.switch id="pop-sms" />
            </div>
        </div>
    </x-ui.popover-content>
</x-ui.popover>
