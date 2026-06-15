{{-- Higher error-correction (ecc="H", ~30% recoverable) is denser but survives damage,
     logos and smudges — at the cost of more modules for the same data. --}}
<div class="flex flex-wrap items-end gap-8">
    <div class="flex flex-col items-center gap-2">
        <x-ui.qr-code value="https://blatui.remix-it.com" ecc="L" />
        <span class="text-muted-foreground text-xs">Low (~7%)</span>
    </div>
    <div class="flex flex-col items-center gap-2">
        <x-ui.qr-code value="https://blatui.remix-it.com" ecc="H" />
        <span class="text-muted-foreground text-xs">High (~30%)</span>
    </div>
</div>
