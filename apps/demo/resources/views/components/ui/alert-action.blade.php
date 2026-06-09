{{-- Optional trailing slot for an alert — e.g. a dismiss button — pinned top-right. --}}
<div data-slot="alert-action" {{ $attributes->twMerge('absolute end-2.5 top-2.5 flex items-center gap-1') }}>
    {{ $slot }}
</div>
