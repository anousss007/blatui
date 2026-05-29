@props(['orientation' => 'horizontal'])

<div
    role="group"
    data-slot="button-group"
    data-orientation="{{ $orientation }}"
    {{ $attributes->twMerge("flex w-fit items-stretch [&>*]:focus-within:z-10 [&>*]:focus-visible:z-10 [&>[data-slot=select-trigger]:not([class*='w-'])]:w-fit has-[>[data-slot=button-group]]:gap-2 data-[orientation=vertical]:flex-col data-[orientation=horizontal]:[&>*:not(:first-child)]:rounded-l-none data-[orientation=horizontal]:[&>*:not(:first-child)]:border-l-0 data-[orientation=horizontal]:[&>*:not(:last-child)]:rounded-r-none data-[orientation=vertical]:[&>*:not(:first-child)]:rounded-t-none data-[orientation=vertical]:[&>*:not(:first-child)]:border-t-0 data-[orientation=vertical]:[&>*:not(:last-child)]:rounded-b-none") }}
>
    {{ $slot }}
</div>
