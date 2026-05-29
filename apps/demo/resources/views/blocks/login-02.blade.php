<x-layouts.app title="Login 02">
    <div class="grid min-h-svh lg:grid-cols-2">
        <div class="flex flex-col gap-4 p-6 md:p-10">
            <div class="flex justify-center gap-2 md:justify-start">
                <a href="#" class="flex items-center gap-2 font-medium">
                    <div class="bg-primary text-primary-foreground flex size-6 items-center justify-center rounded-md">
                        <x-lucide-gallery-vertical-end class="size-4" />
                    </div>
                    Acme Inc.
                </a>
            </div>
            <div class="flex flex-1 items-center justify-center">
                <div class="w-full max-w-xs">
                    <form class="flex flex-col gap-6">
                        <x-ui.field-group>
                            <div class="flex flex-col items-center gap-1 text-center">
                                <h1 class="text-2xl font-bold">Login to your account</h1>
                                <p class="text-muted-foreground text-sm text-balance">
                                    Enter your email below to login to your account
                                </p>
                            </div>
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
                            </x-ui.field>
                            <x-ui.field-separator>Or continue with</x-ui.field-separator>
                            <x-ui.field>
                                <x-ui.button variant="outline" type="button">
                                    <x-brand.github />
                                    Login with GitHub
                                </x-ui.button>
                                <x-ui.field-description class="text-center">
                                    Don't have an account?
                                    <a href="#" class="underline underline-offset-4">Sign up</a>
                                </x-ui.field-description>
                            </x-ui.field>
                        </x-ui.field-group>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-muted relative hidden lg:block">
            <img src="/placeholder.svg" alt="Image"
                class="absolute inset-0 h-full w-full object-cover dark:brightness-[0.2] dark:grayscale" />
        </div>
    </div>
</x-layouts.app>
