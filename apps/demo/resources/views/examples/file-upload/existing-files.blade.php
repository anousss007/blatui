{{-- An edit form: the record already has a file, so the field starts holding it. Removing one
     dispatches file-remove — the component can withdraw an upload it made, never a file that
     was saved before the page rendered. --}}
<div class="w-full max-w-md" x-data="{ removed: null }" x-on:file-remove="removed = $event.detail.name">
    <x-ui.file-upload
        name="attachments"
        multiple
        maxSizeLabel="Up to 10MB"
        :value="[
            '/placeholder.svg',
            ['url' => '/contract.pdf', 'name' => 'contract.pdf', 'size' => 248320],
        ]"
    />
    <p class="text-muted-foreground mt-2 text-xs" x-show="removed" x-cloak>
        Removed <span class="font-medium" x-text="removed"></span> — clear it on the record.
    </p>
</div>
