<x-ui.radio-group value="pro" class="grid w-full max-w-md gap-3 sm:grid-cols-3">
    <label @click="value = 'starter'; rovingValue = 'starter'"
        class="border-input has-[[data-state=checked]]:border-primary has-[[data-state=checked]]:ring-ring/40 has-[[data-state=checked]]:ring-[3px] relative flex cursor-pointer flex-col gap-1 rounded-lg border p-4 transition-[color,box-shadow]">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">Starter</span>
            <x-ui.radio-group-item value="starter" aria-label="Starter plan" />
        </div>
        <span class="text-muted-foreground text-xs">$0 / month</span>
    </label>
    <label @click="value = 'pro'; rovingValue = 'pro'"
        class="border-input has-[[data-state=checked]]:border-primary has-[[data-state=checked]]:ring-ring/40 has-[[data-state=checked]]:ring-[3px] relative flex cursor-pointer flex-col gap-1 rounded-lg border p-4 transition-[color,box-shadow]">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">Pro</span>
            <x-ui.radio-group-item value="pro" aria-label="Pro plan" />
        </div>
        <span class="text-muted-foreground text-xs">$12 / month</span>
    </label>
    <label @click="value = 'team'; rovingValue = 'team'"
        class="border-input has-[[data-state=checked]]:border-primary has-[[data-state=checked]]:ring-ring/40 has-[[data-state=checked]]:ring-[3px] relative flex cursor-pointer flex-col gap-1 rounded-lg border p-4 transition-[color,box-shadow]">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium">Team</span>
            <x-ui.radio-group-item value="team" aria-label="Team plan" />
        </div>
        <span class="text-muted-foreground text-xs">$32 / month</span>
    </label>
</x-ui.radio-group>
