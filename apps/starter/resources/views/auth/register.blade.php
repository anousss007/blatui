<x-layouts.app title="Sign up 01">
    <div class="flex min-h-svh w-full items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-sm">
            <x-ui.card>
                <x-ui.card-header>
                    <x-ui.card-title>Create an account</x-ui.card-title>
                    <x-ui.card-description>
                        Enter your information below to create your account
                    </x-ui.card-description>
                </x-ui.card-header>
                <x-ui.card-content>
                    <form>
                        <x-ui.field-group>
                            <x-ui.field>
                                <x-ui.field-label for="name">Full Name</x-ui.field-label>
                                <x-ui.input id="name" type="text" placeholder="John Doe" required />
                            </x-ui.field>
                            <x-ui.field>
                                <x-ui.field-label for="email">Email</x-ui.field-label>
                                <x-ui.input id="email" type="email" placeholder="m@example.com" required />
                                <x-ui.field-description>
                                    We'll use this to contact you. We will not share your email with anyone else.
                                </x-ui.field-description>
                            </x-ui.field>
                            <x-ui.field>
                                <x-ui.field-label for="password">Password</x-ui.field-label>
                                <x-ui.input id="password" type="password" required />
                                <x-ui.field-description>
                                    Must be at least 8 characters long.
                                </x-ui.field-description>
                            </x-ui.field>
                            <x-ui.field>
                                <x-ui.field-label for="confirm-password">Confirm Password</x-ui.field-label>
                                <x-ui.input id="confirm-password" type="password" required />
                                <x-ui.field-description>Please confirm your password.</x-ui.field-description>
                            </x-ui.field>
                            <x-ui.field-group>
                                <x-ui.field>
                                    <x-ui.button type="submit">Create Account</x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        Sign up with Google
                                    </x-ui.button>
                                    <x-ui.field-description class="px-6 text-center">
                                        Already have an account? <a href="#" class="underline underline-offset-4">Sign in</a>
                                    </x-ui.field-description>
                                </x-ui.field>
                            </x-ui.field-group>
                        </x-ui.field-group>
                    </form>
                </x-ui.card-content>
            </x-ui.card>
        </div>
    </div>
</x-layouts.app>
