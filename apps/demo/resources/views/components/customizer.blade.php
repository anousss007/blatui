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
                <x-ui.button variant="ghost" size="sm" @click="$store.theme.reset()">Reset</x-ui.button>
            </div>

            {{-- Mode --}}
            <div class="space-y-1.5">
                <span class="text-xs font-medium">Mode</span>
                <div class="grid grid-cols-3 gap-2">
                    @foreach (['light' => 'Light', 'dark' => 'Dark', 'system' => 'System'] as $val => $lbl)
                        <button type="button" @click="$store.theme.setMode('{{ $val }}')"
                            :data-active="$store.theme.mode === '{{ $val }}'"
                            class="border-input data-[active=true]:border-primary data-[active=true]:bg-accent inline-flex h-8 items-center justify-center gap-1.5 rounded-md border text-xs font-medium transition-colors hover:bg-accent">
                            @if ($val === 'light') <x-lucide-sun class="size-3.5" /> @elseif ($val === 'dark') <x-lucide-moon class="size-3.5" /> @else <x-lucide-monitor class="size-3.5" /> @endif
                            {{ $lbl }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Base color --}}
            <div class="space-y-1.5">
                <span class="text-xs font-medium">Base color</span>
                <div class="grid grid-cols-7 gap-2">
                    @foreach (['neutral' => 'oklch(0.205 0 0)', 'stone' => 'oklch(0.216 0.006 56.043)', 'zinc' => 'oklch(0.21 0.006 285.885)', 'mauve' => 'oklch(0.212 0.019 322.12)', 'olive' => 'oklch(0.228 0.013 107.4)', 'mist' => 'oklch(0.218 0.008 223.9)', 'taupe' => 'oklch(0.214 0.009 43.1)'] as $val => $swatch)
                        <button type="button" @click="$store.theme.setBase('{{ $val }}')" title="{{ ucfirst($val) }}"
                            :data-active="$store.theme.base === '{{ $val }}'"
                            class="border-input data-[active=true]:ring-ring data-[active=true]:ring-2 ring-offset-background flex h-8 items-center justify-center rounded-md border ring-offset-2 transition-all"
                            style="background: {{ $swatch }}">
                            <x-lucide-check class="size-3.5 text-white" x-show="$store.theme.base === '{{ $val }}'" x-cloak />
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Accent color --}}
            <div class="space-y-1.5">
                <span class="text-xs font-medium">Accent</span>
                <div class="grid grid-cols-6 gap-2">
                    @foreach (['default' => 'var(--primary)', 'blue' => 'oklch(0.488 0.243 264.376)', 'indigo' => 'oklch(0.457 0.24 277.023)', 'violet' => 'oklch(0.491 0.27 292.581)', 'purple' => 'oklch(0.496 0.265 301.924)', 'fuchsia' => 'oklch(0.518 0.253 323.949)', 'pink' => 'oklch(0.525 0.223 3.958)', 'rose' => 'oklch(0.514 0.222 16.935)', 'red' => 'oklch(0.505 0.213 27.518)', 'orange' => 'oklch(0.553 0.195 38.402)', 'amber' => 'oklch(0.555 0.163 48.998)', 'yellow' => 'oklch(0.852 0.199 91.936)', 'lime' => 'oklch(0.841 0.238 128.85)', 'green' => 'oklch(0.527 0.154 150.069)', 'emerald' => 'oklch(0.508 0.118 165.612)', 'teal' => 'oklch(0.511 0.096 186.391)', 'cyan' => 'oklch(0.52 0.105 223.128)', 'sky' => 'oklch(0.5 0.134 242.749)'] as $val => $swatch)
                        <button type="button" @click="$store.theme.setPreset('{{ $val }}')" title="{{ ucfirst($val) }}"
                            :data-active="$store.theme.preset === '{{ $val }}'"
                            class="border-input data-[active=true]:ring-ring data-[active=true]:ring-2 ring-offset-background flex h-8 items-center justify-center rounded-md border ring-offset-2 transition-all"
                            style="background: {{ $swatch }}">
                            <x-lucide-check class="size-3.5 text-white" x-show="$store.theme.preset === '{{ $val }}'" x-cloak />
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Radius --}}
            <div class="space-y-1.5">
                <span class="text-xs font-medium">Radius</span>
                <div class="grid grid-cols-6 gap-2">
                    @foreach (['0', '0.3', '0.5', '0.625', '0.75', '1'] as $val)
                        <button type="button" @click="$store.theme.setRadius('{{ $val }}')"
                            :data-active="$store.theme.radius === '{{ $val }}'"
                            class="border-input data-[active=true]:border-primary data-[active=true]:bg-accent inline-flex h-8 items-center justify-center rounded-md border text-xs font-medium transition-colors hover:bg-accent">{{ $val }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Font --}}
            <div class="space-y-1.5">
                <span class="text-xs font-medium">Font</span>
                <div class="grid grid-cols-4 gap-2">
                    @foreach (['sans' => 'Sans', 'system' => 'System', 'serif' => 'Serif', 'mono' => 'Mono'] as $val => $lbl)
                        <button type="button" @click="$store.theme.setFont('{{ $val }}')"
                            :data-active="$store.theme.font === '{{ $val }}'"
                            class="border-input data-[active=true]:border-primary data-[active=true]:bg-accent inline-flex h-8 items-center justify-center rounded-md border text-xs font-medium transition-colors hover:bg-accent">{{ $lbl }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Shadow --}}
            <div class="space-y-1.5">
                <span class="text-xs font-medium">Shadow</span>
                <div class="grid grid-cols-5 gap-2">
                    @foreach (['none' => 'None', 'sm' => 'SM', 'default' => 'Base', 'lg' => 'LG', 'xl' => 'XL'] as $val => $lbl)
                        <button type="button" @click="$store.theme.setShadow('{{ $val }}')"
                            :data-active="$store.theme.shadow === '{{ $val }}'"
                            class="border-input data-[active=true]:border-primary data-[active=true]:bg-accent inline-flex h-8 items-center justify-center rounded-md border text-xs font-medium transition-colors hover:bg-accent">{{ $lbl }}</button>
                    @endforeach
                </div>
            </div>

            {{-- Spacing + Tracking --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <span class="text-xs font-medium">Spacing</span>
                    <div class="grid grid-cols-3 gap-1.5">
                        @foreach (['compact' => 'S', 'default' => 'M', 'comfortable' => 'L'] as $val => $lbl)
                            <button type="button" @click="$store.theme.setSpacing('{{ $val }}')"
                                :data-active="$store.theme.spacing === '{{ $val }}'"
                                class="border-input data-[active=true]:border-primary data-[active=true]:bg-accent inline-flex h-8 items-center justify-center rounded-md border text-xs font-medium transition-colors hover:bg-accent">{{ $lbl }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="space-y-1.5">
                    <span class="text-xs font-medium">Tracking</span>
                    <div class="grid grid-cols-3 gap-1.5">
                        @foreach (['tight' => 'S', 'normal' => 'M', 'wide' => 'L'] as $val => $lbl)
                            <button type="button" @click="$store.theme.setTracking('{{ $val }}')"
                                :data-active="$store.theme.tracking === '{{ $val }}'"
                                class="border-input data-[active=true]:border-primary data-[active=true]:bg-accent inline-flex h-8 items-center justify-center rounded-md border text-xs font-medium transition-colors hover:bg-accent">{{ $lbl }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Apply to your app --}}
            <div class="border-t pt-4">
                <div class="mb-1 flex items-center gap-1.5">
                    <x-lucide-sparkles class="text-primary size-3.5" />
                    <span class="text-xs font-semibold">Apply to your app</span>
                </div>
                <p class="text-muted-foreground mb-2.5 text-xs leading-relaxed">
                    Copy these CSS variables and paste them over the <code class="bg-muted rounded px-1 py-0.5 text-[11px]">:root</code> and <code class="bg-muted rounded px-1 py-0.5 text-[11px]">.dark</code> blocks in your <code class="bg-muted rounded px-1 py-0.5 text-[11px]">app.css</code>.
                </p>
                <x-ui.button size="sm" class="w-full" @click="copyCss()">
                    <template x-if="!copied"><span class="inline-flex items-center gap-1.5"><x-lucide-clipboard class="size-3.5" /> Copy theme CSS</span></template>
                    <template x-if="copied"><span class="inline-flex items-center gap-1.5"><x-lucide-check class="size-3.5" /> Copied to clipboard</span></template>
                </x-ui.button>
            </div>
        </div>
    </x-ui.popover-content>
</x-ui.popover>
