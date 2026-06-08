<x-ui.card variant="sectioned" class="w-full max-w-md">
    <x-ui.card-header>
        <x-ui.card-title>Share this document</x-ui.card-title>
        <x-ui.card-description>Anyone with the link can view this document.</x-ui.card-description>
    </x-ui.card-header>
    <x-ui.card-content class="flex flex-col gap-4">
        <div class="flex items-center gap-2">
            <x-ui.input value="https://blatui.dev/d/8Fk2pQ" readonly aria-label="Document link" class="flex-1" />
            <x-ui.button variant="secondary"><x-lucide-copy aria-hidden="true" /> Copy</x-ui.button>
        </div>
        <x-ui.separator />
        <div class="flex flex-col gap-3">
            <p class="text-sm font-medium">People with access</p>
            <div class="flex items-center gap-3">
                <x-ui.avatar><x-ui.avatar-fallback>SC</x-ui.avatar-fallback></x-ui.avatar>
                <div class="min-w-0 flex-1 text-sm">
                    <div class="truncate font-medium">Sofia Carter</div>
                    <div class="truncate text-muted-foreground">sofia@example.com</div>
                </div>
                <span class="text-muted-foreground shrink-0 text-sm">Owner</span>
            </div>
            <div class="flex items-center gap-3">
                <x-ui.avatar><x-ui.avatar-fallback>JD</x-ui.avatar-fallback></x-ui.avatar>
                <div class="min-w-0 flex-1 text-sm">
                    <div class="truncate font-medium">Jackson Doe</div>
                    <div class="truncate text-muted-foreground">jackson@example.com</div>
                </div>
                <span class="text-muted-foreground shrink-0 text-sm">Can edit</span>
            </div>
        </div>
    </x-ui.card-content>
</x-ui.card>
