@props([
    'name' => null,
    'maxlength' => 6,
    'value' => '',
    'disabled' => false,
])

<div
    data-slot="input-otp"
    x-data="{
        value: @js((string) $value),
        max: {{ $maxlength }},
        focused: false,
        get active() { return this.focused ? Math.min(this.value.length, this.max - 1) : -1 }
    }"
    {{ $attributes->twMerge('relative flex items-center gap-2 has-disabled:opacity-50') }}
>
    <input
        x-ref="input"
        x-model="value"
        :maxlength="max"
        @focus="focused = true"
        @blur="focused = false"
        inputmode="numeric"
        autocomplete="one-time-code"
        pattern="[0-9]*"
        @if ($name) name="{{ $name }}" @endif
        @if ($disabled) disabled @endif
        class="absolute inset-0 z-10 h-full w-full cursor-default opacity-0 disabled:cursor-not-allowed"
    >
    {{ $slot }}
</div>
