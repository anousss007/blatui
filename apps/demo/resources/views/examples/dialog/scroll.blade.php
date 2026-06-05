<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button variant="outline">View terms</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content class="sm:max-w-[480px]">
        <x-ui.dialog-header>
            <x-ui.dialog-title>Terms of Service</x-ui.dialog-title>
            <x-ui.dialog-description>Please review our terms before continuing.</x-ui.dialog-description>
        </x-ui.dialog-header>
        <div class="text-muted-foreground flex max-h-[50vh] flex-col gap-3 overflow-y-auto pr-2 text-sm">
            <p>By accessing this service you agree to be bound by these terms and all applicable laws and regulations.</p>
            <p>You may not use the materials for any commercial purpose without prior written consent.</p>
            <p>The materials are provided on an "as is" basis without warranties of any kind, either express or implied.</p>
            <p>In no event shall we be liable for any damages arising out of the use or inability to use the materials.</p>
            <p>We may revise these terms at any time without notice. By using this service you agree to be bound by the current version.</p>
            <p>These terms are governed by and construed in accordance with applicable law.</p>
        </div>
        <x-ui.dialog-footer>
            <x-ui.dialog-close>
                <x-ui.button variant="outline">Decline</x-ui.button>
            </x-ui.dialog-close>
            <x-ui.button>Accept</x-ui.button>
        </x-ui.dialog-footer>
    </x-ui.dialog-content>
</x-ui.dialog>
