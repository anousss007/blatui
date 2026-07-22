<div class="flex w-full max-w-sm flex-col gap-4">
    <div class="flex items-center justify-between gap-4">
        <x-ui.label for="set-2fa">Two-factor authentication</x-ui.label>
        <x-ui.switch id="set-2fa" checked />
    </div>
    <div class="flex items-center justify-between gap-4">
        <x-ui.label for="set-activity">Activity digest</x-ui.label>
        <x-ui.switch id="set-activity" />
    </div>
    <div class="flex items-center justify-between gap-4">
        <x-ui.label for="set-public">Public profile</x-ui.label>
        <x-ui.switch id="set-public" checked />
    </div>
</div>
