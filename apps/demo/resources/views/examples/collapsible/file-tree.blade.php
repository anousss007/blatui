{{-- Nested collapsibles as a file explorer; folders swap icon + chevron rotates. --}}
@php
    $row = 'group flex w-full items-center gap-1.5 rounded-md px-2 py-1 text-sm hover:bg-accent hover:text-accent-foreground';
    $file = 'flex items-center gap-1.5 rounded-md px-2 py-1 text-sm ml-5.5';
@endphp

<x-ui.collapsible open class="w-[300px]">
    <x-ui.collapsible-trigger class="{{ $row }}">
        <x-lucide-chevron-right class="text-muted-foreground size-4 shrink-0 transition-transform [[data-state=open]>&]:rotate-90" aria-hidden="true" />
        <x-lucide-folder class="size-4 shrink-0 text-sky-600 [[data-state=open]>&]:hidden dark:text-sky-400" aria-hidden="true" />
        <x-lucide-folder-open class="hidden size-4 shrink-0 text-sky-600 [[data-state=open]>&]:block dark:text-sky-400" aria-hidden="true" />
        <span class="font-medium">app</span>
    </x-ui.collapsible-trigger>
    <x-ui.collapsible-content class="ms-3.5 mt-0.5 flex flex-col gap-0.5 border-s ps-2">
        <x-ui.collapsible class="flex flex-col gap-0.5">
            <x-ui.collapsible-trigger class="{{ $row }}">
                <x-lucide-chevron-right class="text-muted-foreground size-4 shrink-0 transition-transform [[data-state=open]>&]:rotate-90" aria-hidden="true" />
                <x-lucide-folder class="size-4 shrink-0 text-sky-600 [[data-state=open]>&]:hidden dark:text-sky-400" aria-hidden="true" />
                <x-lucide-folder-open class="hidden size-4 shrink-0 text-sky-600 [[data-state=open]>&]:block dark:text-sky-400" aria-hidden="true" />
                <span>Http</span>
            </x-ui.collapsible-trigger>
            <x-ui.collapsible-content class="ms-3.5 flex flex-col gap-0.5 border-s ps-2">
                <div class="{{ $file }}"><x-lucide-file class="text-muted-foreground size-4 shrink-0" aria-hidden="true" /> Kernel.php</div>
                <div class="{{ $file }}"><x-lucide-file class="text-muted-foreground size-4 shrink-0" aria-hidden="true" /> Middleware.php</div>
            </x-ui.collapsible-content>
        </x-ui.collapsible>
        <div class="{{ $file }}"><x-lucide-file class="text-muted-foreground size-4 shrink-0" aria-hidden="true" /> Models/User.php</div>
        <div class="{{ $file }}"><x-lucide-file class="text-muted-foreground size-4 shrink-0" aria-hidden="true" /> Providers/AppServiceProvider.php</div>
    </x-ui.collapsible-content>
</x-ui.collapsible>
