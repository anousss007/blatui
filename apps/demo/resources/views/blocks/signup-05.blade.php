<x-layouts.app title="Sign up 05">
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-6">
                <form>
                    <x-ui.field-group>
                        <div class="flex flex-col items-center gap-2 text-center">
                            <a href="#" class="flex flex-col items-center gap-2 font-medium">
                                <div class="flex size-8 items-center justify-center rounded-md">
                                    <x-lucide-gallery-vertical-end class="size-6" />
                                </div>
                                <span class="sr-only">Acme Inc.</span>
                            </a>
                            <h1 class="text-xl font-bold">Welcome to Acme Inc.</h1>
                            <x-ui.field-description>
                                Already have an account? <a href="#" class="underline underline-offset-4">Sign in</a>
                            </x-ui.field-description>
                        </div>
                        <x-ui.field>
                            <x-ui.field-label for="email">Email</x-ui.field-label>
                            <x-ui.input id="email" type="email" placeholder="m@example.com" required />
                        </x-ui.field>
                        <x-ui.field>
                            <x-ui.button type="submit">Create Account</x-ui.button>
                        </x-ui.field>
                        <x-ui.field-separator>Or</x-ui.field-separator>
                        <x-ui.field class="grid gap-4 sm:grid-cols-2">
                            <x-ui.button variant="outline" type="button">
                                <x-brand.apple />
                                Continue with Apple
                            </x-ui.button>
                            <x-ui.button variant="outline" type="button">
                                <x-brand.google />
                                Continue with Google
                            </x-ui.button>
                        </x-ui.field>
                    </x-ui.field-group>
                </form>
                <x-ui.field-description class="px-6 text-center">
                    By clicking continue, you agree to our <a href="#">Terms of Service</a>
                    and <a href="#">Privacy Policy</a>.
                </x-ui.field-description>
            </div>
        </div>
    </div>
</x-layouts.app>
