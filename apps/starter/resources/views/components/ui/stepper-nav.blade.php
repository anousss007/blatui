{{-- The step rail. Switches direction with the parent stepper's orientation. --}}
<ol
    data-slot="stepper-nav"
    :class="orientation === 'vertical' ? 'flex-col' : 'flex-row items-center'"
    {{ $attributes->twMerge('flex w-full gap-2 overflow-x-auto') }}
>
    {{ $slot }}
</ol>
