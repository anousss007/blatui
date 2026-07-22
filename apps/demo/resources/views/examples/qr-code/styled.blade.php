{{-- A larger code with recoloured modules: the dark modules use currentColor, so a
     text-* utility on the component repaints them. Keep strong contrast so it stays
     scannable. --}}
<x-ui.qr-code
    value="https://blatui.remix-it.com"
    :size="220"
    ecc="Q"
    class="text-emerald-600 dark:text-emerald-400"
/>
