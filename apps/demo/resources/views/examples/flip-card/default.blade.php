<x-ui.flip-card class="max-w-xs">
    <x-slot:front>
        <div class="flex flex-1 flex-col items-center justify-center gap-2 text-center">
            <x-lucide-sparkles class="size-8 text-primary" aria-hidden="true" />
            <h3 class="text-lg font-semibold">Aurora Plan</h3>
            <p class="text-muted-foreground text-sm">Hover to see the details</p>
        </div>
    </x-slot:front>

    <x-slot:back>
        <div class="flex flex-1 flex-col justify-center gap-3 text-center">
            <p class="text-3xl font-bold">$19<span class="text-muted-foreground text-base font-normal">/mo</span></p>
            <ul class="text-muted-foreground space-y-1 text-sm">
                <li>Unlimited projects</li>
                <li>Priority support</li>
                <li>Custom domains</li>
            </ul>
        </div>
    </x-slot:back>
</x-ui.flip-card>
