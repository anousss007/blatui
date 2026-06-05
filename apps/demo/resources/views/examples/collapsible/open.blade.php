<x-ui.collapsible open class="flex w-[350px] flex-col gap-2">
    <div class="flex items-center justify-between gap-4 px-4">
        <h4 class="text-sm font-semibold">Started 24 repositories</h4>
        <x-ui.collapsible-trigger class="hover:bg-accent hover:text-accent-foreground inline-flex size-8 items-center justify-center rounded-md">
            <x-lucide-chevrons-up-down class="size-4" aria-hidden="true" />
            <span class="sr-only">Toggle</span>
        </x-ui.collapsible-trigger>
    </div>
    <div class="rounded-md border px-4 py-2 font-mono text-sm">@laravel/framework</div>
    <x-ui.collapsible-content class="flex flex-col gap-2">
        <div class="rounded-md border px-4 py-2 font-mono text-sm">@livewire/livewire</div>
        <div class="rounded-md border px-4 py-2 font-mono text-sm">@alpinejs/alpine</div>
    </x-ui.collapsible-content>
</x-ui.collapsible>
