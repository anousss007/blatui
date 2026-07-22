<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button variant="outline"><x-lucide-message-square aria-hidden="true" /> Submit feedback</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content class="sm:max-w-[425px]">
        <x-ui.dialog-header>
            <x-ui.dialog-title>Submit feedback</x-ui.dialog-title>
            <x-ui.dialog-description>Tell us what's working well or what could be better.</x-ui.dialog-description>
        </x-ui.dialog-header>
        <div class="flex flex-col gap-4 py-2">
            <x-ui.field>
                <x-ui.field-label for="fb-title">Title</x-ui.field-label>
                <x-ui.input id="fb-title" placeholder="Short summary" />
            </x-ui.field>
            <x-ui.field>
                <x-ui.field-label for="fb-type">Type</x-ui.field-label>
                <x-ui.select>
                    <x-ui.select-trigger id="fb-type" class="w-full"><x-ui.select-value placeholder="Select a type" /></x-ui.select-trigger>
                    <x-ui.select-content>
                        <x-ui.select-item value="bug">Bug report</x-ui.select-item>
                        <x-ui.select-item value="idea">Idea</x-ui.select-item>
                        <x-ui.select-item value="question">Question</x-ui.select-item>
                        <x-ui.select-item value="other">Other</x-ui.select-item>
                    </x-ui.select-content>
                </x-ui.select>
            </x-ui.field>
            <x-ui.field>
                <x-ui.field-label for="fb-desc">Description</x-ui.field-label>
                <x-ui.textarea id="fb-desc" placeholder="Describe it in a little more detail…" />
            </x-ui.field>
        </div>
        <x-ui.dialog-footer>
            <x-ui.dialog-close>
                <x-ui.button variant="outline">Cancel</x-ui.button>
            </x-ui.dialog-close>
            <x-ui.button>Send feedback</x-ui.button>
        </x-ui.dialog-footer>
    </x-ui.dialog-content>
</x-ui.dialog>
