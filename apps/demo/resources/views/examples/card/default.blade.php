<x-ui.card class="w-full max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Create project</x-ui.card-title>
        <x-ui.card-description>Deploy your new project in one-click.</x-ui.card-description>
    </x-ui.card-header>
    <x-ui.card-content>
        <form>
            <div class="flex flex-col gap-6">
                <div class="grid gap-2">
                    <x-ui.label for="name">Name</x-ui.label>
                    <x-ui.input id="name" placeholder="Name of your project" />
                </div>
                <div class="grid gap-2">
                    <x-ui.label for="framework">Framework</x-ui.label>
                    <x-ui.input id="framework" placeholder="Next.js" />
                </div>
            </div>
        </form>
    </x-ui.card-content>
    <x-ui.card-footer class="flex-col gap-2">
        <x-ui.button class="w-full">Deploy</x-ui.button>
        <x-ui.button variant="outline" class="w-full">Cancel</x-ui.button>
    </x-ui.card-footer>
</x-ui.card>
