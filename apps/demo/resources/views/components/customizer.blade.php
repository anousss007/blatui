@props(['triggerClass' => ''])

<x-ui.popover>
    <x-ui.popover-trigger>
        <x-ui.button variant="outline" size="sm" class="{{ $triggerClass }}">
            <x-lucide-paintbrush class="size-4" /> Customize
        </x-ui.button>
    </x-ui.popover-trigger>
    <x-ui.popover-content align="end" class="max-h-[85vh] w-[340px] overflow-y-auto">
        <div class="space-y-5"
            x-data="{ copied: false, copyCss() { navigator.clipboard.writeText(window.exportTheme()); this.copied = true; clearTimeout(this._t); this._t = setTimeout(() => this.copied = false, 2000); } }">
            <div class="flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-semibold">Customize</h4>
                    <p class="text-muted-foreground text-xs">Tune it live. Every preset is pure CSS variables.</p>
                </div>
                <div class="flex items-center gap-1">
                    <x-ui.button variant="ghost" size="sm" @click="$store.theme.randomize()" title="Surprise me — random combination">
                        <x-lucide-dices class="size-3.5" /> Random
                    </x-ui.button>
                    <x-ui.button variant="ghost" size="sm" @click="$store.theme.reset()">Reset</x-ui.button>
                </div>
            </div>

            <x-theme-controls />

            {{-- Apply to your app --}}
            <div class="border-t pt-4">
                <div class="mb-1 flex items-center gap-1.5">
                    <x-lucide-sparkles class="text-primary size-3.5" />
                    <span class="text-xs font-semibold">Apply to your app</span>
                </div>
                <p class="text-muted-foreground mb-2.5 text-xs leading-relaxed">
                    Copy your complete theme and paste it as your <code class="bg-muted rounded px-1 py-0.5 text-[11px]">resources/css/app.css</code> — the Tailwind import, every token and the <code class="bg-muted rounded px-1 py-0.5 text-[11px]">@theme</code> mapping are all included, so it works as-is.
                </p>
                <x-ui.button size="sm" class="w-full" @click="copyCss()">
                    <template x-if="!copied"><span class="inline-flex items-center gap-1.5"><x-lucide-clipboard class="size-3.5" /> Copy theme CSS</span></template>
                    <template x-if="copied"><span class="inline-flex items-center gap-1.5"><x-lucide-check class="size-3.5" /> Copied to clipboard</span></template>
                </x-ui.button>
                <a href="{{ route('themes') }}" class="text-muted-foreground hover:text-foreground mt-2 inline-flex w-full items-center justify-center gap-1.5 text-xs font-medium">
                    <x-lucide-maximize-2 class="size-3" /> Open the full theme editor
                </a>
            </div>
        </div>
    </x-ui.popover-content>
</x-ui.popover>
