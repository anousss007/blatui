{{-- Prefix (leading) icon via the `leading` slot — the field auto-pads so text clears the icon. --}}
<div class="grid w-full max-w-sm gap-2">
    <x-ui.label for="input-email">Email</x-ui.label>
    <x-ui.input type="email" id="input-email" placeholder="vous@exemple.com" autocomplete="email">
        <x-slot:leading><x-lucide-mail /></x-slot:leading>
    </x-ui.input>
</div>
