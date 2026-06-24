<div class="flex flex-wrap gap-3">
    {{-- Aim the burst: degrees where 0=right, 90=up, 180=left. spreadArc narrows the fan. --}}
    <x-ui.confetti :direction="60" :spread-arc="50">
        <x-ui.button variant="outline" type="button">Up &amp; right</x-ui.button>
    </x-ui.confetti>
    <x-ui.confetti :direction="120" :spread-arc="50">
        <x-ui.button variant="outline" type="button">Up &amp; left</x-ui.button>
    </x-ui.confetti>
</div>
