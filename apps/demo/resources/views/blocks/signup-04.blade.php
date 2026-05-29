<x-layouts.app title="Sign up 04">
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
        <div class="w-full max-w-sm md:max-w-4xl">
            <div class="flex flex-col gap-6">
                <x-ui.card class="overflow-hidden p-0">
                    <x-ui.card-content class="grid p-0 md:grid-cols-2">
                        <form class="p-6 md:p-8">
                            <x-ui.field-group>
                                <div class="flex flex-col items-center gap-2 text-center">
                                    <h1 class="text-2xl font-bold">Create your account</h1>
                                    <p class="text-muted-foreground text-sm text-balance">
                                        Enter your email below to create your account
                                    </p>
                                </div>
                                <x-ui.field>
                                    <x-ui.field-label for="email">Email</x-ui.field-label>
                                    <x-ui.input id="email" type="email" placeholder="m@example.com" required />
                                    <x-ui.field-description>
                                        We'll use this to contact you. We will not share your email with anyone else.
                                    </x-ui.field-description>
                                </x-ui.field>
                                <x-ui.field>
                                    <x-ui.field class="grid grid-cols-2 gap-4">
                                        <x-ui.field>
                                            <x-ui.field-label for="password">Password</x-ui.field-label>
                                            <x-ui.input id="password" type="password" required />
                                        </x-ui.field>
                                        <x-ui.field>
                                            <x-ui.field-label for="confirm-password">Confirm Password</x-ui.field-label>
                                            <x-ui.input id="confirm-password" type="password" required />
                                        </x-ui.field>
                                    </x-ui.field>
                                    <x-ui.field-description>
                                        Must be at least 8 characters long.
                                    </x-ui.field-description>
                                </x-ui.field>
                                <x-ui.field>
                                    <x-ui.button type="submit">Create Account</x-ui.button>
                                </x-ui.field>
                                <x-ui.field-separator class="*:data-[slot=field-separator-content]:bg-card">
                                    Or continue with
                                </x-ui.field-separator>
                                <x-ui.field class="grid grid-cols-3 gap-4">
                                    <x-ui.button variant="outline" type="button">
                                        <x-brand.apple />
                                        <span class="sr-only">Sign up with Apple</span>
                                    </x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        <x-brand.google />
                                        <span class="sr-only">Sign up with Google</span>
                                    </x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        <x-brand.meta />
                                        <span class="sr-only">Sign up with Meta</span>
                                    </x-ui.button>
                                </x-ui.field>
                                <x-ui.field-description class="text-center">
                                    Already have an account? <a href="#" class="underline underline-offset-4">Sign in</a>
                                </x-ui.field-description>
                            </x-ui.field-group>
                        </form>
                        <div class="bg-muted relative hidden md:block">
                            <img src="/placeholder.svg" alt="Image"
                                class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale" />
                        </div>
                    </x-ui.card-content>
                </x-ui.card>
                <x-ui.field-description class="px-6 text-center">
                    By clicking continue, you agree to our <a href="#">Terms of Service</a>
                    and <a href="#">Privacy Policy</a>.
                </x-ui.field-description>
            </div>
        </div>
    </div>
</x-layouts.app>
