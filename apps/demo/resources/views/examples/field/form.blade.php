{{-- A complete form assembled from fields and varied controls. --}}
<form class="w-full max-w-sm" onsubmit="return false">
    <x-ui.field-group>
        <x-ui.field>
            <x-ui.field-label for="form-name">Name</x-ui.field-label>
            <x-ui.input id="form-name" placeholder="Evil Rabbit" />
        </x-ui.field>
        <x-ui.field>
            <x-ui.field-label for="form-email">Email</x-ui.field-label>
            <x-ui.input id="form-email" type="email" placeholder="you@example.com" />
            <x-ui.field-description>We'll never share your email with anyone.</x-ui.field-description>
        </x-ui.field>
        <x-ui.field>
            <x-ui.field-label for="form-role">Role</x-ui.field-label>
            <x-ui.select>
                <x-ui.select-trigger id="form-role" class="w-full">
                    <x-ui.select-value placeholder="Select a role" />
                </x-ui.select-trigger>
                <x-ui.select-content>
                    <x-ui.select-item value="developer">Developer</x-ui.select-item>
                    <x-ui.select-item value="designer">Designer</x-ui.select-item>
                    <x-ui.select-item value="manager">Manager</x-ui.select-item>
                </x-ui.select-content>
            </x-ui.select>
        </x-ui.field>
        <x-ui.field>
            <x-ui.field-label for="form-bio">Bio</x-ui.field-label>
            <x-ui.textarea id="form-bio" placeholder="Tell us a little about yourself" />
            <x-ui.field-description>Max 160 characters.</x-ui.field-description>
        </x-ui.field>
        <x-ui.field>
            <div class="flex items-center gap-2">
                <x-ui.switch id="form-news" />
                <x-ui.field-label for="form-news" class="font-normal">Subscribe to the newsletter</x-ui.field-label>
            </div>
        </x-ui.field>
        <x-ui.button type="submit">Create account</x-ui.button>
    </x-ui.field-group>
</form>
