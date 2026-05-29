<x-ui.navigation-menu>
    <x-ui.navigation-menu-list>
        <x-ui.navigation-menu-item>
            <x-ui.navigation-menu-trigger>Getting started</x-ui.navigation-menu-trigger>
            <x-ui.navigation-menu-content>
                <ul class="grid w-[300px] gap-1">
                    <li>
                        <x-ui.navigation-menu-link href="#">
                            <div class="text-sm font-medium leading-none">Introduction</div>
                            <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">
                                Re-usable components built with Blade and Tailwind CSS.
                            </p>
                        </x-ui.navigation-menu-link>
                    </li>
                    <li>
                        <x-ui.navigation-menu-link href="#">
                            <div class="text-sm font-medium leading-none">Installation</div>
                            <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">
                                How to install dependencies and structure your app.
                            </p>
                        </x-ui.navigation-menu-link>
                    </li>
                </ul>
            </x-ui.navigation-menu-content>
        </x-ui.navigation-menu-item>
        <x-ui.navigation-menu-item>
            <x-ui.navigation-menu-trigger>Components</x-ui.navigation-menu-trigger>
            <x-ui.navigation-menu-content>
                <ul class="grid w-[300px] gap-1">
                    <li>
                        <x-ui.navigation-menu-link href="#">
                            <div class="text-sm font-medium leading-none">Alert Dialog</div>
                            <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">
                                A modal dialog that interrupts the user with important content.
                            </p>
                        </x-ui.navigation-menu-link>
                    </li>
                    <li>
                        <x-ui.navigation-menu-link href="#">
                            <div class="text-sm font-medium leading-none">Tooltip</div>
                            <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">
                                A popup that displays information related to an element.
                            </p>
                        </x-ui.navigation-menu-link>
                    </li>
                </ul>
            </x-ui.navigation-menu-content>
        </x-ui.navigation-menu-item>
        <x-ui.navigation-menu-item>
            <x-ui.navigation-menu-link href="#" class="px-4 py-2">Docs</x-ui.navigation-menu-link>
        </x-ui.navigation-menu-item>
    </x-ui.navigation-menu-list>
</x-ui.navigation-menu>
