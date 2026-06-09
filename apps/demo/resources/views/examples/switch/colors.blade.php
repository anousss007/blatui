{{-- Recolour the checked state with any background utility. --}}
<div class="flex items-center gap-6">
    <x-ui.switch checked class="data-[state=checked]:bg-green-600 dark:data-[state=checked]:bg-green-500" />
    <x-ui.switch checked class="data-[state=checked]:bg-sky-600 dark:data-[state=checked]:bg-sky-500" />
    <x-ui.switch checked class="data-[state=checked]:bg-amber-500 dark:data-[state=checked]:bg-amber-400" />
    <x-ui.switch checked class="data-[state=checked]:bg-destructive" />
</div>
