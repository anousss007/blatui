{{-- Two icon tiles connected by a beam that continuously "syncs" between them. --}}
<x-ui.animated-beam from="#beam-a" to="#beam-b" class="mx-auto max-w-md py-10">
    <div class="flex items-center justify-between px-6">
        <div
            id="beam-a"
            class="bg-background text-foreground flex size-14 items-center justify-center rounded-xl border shadow-sm"
        >
            <x-lucide-laptop class="size-6" aria-hidden="true" />
            <span class="sr-only">Your device</span>
        </div>

        <div
            id="beam-b"
            class="bg-background text-foreground flex size-14 items-center justify-center rounded-xl border shadow-sm"
        >
            <x-lucide-cloud class="size-6" aria-hidden="true" />
            <span class="sr-only">Cloud</span>
        </div>
    </div>
</x-ui.animated-beam>
