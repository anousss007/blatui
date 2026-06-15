{{-- Starts expanded (`:open="true"`) so the action buttons and label pills are
     visible at a glance. Toggle, Escape, or a click outside collapses it. --}}
<div class="bg-muted/30 relative flex h-80 items-end justify-center rounded-lg border p-6">
    <x-ui.speed-dial
        :open="true"
        :actions="[
            ['icon' => 'share-2', 'label' => 'Share', 'href' => '#'],
            ['icon' => 'pencil', 'label' => 'Edit'],
            ['icon' => 'trash-2', 'label' => 'Delete'],
        ]"
    />
</div>
