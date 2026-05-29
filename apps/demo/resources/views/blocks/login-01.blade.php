<x-layouts.app title="Login 01">
    <div class="flex min-h-svh w-full items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-6">
                <x-ui.card>
                    <x-ui.card-header>
                        <x-ui.card-title>Login to your account</x-ui.card-title>
                        <x-ui.card-description>
                            Enter your email below to login to your account
                        </x-ui.card-description>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <form>
                            <x-ui.field-group>
                                <x-ui.field>
                                    <x-ui.field-label for="email">Email</x-ui.field-label>
                                    <x-ui.input id="email" type="email" placeholder="m@example.com" required />
                                </x-ui.field>
                                <x-ui.field>
                                    <div class="flex items-center">
                                        <x-ui.field-label for="password">Password</x-ui.field-label>
                                        <a href="#" class="ml-auto inline-block text-sm underline-offset-4 hover:underline">
                                            Forgot your password?
                                        </a>
                                    </div>
                                    <x-ui.input id="password" type="password" required />
                                </x-ui.field>
                                <x-ui.field>
                                    <x-ui.button type="submit">Login</x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        Login with Google
                                    </x-ui.button>
                                    <x-ui.field-description class="text-center">
                                        Don't have an account? <a href="#" class="underline underline-offset-4">Sign up</a>
                                    </x-ui.field-description>
                                </x-ui.field>
                            </x-ui.field-group>
                        </form>
                    </x-ui.card-content>
                </x-ui.card>
            </div>
        </div>
    </div>
</x-layouts.app>
