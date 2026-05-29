<x-ui.tabs value="account" class="w-full max-w-md">
    <x-ui.tabs-list class="grid w-full grid-cols-2">
        <x-ui.tabs-trigger value="account">Account</x-ui.tabs-trigger>
        <x-ui.tabs-trigger value="password">Password</x-ui.tabs-trigger>
    </x-ui.tabs-list>
    <x-ui.tabs-content value="account">
        <x-ui.card>
            <x-ui.card-header>
                <x-ui.card-title>Account</x-ui.card-title>
                <x-ui.card-description>
                    Make changes to your account here. Click save when you&#39;re done.
                </x-ui.card-description>
            </x-ui.card-header>
            <x-ui.card-content class="grid gap-3">
                <div class="grid gap-1.5">
                    <x-ui.label for="name">Name</x-ui.label>
                    <x-ui.input id="name" value="Pedro Duarte" />
                </div>
            </x-ui.card-content>
            <x-ui.card-footer>
                <x-ui.button>Save changes</x-ui.button>
            </x-ui.card-footer>
        </x-ui.card>
    </x-ui.tabs-content>
    <x-ui.tabs-content value="password">
        <x-ui.card>
            <x-ui.card-header>
                <x-ui.card-title>Password</x-ui.card-title>
                <x-ui.card-description>
                    Change your password here. After saving, you&#39;ll be logged out.
                </x-ui.card-description>
            </x-ui.card-header>
            <x-ui.card-content class="grid gap-3">
                <div class="grid gap-1.5">
                    <x-ui.label for="current">Current password</x-ui.label>
                    <x-ui.input id="current" type="password" />
                </div>
            </x-ui.card-content>
            <x-ui.card-footer>
                <x-ui.button>Save password</x-ui.button>
            </x-ui.card-footer>
        </x-ui.card>
    </x-ui.tabs-content>
</x-ui.tabs>
