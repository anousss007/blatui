<x-ui.hover-card>
    <x-ui.hover-card-trigger>
        <x-ui.button variant="link">&#64;nextjs</x-ui.button>
    </x-ui.hover-card-trigger>
    <x-ui.hover-card-content class="w-80">
        <div class="flex justify-between gap-4">
            <x-ui.avatar>
                <x-ui.avatar-image src="https://github.com/vercel.png" alt="@nextjs" />
                <x-ui.avatar-fallback>VC</x-ui.avatar-fallback>
            </x-ui.avatar>
            <div class="space-y-1">
                <h4 class="text-sm font-semibold">&#64;nextjs</h4>
                <p class="text-sm">
                    The React Framework &ndash; created and maintained by &#64;vercel.
                </p>
                <div class="text-muted-foreground flex items-center gap-2 pt-2 text-xs">
                    <x-lucide-calendar class="size-4" />
                    <span>Joined December 2021</span>
                </div>
            </div>
        </div>
    </x-ui.hover-card-content>
</x-ui.hover-card>
