@php
    $notes = "- Fixed the layout shift on mobile.\n- Added a dark-mode toggle to settings.\n- Improved keyboard navigation in dialogs.\n- Bumped dependencies and tidied the changelog.";
@endphp

<div class="grid w-full max-w-sm gap-2">
    <x-ui.label for="autosize-prefilled">Release notes</x-ui.label>
    <x-ui.autosize-textarea id="autosize-prefilled" name="notes" :value="$notes" />
</div>
