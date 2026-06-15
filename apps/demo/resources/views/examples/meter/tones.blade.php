{{-- Force a status colour with the `tone` prop. --}}
<div class="flex w-full max-w-sm flex-col gap-4">
    <x-ui.meter :value="32" label="Disk usage" tone="good" />
    <x-ui.meter :value="78" label="Memory" tone="warning" />
    <x-ui.meter :value="94" label="Quota" tone="danger" />
</div>
