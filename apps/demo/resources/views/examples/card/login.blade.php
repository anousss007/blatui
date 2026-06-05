<x-ui.card class="w-full max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Login to your account</x-ui.card-title>
        <x-ui.card-description>Enter your email below to login to your account.</x-ui.card-description>
        <x-ui.card-action>
            <x-ui.button variant="link">Sign Up</x-ui.button>
        </x-ui.card-action>
    </x-ui.card-header>
    <x-ui.card-content>
        <form class="flex flex-col gap-6">
            <x-ui.field>
                <x-ui.field-label for="card-login-email">Email</x-ui.field-label>
                <x-ui.input id="card-login-email" type="email" placeholder="m@example.com" />
            </x-ui.field>
            <x-ui.field>
                <div class="flex items-center">
                    <x-ui.field-label for="card-login-password">Password</x-ui.field-label>
                    <a href="#" class="ml-auto text-sm underline-offset-4 hover:underline">Forgot your password?</a>
                </div>
                <x-ui.input id="card-login-password" type="password" />
            </x-ui.field>
        </form>
    </x-ui.card-content>
    <x-ui.card-footer class="flex-col gap-2">
        <x-ui.button type="submit" class="w-full">Login</x-ui.button>
        <x-ui.button variant="outline" class="w-full">Login with Google</x-ui.button>
    </x-ui.card-footer>
</x-ui.card>
