@php
    $google = '<svg viewBox="0 0 24 24" class="size-4" aria-hidden="true"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.76h3.56c2.08-1.92 3.28-4.74 3.28-8.09Z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.56-2.76c-.98.66-2.23 1.06-3.72 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23Z"/><path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84Z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.3 9.14 5.38 12 5.38Z"/></svg>';
@endphp

<x-layouts.app title="Sign in — Nimbus">
    <div class="grid min-h-screen lg:grid-cols-2">
        {{-- Brand panel --}}
        <div class="bg-primary text-primary-foreground relative hidden flex-col justify-between overflow-hidden p-12 lg:flex">
            <div class="pointer-events-none absolute -right-20 -top-20 size-80 rounded-full bg-white/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 -left-16 size-80 rounded-full bg-white/10 blur-3xl"></div>
            <a href="/templates/saas/raw" class="relative flex items-center gap-2 font-semibold">
                <span class="flex size-8 items-center justify-center rounded-lg bg-white/15"><x-lucide-cloud class="size-5" /></span> Nimbus
            </a>
            <figure class="relative max-w-md">
                <x-lucide-quote class="mb-4 size-8 opacity-40" />
                <blockquote class="text-2xl font-medium leading-snug text-balance">
                    Nimbus is the first tool our whole team actually agreed on. Onboarding took an afternoon.
                </blockquote>
                <figcaption class="mt-6 flex items-center gap-3">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=120&q=80" alt="" class="size-11 rounded-full object-cover ring-2 ring-white/20" />
                    <div class="text-sm">
                        <div class="font-semibold">Sofia Davis</div>
                        <div class="opacity-70">VP Operations, Acme</div>
                    </div>
                </figcaption>
            </figure>
            <div class="relative flex gap-8 text-sm">
                <div><div class="text-2xl font-bold">12k+</div><div class="opacity-70">Teams</div></div>
                <div><div class="text-2xl font-bold">99.99%</div><div class="opacity-70">Uptime</div></div>
                <div><div class="text-2xl font-bold">4.9/5</div><div class="opacity-70">Rating</div></div>
            </div>
        </div>

        {{-- Form --}}
        <div class="relative flex items-center justify-center p-6 sm:p-10">
            <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent absolute right-5 top-5 inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme">
                <x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" />
            </button>

            <div class="w-full max-w-sm">
                <a href="#" class="mb-8 flex items-center gap-2 font-semibold lg:hidden">
                    <span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-cloud class="size-5" /></span> Nimbus
                </a>

                <x-ui.tabs value="signin" class="w-full">
                    <x-ui.tabs-list class="grid w-full grid-cols-2">
                        <x-ui.tabs-trigger value="signin">Sign in</x-ui.tabs-trigger>
                        <x-ui.tabs-trigger value="signup">Create account</x-ui.tabs-trigger>
                    </x-ui.tabs-list>

                    {{-- Sign in --}}
                    <x-ui.tabs-content value="signin" class="mt-6">
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold tracking-tight">Welcome back</h1>
                            <p class="text-muted-foreground mt-1 text-sm">Sign in to your workspace to continue.</p>
                        </div>
                        <div class="grid gap-2">
                            <x-ui.button variant="outline" class="w-full">{!! $google !!} Continue with Google</x-ui.button>
                            <x-ui.button variant="outline" class="w-full"><x-lucide-github class="size-4" /> Continue with GitHub</x-ui.button>
                        </div>
                        <div class="my-6 flex items-center gap-3">
                            <x-ui.separator class="flex-1" />
                            <span class="text-muted-foreground text-xs uppercase">or</span>
                            <x-ui.separator class="flex-1" />
                        </div>
                        <form class="grid gap-4">
                            <div class="grid gap-2">
                                <x-ui.label for="si-email">Email</x-ui.label>
                                <x-ui.input id="si-email" type="email" placeholder="you@example.com" autocomplete="email">
                                    <x-slot:leading><x-lucide-mail /></x-slot:leading>
                                </x-ui.input>
                            </div>
                            <div class="grid gap-2">
                                <div class="flex items-center justify-between">
                                    <x-ui.label for="si-pass">Password</x-ui.label>
                                    <a href="#" class="text-primary text-sm hover:underline">Forgot password?</a>
                                </div>
                                <x-ui.input id="si-pass" type="password" placeholder="••••••••" autocomplete="current-password">
                                    <x-slot:leading><x-lucide-lock /></x-slot:leading>
                                </x-ui.input>
                            </div>
                            <label class="flex items-center gap-2 text-sm">
                                <x-ui.checkbox id="si-remember" /> Remember me for 30 days
                            </label>
                            <x-ui.button type="submit" class="w-full">Sign in</x-ui.button>
                        </form>
                    </x-ui.tabs-content>

                    {{-- Sign up --}}
                    <x-ui.tabs-content value="signup" class="mt-6">
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold tracking-tight">Create your account</h1>
                            <p class="text-muted-foreground mt-1 text-sm">Free for side projects. No credit card required.</p>
                        </div>
                        <form class="grid gap-4">
                            <div class="grid gap-2">
                                <x-ui.label for="su-name">Full name</x-ui.label>
                                <x-ui.input id="su-name" placeholder="Ada Lovelace">
                                    <x-slot:leading><x-lucide-user /></x-slot:leading>
                                </x-ui.input>
                            </div>
                            <div class="grid gap-2">
                                <x-ui.label for="su-email">Work email</x-ui.label>
                                <x-ui.input id="su-email" type="email" placeholder="you@company.com">
                                    <x-slot:leading><x-lucide-mail /></x-slot:leading>
                                </x-ui.input>
                            </div>
                            <div class="grid gap-2">
                                <x-ui.label for="su-pass">Password</x-ui.label>
                                <x-ui.input id="su-pass" type="password" placeholder="At least 8 characters">
                                    <x-slot:leading><x-lucide-lock /></x-slot:leading>
                                </x-ui.input>
                            </div>
                            <label class="flex items-start gap-2 text-sm">
                                <x-ui.checkbox id="su-terms" class="mt-0.5" />
                                <span>I agree to the <a href="#" class="text-primary hover:underline">Terms</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>.</span>
                            </label>
                            <x-ui.button type="submit" class="w-full">Create account</x-ui.button>
                        </form>
                    </x-ui.tabs-content>
                </x-ui.tabs>

                <p class="text-muted-foreground mt-8 text-center text-xs">Protected by reCAPTCHA · SOC 2 Type II compliant</p>
            </div>
        </div>
    </div>
</x-layouts.app>
