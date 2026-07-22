{{-- Label paired with an inline badge (e.g. Optional / New). --}}
<div class="grid w-full max-w-sm gap-2">
    <x-ui.label for="badge-field" class="justify-between">
        Recovery email
        <x-ui.badge tone="info" variant="soft">Optional</x-ui.badge>
    </x-ui.label>
    <x-ui.input id="badge-field" type="email" placeholder="backup@example.com" />
</div>
