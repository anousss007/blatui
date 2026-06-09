{{-- The signature layout: a featured hero card beside a link grid, plus an icon grid. --}}
<x-ui.navigation-menu>
    <x-ui.navigation-menu-list>
        <x-ui.navigation-menu-item>
            <x-ui.navigation-menu-trigger>Getting started</x-ui.navigation-menu-trigger>
            <x-ui.navigation-menu-content>
                <ul class="grid gap-2 p-2 md:w-[400px] lg:w-[500px] lg:grid-cols-[.75fr_1fr]">
                    <li class="row-span-3">
                        <x-ui.navigation-menu-link href="#" class="from-muted/50 to-muted flex h-full w-full flex-col justify-end rounded-md bg-linear-to-b p-6 no-underline select-none">
                            <x-lucide-component class="size-6" />
                            <div class="mt-4 mb-1 text-lg font-medium">BlatUI</div>
                            <p class="text-muted-foreground text-sm leading-tight">Beautifully designed Blade components you copy, paste and own.</p>
                        </x-ui.navigation-menu-link>
                    </li>
                    <li>
                        <x-ui.navigation-menu-link href="#">
                            <div class="text-sm font-medium">Introduction</div>
                            <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">Re-usable components built with Blade and Tailwind CSS.</p>
                        </x-ui.navigation-menu-link>
                    </li>
                    <li>
                        <x-ui.navigation-menu-link href="#">
                            <div class="text-sm font-medium">Installation</div>
                            <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">How to install dependencies and structure your app.</p>
                        </x-ui.navigation-menu-link>
                    </li>
                    <li>
                        <x-ui.navigation-menu-link href="#">
                            <div class="text-sm font-medium">Typography</div>
                            <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">Styles for headings, paragraphs, lists and more.</p>
                        </x-ui.navigation-menu-link>
                    </li>
                </ul>
            </x-ui.navigation-menu-content>
        </x-ui.navigation-menu-item>
        <x-ui.navigation-menu-item>
            <x-ui.navigation-menu-trigger>Components</x-ui.navigation-menu-trigger>
            <x-ui.navigation-menu-content>
                <ul class="grid w-[400px] gap-2 p-2 md:w-[500px] md:grid-cols-2">
                    @foreach ([['layout-grid', 'Layout', 'Page scaffolding and grids.'], ['bell', 'Alerts', 'Banners, toasts and callouts.'], ['mouse-pointer-click', 'Inputs', 'Buttons, fields and controls.'], ['panels-top-left', 'Overlays', 'Dialogs, sheets and popovers.']] as [$icon, $title, $desc])
                        <li>
                            <x-ui.navigation-menu-link href="#" class="flex-row items-center gap-3">
                                <x-dynamic-component :component="'lucide-'.$icon" class="text-muted-foreground size-5 shrink-0" />
                                <div>
                                    <div class="text-sm font-medium">{{ $title }}</div>
                                    <p class="text-muted-foreground line-clamp-1 text-sm leading-snug">{{ $desc }}</p>
                                </div>
                            </x-ui.navigation-menu-link>
                        </li>
                    @endforeach
                </ul>
            </x-ui.navigation-menu-content>
        </x-ui.navigation-menu-item>
    </x-ui.navigation-menu-list>
</x-ui.navigation-menu>
