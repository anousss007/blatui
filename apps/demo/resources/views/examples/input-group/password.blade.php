<div class="w-full max-w-sm" x-data="{ show: false }">
    <x-ui.input-group>
        <x-ui.input-group-input type="password" x-bind:type="show ? 'text' : 'password'" placeholder="Password" autocomplete="current-password" aria-label="Password" />
        <x-ui.input-group-addon align="inline-end">
            <x-ui.input-group-button size="icon-xs" @click="show = !show" aria-label="Show password" x-bind:aria-label="show ? 'Hide password' : 'Show password'" x-bind:aria-pressed="show.toString()">
                <x-lucide-eye x-show="!show" aria-hidden="true" />
                <x-lucide-eye-off x-show="show" x-cloak aria-hidden="true" />
            </x-ui.input-group-button>
        </x-ui.input-group-addon>
    </x-ui.input-group>
</div>
