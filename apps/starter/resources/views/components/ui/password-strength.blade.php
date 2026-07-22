@props([
    'name' => 'password',
    'id' => null,
    'placeholder' => '••••••••',
    'showChecklist' => true,
    'minLength' => 8,
    'size' => 'default',
    'label' => 'Password',
])

@php
    $fieldId = $id ?: $name;

    // Field styling lifted from input.blade.php so the password field matches the design system.
    $base = "file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input flex w-full min-w-0 rounded-md border bg-transparent shadow-xs transition-[color,box-shadow] outline-none disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive";

    $sizes = [
        'sm' => 'h-8 px-2.5 py-1 text-sm',
        'default' => 'h-9 px-3 py-1 text-base md:text-sm',
        'lg' => 'h-10 px-4 py-2 text-base',
    ];

    // pe-10 leaves room for the show/hide eye toggle (logical prop → RTL-safe).
    $fieldClasses = $base.' '.($sizes[$size] ?? $sizes['default']).' pe-10';
@endphp

<div
    data-slot="password-strength"
    x-data="{
        password: '',
        show: false,
        minLength: @js((int) $minLength),
        get hasLength() { return this.password.length >= this.minLength; },
        get hasCase() { return /[a-z]/.test(this.password) && /[A-Z]/.test(this.password); },
        get hasDigit() { return /[0-9]/.test(this.password); },
        get hasSymbol() { return /[^A-Za-z0-9]/.test(this.password); },
        get score() {
            if (this.password.length === 0) return 0;
            return (this.hasLength ? 1 : 0) + (this.hasCase ? 1 : 0) + (this.hasDigit ? 1 : 0) + (this.hasSymbol ? 1 : 0);
        },
        get label() {
            return ['', 'Weak', 'Fair', 'Good', 'Strong'][this.score] || '';
        },
        segmentColor(i) {
            if (i > this.score) return 'bg-muted';
            return ['bg-muted', 'bg-destructive', 'bg-amber-500', 'bg-yellow-500', 'bg-emerald-500'][this.score];
        },
    }"
    {{ $attributes->twMerge('space-y-2') }}
>
    <label for="{{ $fieldId }}" class="sr-only">{{ $label }}</label>

    <div data-slot="password-strength-field" class="relative w-full">
        <input
            type="password"
            x-bind:type="show ? 'text' : 'password'"
            x-model="password"
            data-slot="password-strength-input"
            id="{{ $fieldId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            autocomplete="new-password"
            aria-describedby="{{ $fieldId }}-strength"
            class="{{ $fieldClasses }}"
        />

        <button
            type="button"
            @click="show = !show"
            aria-label="Show password"
            x-bind:aria-label="show ? 'Hide password' : 'Show password'"
            x-bind:aria-pressed="show"
            class="text-muted-foreground hover:text-foreground focus-visible:ring-ring/50 absolute inset-y-0 end-0 flex items-center rounded-md px-3 outline-none transition-colors focus-visible:ring-[3px]"
        >
            {{-- eye (password hidden) --}}
            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                <circle cx="12" cy="12" r="3" />
            </svg>
            {{-- eye-off (password visible) --}}
            <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                <path d="m2 2 20 20" />
            </svg>
        </button>
    </div>

    {{-- Segment bars: fill left-to-right by score. --}}
    <div data-slot="password-strength-meter" class="flex gap-1.5" aria-hidden="true">
        <template x-for="i in 4" :key="i">
            <div class="h-1.5 flex-1 rounded-full transition-colors" :class="segmentColor(i)"></div>
        </template>
    </div>

    {{-- Live-announced strength label. --}}
    <p
        id="{{ $fieldId }}-strength"
        data-slot="password-strength-label"
        class="text-muted-foreground h-4 text-xs"
        aria-live="polite"
    >
        <template x-if="password.length > 0">
            <span><span class="sr-only">Password strength: </span><span class="text-foreground font-medium" x-text="label"></span></span>
        </template>
    </p>

    @if ($showChecklist)
        <ul data-slot="password-strength-checklist" class="space-y-1 text-xs">
            @php
                $rules = [
                    ['key' => 'hasLength', 'text' => "At least {$minLength} characters"],
                    ['key' => 'hasCase', 'text' => 'Upper & lowercase letters'],
                    ['key' => 'hasDigit', 'text' => 'A number'],
                    ['key' => 'hasSymbol', 'text' => 'A symbol'],
                ];
            @endphp
            @foreach ($rules as $rule)
                <li class="flex items-center gap-2" :class="{{ $rule['key'] }} ? 'text-emerald-600 dark:text-emerald-400' : 'text-muted-foreground'">
                    <span x-show="{{ $rule['key'] }}">
                        <x-lucide-check class="size-3.5 shrink-0" aria-hidden="true" />
                        <span class="sr-only">Met:</span>
                    </span>
                    <span x-show="! {{ $rule['key'] }}">
                        <x-lucide-x class="size-3.5 shrink-0" aria-hidden="true" />
                        <span class="sr-only">Not met:</span>
                    </span>
                    <span>{{ $rule['text'] }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
