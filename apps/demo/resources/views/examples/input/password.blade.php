{{-- Leading lock icon + built-in show/hide eye toggle (auto for type="password"). --}}
<div class="grid w-full max-w-sm gap-2">
    <div class="flex items-center justify-between">
        <x-ui.label for="input-password">Mot de passe</x-ui.label>
        <x-ui.link href="#" class="text-sm">Mot de passe oublié ?</x-ui.link>
    </div>
    <x-ui.input type="password" id="input-password" placeholder="••••••••" autocomplete="current-password">
        <x-slot:leading><x-lucide-lock /></x-slot:leading>
    </x-ui.input>
</div>
