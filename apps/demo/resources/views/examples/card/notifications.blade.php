<x-ui.card variant="sectioned" class="w-full max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Notifications</x-ui.card-title>
        <x-ui.card-description>You have 3 unread messages.</x-ui.card-description>
        <x-ui.card-action>
            <x-ui.button variant="ghost" size="icon" aria-label="Notification settings">
                <x-lucide-bell aria-hidden="true" />
            </x-ui.button>
        </x-ui.card-action>
    </x-ui.card-header>
    <x-ui.card-content class="flex flex-col gap-4">
        <x-ui.field orientation="horizontal" class="rounded-lg border p-3">
            <x-ui.field-content>
                <x-ui.field-label for="card-push">Push notifications</x-ui.field-label>
                <x-ui.field-description>Send notifications to this device.</x-ui.field-description>
            </x-ui.field-content>
            <x-ui.switch id="card-push" checked />
        </x-ui.field>

        <ul class="flex flex-col gap-4">
            <li class="flex items-start gap-3">
                <span class="bg-primary mt-1.5 size-2 shrink-0 rounded-full" aria-hidden="true"></span>
                <div class="text-sm">
                    <p class="font-medium leading-none">Your call has been confirmed.</p>
                    <p class="text-muted-foreground">5 minutes ago</p>
                </div>
            </li>
            <li class="flex items-start gap-3">
                <span class="bg-primary mt-1.5 size-2 shrink-0 rounded-full" aria-hidden="true"></span>
                <div class="text-sm">
                    <p class="font-medium leading-none">You have a new message.</p>
                    <p class="text-muted-foreground">1 hour ago</p>
                </div>
            </li>
        </ul>
    </x-ui.card-content>
    <x-ui.card-footer>
        <x-ui.button class="w-full">
            <x-lucide-check aria-hidden="true" />
            Mark all as read
        </x-ui.button>
    </x-ui.card-footer>
</x-ui.card>
