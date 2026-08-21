{{-- The bar is Livewire's own upload progress, so it appears when there is an upload behind
     the field. In a plain form the component lists what you picked and draws no bar — nothing
     is being uploaded yet. --}}
<div class="w-full max-w-md">
    <x-ui.file-upload wire:model="uploads" multiple maxSizeLabel="Progress tracks the real upload" />
</div>
