<x-layouts.app title="Login 03">
    <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-6">
            <a href="#" class="flex items-center gap-2 self-center font-medium">
                <div class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded-md">
                    <x-lucide-gallery-vertical-end class="size-4" />
                </div>
                Acme Inc.
            </a>
            <div class="flex flex-col gap-6">
                <x-ui.card>
                    <x-ui.card-header class="text-center">
                        <x-ui.card-title class="text-xl">Welcome back</x-ui.card-title>
                        <x-ui.card-description>
                            Login with your Apple or Google account
                        </x-ui.card-description>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <form>
                            <x-ui.field-group>
                                <x-ui.field>
                                    <x-ui.button variant="outline" type="button">
                                        <x-brand.apple />
                                        Login with Apple
                                    </x-ui.button>
                                    <x-ui.button variant="outline" type="button">
                                        <x-brand.google />
                                        Login with Google
                                    </x-ui.button>
                                </x-ui.field>
                                <x-ui.field-separator class="*:data-[slot=field-separator-content]:bg-card">
                                    Or continue with
                                </x-ui.field-separator>
                                <x-ui.field>
                                    <x-ui.field-label for="email">Email</x-ui.field-label>
                                    <x-ui.input id="email" type="email" placeholder="m@example.com" required />
                                </x-ui.field>
                                <x-ui.field>
                                    <div class="flex items-center">
                                        <x-ui.field-label for="password">Password</x-ui.field-label>
                                        <a href="#" class="ml-auto text-sm underline-offset-4 hover:underline">
                                            Forgot your password?
                                        </a>
                                    </div>
                                    <x-ui.input id="password" type="password" required />
                                </x-ui.field>
                                <x-ui.field>
                                    <x-ui.button type="submit">Login</x-ui.button>
                                    <x-ui.field-description class="text-center">
                                        Don't have an account? <a href="#" class="underline underline-offset-4">Sign up</a>
                                    </x-ui.field-description>
                                </x-ui.field>
                            </x-ui.field-group>
                        </form>
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
