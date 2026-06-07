<x-layouts.app title="Theme editor" description="Design your BlatUI theme live — colors, radius, fonts, shadow, spacing — then share a link, export JSON, or copy it straight into your app.css.">
    <x-site.header active="themes" />

    <div x-data="{
        copiedCss: false,
        copiedLink: false,
        keys: ['mode', 'base', 'preset', 'radius', 'inputStyle', 'font', 'fontHeading', 'shadow', 'spacing', 'tracking'],
        dims() {
            const t = $store.theme;
            return Object.fromEntries(this.keys.map((k) => [k, t[k]]));
        },
        encode() {
            return btoa(JSON.stringify(this.dims())).replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
        },
        shareLink() {
            return location.origin + location.pathname + '?t=' + this.encode();
        },
        copyCss() {
            navigator.clipboard.writeText(window.exportTheme());
            this.copiedCss = true; window.toast?.success('Theme CSS copied — paste it as resources/css/app.css');
            clearTimeout(this._c); this._c = setTimeout(() => this.copiedCss = false, 2000);
        },
        copyLink() {
            const url = this.shareLink();
            navigator.clipboard.writeText(url);
            history.replaceState(null, '', url);
            this.copiedLink = true; window.toast?.success('Share link copied');
            clearTimeout(this._l); this._l = setTimeout(() => this.copiedLink = false, 2000);
        },
        exportJson() {
            const blob = new Blob([JSON.stringify(this.dims(), null, 2)], { type: 'application/json' });
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob); a.download = 'blatui-theme.json'; a.click();
            URL.revokeObjectURL(a.href);
        },
        importJson(event) {
            const file = event.target.files?.[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = () => {
                try {
                    const data = JSON.parse(reader.result);
                    this.keys.forEach((k) => { if (data[k] != null) $store.theme.set(k, String(data[k])); });
                    window.toast?.success('Theme imported');
                } catch (e) {
                    window.toast?.error('That file is not a valid theme JSON');
                }
                event.target.value = '';
            };
            reader.readAsText(file);
        },
    }">
        {{-- Action bar --}}
        <div class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-14 z-30 border-b backdrop-blur-xl">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-2 px-4 py-3 lg:px-6">
                <div class="mr-auto">
                    <h1 class="text-base leading-none font-semibold">Theme editor</h1>
                    <p class="text-muted-foreground mt-1 text-xs">Pure CSS variables. Share a link, export JSON, or copy it as your <code class="bg-muted rounded px-1 text-[11px]">app.css</code>.</p>
                </div>
                <input type="file" accept="application/json,.json" x-ref="file" class="hidden" @change="importJson($event)">
                <x-ui.button variant="ghost" size="sm" @click="$store.theme.reset()">
                    <x-lucide-rotate-ccw class="size-3.5" /> Reset
                </x-ui.button>
                <x-ui.button variant="outline" size="sm" @click="$refs.file.click()">
                    <x-lucide-upload class="size-3.5" /> Import
                </x-ui.button>
                <x-ui.button variant="outline" size="sm" @click="exportJson()">
                    <x-lucide-download class="size-3.5" /> Export
                </x-ui.button>
                <x-ui.button variant="outline" size="sm" @click="copyLink()">
                    <x-lucide-share-2 class="size-3.5" /> <span x-text="copiedLink ? 'Copied!' : 'Share link'"></span>
                </x-ui.button>
                <x-ui.button size="sm" @click="copyCss()">
                    <x-lucide-clipboard class="size-3.5" /> <span x-text="copiedCss ? 'Copied!' : 'Copy CSS'"></span>
                </x-ui.button>
            </div>
        </div>

        {{-- Editor grid --}}
        <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 lg:grid-cols-[300px_1fr] lg:px-6">
            {{-- Controls --}}
            <aside class="lg:sticky lg:top-32 lg:self-start">
                <div class="bg-card rounded-xl border p-5 shadow-sm">
                    <x-theme-controls />
                </div>
            </aside>

            {{-- Live preview --}}
            <div class="space-y-6">
                {{-- Buttons --}}
                <section class="bg-card rounded-xl border p-6 shadow-sm">
                    <h2 class="text-muted-foreground mb-4 text-xs font-semibold tracking-wide uppercase">Buttons</h2>
                    <div class="flex flex-wrap items-center gap-3">
                        <x-ui.button>Primary</x-ui.button>
                        <x-ui.button variant="secondary">Secondary</x-ui.button>
                        <x-ui.button variant="outline">Outline</x-ui.button>
                        <x-ui.button variant="ghost">Ghost</x-ui.button>
                        <x-ui.button variant="destructive">Destructive</x-ui.button>
                        <x-ui.button variant="link">Link</x-ui.button>
                    </div>
                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <x-ui.button size="sm">Small</x-ui.button>
                        <x-ui.button>Default</x-ui.button>
                        <x-ui.button size="lg">Large</x-ui.button>
                        <x-ui.button size="icon" aria-label="Customize"><x-lucide-paintbrush class="size-4" /></x-ui.button>
                    </div>
                </section>

                {{-- Badges --}}
                <section class="bg-card rounded-xl border p-6 shadow-sm">
                    <h2 class="text-muted-foreground mb-4 text-xs font-semibold tracking-wide uppercase">Badges</h2>
                    <div class="flex flex-wrap items-center gap-2">
                        <x-ui.badge>Default</x-ui.badge>
                        <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                        <x-ui.badge variant="destructive">Destructive</x-ui.badge>
                        <x-ui.badge variant="outline">Outline</x-ui.badge>
                    </div>
                </section>

                {{-- Form + inputs --}}
                <div class="grid gap-6 md:grid-cols-2">
                    <section class="bg-card rounded-xl border p-6 shadow-sm">
                        <h2 class="text-muted-foreground mb-4 text-xs font-semibold tracking-wide uppercase">Form</h2>
                        <div class="space-y-4">
                            <div class="grid gap-2">
                                <x-ui.label for="t-email">Email</x-ui.label>
                                <x-ui.input id="t-email" type="email" placeholder="you@example.com" />
                            </div>
                            <div class="grid gap-2">
                                <x-ui.label for="t-framework">Framework</x-ui.label>
                                <x-ui.select>
                                    <x-ui.select-trigger id="t-framework" class="w-full" aria-label="Framework">
                                        <x-ui.select-value placeholder="Pick one" />
                                    </x-ui.select-trigger>
                                    <x-ui.select-content>
                                        <x-ui.select-item value="laravel">Laravel</x-ui.select-item>
                                        <x-ui.select-item value="rails">Rails</x-ui.select-item>
                                        <x-ui.select-item value="django">Django</x-ui.select-item>
                                    </x-ui.select-content>
                                </x-ui.select>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-ui.checkbox id="t-terms" />
                                <x-ui.label for="t-terms">Accept terms and conditions</x-ui.label>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-ui.switch id="t-airplane" />
                                <x-ui.label for="t-airplane">Airplane mode</x-ui.label>
                            </div>
                        </div>
                    </section>

                    {{-- Card --}}
                    <section class="bg-card rounded-xl border p-6 shadow-sm">
                        <h2 class="text-muted-foreground mb-4 text-xs font-semibold tracking-wide uppercase">Card</h2>
                        <x-ui.card class="w-full">
                            <x-ui.card-header>
                                <x-ui.card-title>Create project</x-ui.card-title>
                                <x-ui.card-description>Deploy your new project in one click.</x-ui.card-description>
                            </x-ui.card-header>
                            <x-ui.card-content>
                                <div class="grid gap-2">
                                    <x-ui.label for="t-name">Name</x-ui.label>
                                    <x-ui.input id="t-name" placeholder="Acme Inc." />
                                </div>
                            </x-ui.card-content>
                            <x-ui.card-footer class="gap-2">
                                <x-ui.button class="w-full">Deploy</x-ui.button>
                                <x-ui.button variant="outline" class="w-full">Cancel</x-ui.button>
                            </x-ui.card-footer>
                        </x-ui.card>
                    </section>
                </div>

                {{-- Tabs --}}
                <section class="bg-card rounded-xl border p-6 shadow-sm">
                    <h2 class="text-muted-foreground mb-4 text-xs font-semibold tracking-wide uppercase">Tabs</h2>
                    <x-ui.tabs value="account" class="w-full max-w-md">
                        <x-ui.tabs-list class="grid w-full grid-cols-2">
                            <x-ui.tabs-trigger value="account">Account</x-ui.tabs-trigger>
                            <x-ui.tabs-trigger value="password">Password</x-ui.tabs-trigger>
                        </x-ui.tabs-list>
                        <x-ui.tabs-content value="account" class="pt-3">
                            <p class="text-muted-foreground text-sm">Make changes to your account, then save.</p>
                        </x-ui.tabs-content>
                        <x-ui.tabs-content value="password" class="pt-3">
                            <p class="text-muted-foreground text-sm">Change your password here.</p>
                        </x-ui.tabs-content>
                    </x-ui.tabs>
                </section>

                {{-- Feedback --}}
                <section class="bg-card rounded-xl border p-6 shadow-sm">
                    <h2 class="text-muted-foreground mb-4 text-xs font-semibold tracking-wide uppercase">Feedback</h2>
                    <div class="space-y-5">
                        <x-ui.alert>
                            <x-lucide-circle-check />
                            <x-ui.alert-title>Your changes have been saved</x-ui.alert-title>
                            <x-ui.alert-description>Every component recolors with your accent.</x-ui.alert-description>
                        </x-ui.alert>
                        <div class="space-y-1.5">
                            <span class="text-sm font-medium">Progress</span>
                            <x-ui.progress :value="60" />
                        </div>
                        <div class="flex items-center gap-3">
                            <x-ui.avatar>
                                <x-ui.avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
                                <x-ui.avatar-fallback>CN</x-ui.avatar-fallback>
                            </x-ui.avatar>
                            <x-ui.badge variant="secondary">Online</x-ui.badge>
                            <x-ui.separator orientation="vertical" class="h-6" />
                            <x-ui.skeleton class="h-8 w-32" />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-layouts.app>
