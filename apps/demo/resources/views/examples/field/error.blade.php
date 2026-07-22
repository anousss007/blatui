<div class="w-full max-w-sm">
    <x-ui.field-group>
        {{-- Hint (description) only --}}
        <x-ui.field>
            <x-ui.field-label for="err-username">Username</x-ui.field-label>
            <x-ui.input id="err-username" type="text" value="shadcn" />
            <x-ui.field-description>This is your public display name.</x-ui.field-description>
        </x-ui.field>

        {{-- Single error → the field + input go invalid automatically (aria-invalid + destructive) --}}
        <x-ui.field>
            <x-ui.field-label for="err-email">Email</x-ui.field-label>
            <x-ui.input id="err-email" type="email" value="not-an-email" />
            <x-ui.field-error>Please enter a valid email address.</x-ui.field-error>
        </x-ui.field>

        {{-- Multiple validation messages via the errors array → bulleted list --}}
        <x-ui.field>
            <x-ui.field-label for="err-password">Password</x-ui.field-label>
            <x-ui.input id="err-password" type="password" value="abc" />
            <x-ui.field-description>Must be strong.</x-ui.field-description>
            <x-ui.field-error :messages="['Must be at least 8 characters.', 'Must include a number.']" />
        </x-ui.field>
    </x-ui.field-group>
</div>
