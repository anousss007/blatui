<x-ui.drawer>
    <x-ui.drawer-trigger>
        <x-ui.button variant="outline">Contact us</x-ui.button>
    </x-ui.drawer-trigger>
    <x-ui.drawer-content>
        <div class="mx-auto w-full max-w-sm">
            <x-ui.drawer-header>
                <x-ui.drawer-title>Get in touch</x-ui.drawer-title>
                <x-ui.drawer-description>We'll get back to you within one business day.</x-ui.drawer-description>
            </x-ui.drawer-header>
            <form class="flex flex-col gap-4 p-4">
                <x-ui.field>
                    <x-ui.field-label for="drawer-email">Email</x-ui.field-label>
                    <x-ui.input id="drawer-email" type="email" placeholder="m@example.com" />
                </x-ui.field>
                <x-ui.field>
                    <x-ui.field-label for="drawer-msg">Message</x-ui.field-label>
                    <x-ui.textarea id="drawer-msg" placeholder="How can we help?" />
                </x-ui.field>
            </form>
            <x-ui.drawer-footer>
                <x-ui.button>Send message</x-ui.button>
                <x-ui.drawer-close>
                    <x-ui.button variant="outline" class="w-full">Cancel</x-ui.button>
                </x-ui.drawer-close>
            </x-ui.drawer-footer>
        </div>
    </x-ui.drawer-content>
</x-ui.drawer>
