{{-- Dismissible alert with a close button. --}}
<x-ui.alert x-data="{ show: true }" x-show="show" class="max-w-md pe-10">
    <x-lucide-info />
    <x-ui.alert-title>Verify your email to activate your account</x-ui.alert-title>
    <x-ui.alert-description>We've sent a confirmation link to your inbox.</x-ui.alert-description>
    <x-ui.alert-action>
        <button type="button" @click="show = false" aria-label="Dismiss" class="text-muted-foreground hover:text-foreground rounded-sm transition-colors">
            <x-lucide-x class="size-4" />
        </button>
    </x-ui.alert-action>
</x-ui.alert>
