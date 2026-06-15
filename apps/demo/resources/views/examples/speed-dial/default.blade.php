{{-- Click the FAB to reveal the actions. Rendered in-flow in a tall card so the
     expansion is visible inside the preview (in real use, pin it `fixed`). --}}
<div class="bg-muted/30 relative flex h-72 items-end justify-center rounded-lg border p-6">
    <x-ui.speed-dial
        :open="false"
        :actions="[
            ['icon' => 'share-2', 'label' => 'Share', 'href' => '#'],
            ['icon' => 'pencil', 'label' => 'Edit'],
            ['icon' => 'trash-2', 'label' => 'Delete'],
        ]"
    />
</div>
