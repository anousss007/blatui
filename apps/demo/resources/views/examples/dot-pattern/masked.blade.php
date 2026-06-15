{{-- :mask="true" fades the dots to transparent toward the edges, densest in the centre. --}}
<div class="bg-card text-card-foreground relative flex h-48 items-center justify-center overflow-hidden rounded-xl border p-8 shadow-sm">
    <x-ui.dot-pattern :mask="true" />

    <p class="text-muted-foreground relative text-sm">
        Edges fade to transparent
    </p>
</div>
