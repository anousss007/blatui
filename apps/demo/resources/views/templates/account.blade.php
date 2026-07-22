@php
    $navItems = ['Profile' => 'profile', 'Account' => 'account', 'Notifications' => 'notifications', 'Security' => 'security', 'Danger zone' => 'danger'];
    $notes = [
        ['Product updates', 'News about features and improvements.', true],
        ['Security alerts', 'Important notices about your account security.', true],
        ['Weekly digest', 'A summary of your workspace activity.', false],
        ['Mentions', 'When someone @mentions you in a comment.', true],
    ];
@endphp

<x-layouts.app title="Settings — Acme">
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-5xl items-center gap-3 px-6">
            <a href="/templates/dashboard/raw" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1 text-sm"><x-lucide-chevron-left class="size-4" /> Back to app</a>
            <div class="ml-auto flex items-center gap-1.5">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <x-ui.avatar class="size-8"><x-ui.avatar-fallback>AD</x-ui.avatar-fallback></x-ui.avatar>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-5xl px-6 py-10">
        <h1 class="text-3xl font-bold tracking-tight">Settings</h1>
        <p class="text-muted-foreground mt-1">Manage your profile, preferences and account.</p>

        <div class="mt-8 grid gap-10 lg:grid-cols-[180px_1fr]">
            {{-- Settings nav --}}
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <nav class="flex gap-1 overflow-x-auto text-sm lg:flex-col">
                    @foreach ($navItems as $label => $anchor)
                        <a href="#{{ $anchor }}" @class(['rounded-md px-3 py-2 font-medium whitespace-nowrap transition-colors', 'bg-accent text-accent-foreground' => $loop->first, 'text-muted-foreground hover:text-foreground hover:bg-accent/60' => ! $loop->first])>{{ $label }}</a>
                    @endforeach
                </nav>
            </aside>

            <div class="space-y-8">
                {{-- Profile --}}
                <x-ui.card variant="sectioned" id="profile" class="scroll-mt-24">
                    <x-ui.card-header><x-ui.card-title>Profile</x-ui.card-title><x-ui.card-description>This is how others will see you.</x-ui.card-description></x-ui.card-header>
                    <x-ui.card-content class="space-y-5">
                        <div class="flex items-center gap-4">
                            <x-ui.avatar class="size-16"><x-ui.avatar-fallback class="text-lg">AD</x-ui.avatar-fallback></x-ui.avatar>
                            <div class="flex gap-2">
                                <x-ui.button variant="outline" size="sm"><x-lucide-upload class="size-4" /> Change</x-ui.button>
                                <x-ui.button variant="ghost" size="sm" class="text-destructive">Remove</x-ui.button>
                            </div>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="grid gap-2"><x-ui.label for="a-name">Full name</x-ui.label><x-ui.input id="a-name" value="Ada Lovelace" /></div>
                            <div class="grid gap-2"><x-ui.label for="a-user">Username</x-ui.label><x-ui.input id="a-user" value="ada" /></div>
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="a-bio">Bio</x-ui.label>
                            <textarea id="a-bio" class="blat-textarea" rows="3">Mathematician & first programmer. Building things at Acme.</textarea>
                            <p class="text-muted-foreground text-xs">Brief description for your profile. Max 160 characters.</p>
                        </div>
                    </x-ui.card-content>
                    <x-ui.card-footer class="justify-end gap-2"><x-ui.button variant="outline">Cancel</x-ui.button><x-ui.button>Save changes</x-ui.button></x-ui.card-footer>
                </x-ui.card>

                {{-- Account --}}
                <x-ui.card variant="sectioned" id="account" class="scroll-mt-24">
                    <x-ui.card-header><x-ui.card-title>Account</x-ui.card-title><x-ui.card-description>Update your email and regional settings.</x-ui.card-description></x-ui.card-header>
                    <x-ui.card-content class="grid gap-4 sm:grid-cols-2">
                        <div class="grid gap-2 sm:col-span-2"><x-ui.label for="a-email">Email</x-ui.label><x-ui.input id="a-email" type="email" value="ada@acme.com" /></div>
                        <div class="grid gap-2">
                            <x-ui.label for="a-lang">Language</x-ui.label>
                            <select id="a-lang" class="blat-select"><option>English</option><option>Français</option><option>Deutsch</option><option>日本語</option></select>
                        </div>
                        <div class="grid gap-2">
                            <x-ui.label for="a-tz">Timezone</x-ui.label>
                            <select id="a-tz" class="blat-select"><option>UTC</option><option>Europe/London</option><option>America/New_York</option><option>Asia/Tokyo</option></select>
                        </div>
                    </x-ui.card-content>
                    <x-ui.card-footer class="justify-end"><x-ui.button>Save</x-ui.button></x-ui.card-footer>
                </x-ui.card>

                {{-- Notifications --}}
                <x-ui.card variant="sectioned" id="notifications" class="scroll-mt-24">
                    <x-ui.card-header><x-ui.card-title>Notifications</x-ui.card-title><x-ui.card-description>Choose what you want to hear about.</x-ui.card-description></x-ui.card-header>
                    <x-ui.card-content class="divide-y">
                        @foreach ($notes as [$t, $d, $on])
                            <div class="flex items-center justify-between gap-4 py-3 first:pt-0 last:pb-0">
                                <div><div class="text-sm font-medium">{{ $t }}</div><div class="text-muted-foreground text-sm">{{ $d }}</div></div>
                                <x-ui.switch :checked="$on" />
                            </div>
                        @endforeach
                    </x-ui.card-content>
                </x-ui.card>

                {{-- Security --}}
                <x-ui.card variant="sectioned" id="security" class="scroll-mt-24">
                    <x-ui.card-header><x-ui.card-title>Security</x-ui.card-title><x-ui.card-description>Keep your account safe.</x-ui.card-description></x-ui.card-header>
                    <x-ui.card-content class="space-y-5">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="grid gap-2"><x-ui.label for="a-cur">Current password</x-ui.label><x-ui.input id="a-cur" type="password" placeholder="••••••••" /></div>
                            <div class="grid gap-2"><x-ui.label for="a-new">New password</x-ui.label><x-ui.input id="a-new" type="password" placeholder="••••••••" /></div>
                        </div>
                        <x-ui.separator />
                        <div class="flex items-center justify-between gap-4">
                            <div><div class="flex items-center gap-2 text-sm font-medium">Two-factor authentication <x-ui.badge tone="success" variant="soft" class="text-xs">Recommended</x-ui.badge></div><div class="text-muted-foreground text-sm">Add an extra layer of security to your account.</div></div>
                            <x-ui.switch />
                        </div>
                    </x-ui.card-content>
                    <x-ui.card-footer class="justify-end"><x-ui.button>Update password</x-ui.button></x-ui.card-footer>
                </x-ui.card>

                {{-- Danger zone --}}
                <x-ui.card variant="sectioned" id="danger" class="border-destructive/40 scroll-mt-24">
                    <x-ui.card-header><x-ui.card-title class="text-destructive">Danger zone</x-ui.card-title><x-ui.card-description>Irreversible and destructive actions.</x-ui.card-description></x-ui.card-header>
                    <x-ui.card-content>
                        <div class="border-destructive/30 flex flex-wrap items-center justify-between gap-3 rounded-lg border border-dashed p-4">
                            <div><div class="text-sm font-medium">Delete this account</div><div class="text-muted-foreground text-sm">Permanently remove your account and all of its data.</div></div>
                            <x-ui.alert-dialog>
                                <x-ui.alert-dialog-trigger>
                                    <x-ui.button variant="destructive">Delete account</x-ui.button>
                                </x-ui.alert-dialog-trigger>
                                <x-ui.alert-dialog-content>
                                    <x-ui.alert-dialog-header>
                                        <x-ui.alert-dialog-title>Are you absolutely sure?</x-ui.alert-dialog-title>
                                        <x-ui.alert-dialog-description>This permanently deletes your account, workspaces and all data. This action cannot be undone.</x-ui.alert-dialog-description>
                                    </x-ui.alert-dialog-header>
                                    <x-ui.alert-dialog-footer>
                                        <x-ui.alert-dialog-cancel>Cancel</x-ui.alert-dialog-cancel>
                                        <x-ui.alert-dialog-action class="bg-destructive text-white hover:bg-destructive/90">Delete account</x-ui.alert-dialog-action>
                                    </x-ui.alert-dialog-footer>
                                </x-ui.alert-dialog-content>
                            </x-ui.alert-dialog>
                        </div>
                    </x-ui.card-content>
                </x-ui.card>
            </div>
        </div>
    </div>
</x-layouts.app>
