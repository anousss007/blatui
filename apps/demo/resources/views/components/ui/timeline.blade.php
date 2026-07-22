{{-- A vertical timeline. Compose with <x-ui.timeline-item>. The connector line is
     automatically hidden under the last item. --}}
<ol
    data-slot="timeline"
    {{ $attributes->twMerge('relative flex flex-col [&>li:last-child_[data-slot=timeline-line]]:hidden') }}
>
    {{ $slot }}
</ol>
