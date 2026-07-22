{{-- <x-ui.icon> mirrors directional arrows/chevrons under RTL automatically.
     The right block is dir="rtl" — the arrow flips, the (non-directional) bell does not. --}}
<div class="flex items-center gap-8">
    <div class="flex items-center gap-2" dir="ltr">
        <span class="text-muted-foreground text-xs">LTR</span>
        <x-ui.icon name="arrow-right" class="size-5" />
        <x-ui.icon name="bell" class="size-5" />
    </div>
    <div class="flex items-center gap-2" dir="rtl">
        <span class="text-muted-foreground text-xs">RTL</span>
        <x-ui.icon name="arrow-right" class="size-5" />
        <x-ui.icon name="bell" class="size-5" />
    </div>
</div>
