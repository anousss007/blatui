@props(['index' => 0])

<div
    data-slot="input-otp-slot"
    @click="$refs.input.focus()"
    :data-active="active === {{ $index }}"
    {{ $attributes->twMerge('data-[active=true]:border-ring data-[active=true]:ring-ring/50 data-[active=true]:aria-invalid:ring-destructive/20 dark:data-[active=true]:aria-invalid:ring-destructive/40 aria-invalid:border-destructive data-[active=true]:aria-invalid:border-destructive dark:bg-input/30 border-input relative flex h-9 w-9 items-center justify-center border-y border-r text-sm shadow-xs transition-all outline-none first:rounded-l-md first:border-l last:rounded-r-md data-[active=true]:z-10 data-[active=true]:ring-[3px]') }}
>
    <span x-text="value[{{ $index }}] || ''"></span>
    <div
        x-show="active === {{ $index }} && value.length === {{ $index }}"
        x-cloak
        class="pointer-events-none absolute inset-0 flex items-center justify-center"
    >
        <div class="animate-caret-blink bg-foreground h-4 w-px duration-1000"></div>
    </div>
</div>
