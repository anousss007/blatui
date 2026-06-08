{{--
    Server flash → sonner bridge. Place ONCE, right after <x-ui.sonner /> in your layout.
    Reads Laravel session flashes on render and dispatches a sonner toast for each:
      session('success'|'error'|'warning'|'info'|'message')  → typed toast
      session('status')  → looked up in the (extendable) Fortify status map below
    No imperative JS at the call site — set the flash in your controller as usual.
--}}
@php
    $flashes = [];

    foreach (['success', 'error', 'warning', 'info'] as $key) {
        if (session()->has($key)) {
            $flashes[] = ['type' => $key, 'description' => (string) session($key)];
        }
    }
    if (session()->has('message')) {
        $flashes[] = ['type' => 'info', 'description' => (string) session('message')];
    }

    // Fortify / Laravel 'status' strings → friendly toasts. Extend for your own keys.
    $statusMap = [
        'verification-link-sent' => ['type' => 'success', 'title' => 'Verification link sent', 'description' => 'A new verification link has been emailed to you.'],
        'profile-information-updated' => ['type' => 'success', 'description' => 'Profile updated.'],
        'password-updated' => ['type' => 'success', 'description' => 'Password updated.'],
        'two-factor-authentication-enabled' => ['type' => 'success', 'description' => 'Two-factor authentication enabled.'],
        'two-factor-authentication-confirmed' => ['type' => 'success', 'description' => 'Two-factor authentication confirmed.'],
        'two-factor-authentication-disabled' => ['type' => 'success', 'description' => 'Two-factor authentication disabled.'],
        'recovery-codes-generated' => ['type' => 'success', 'description' => 'Recovery codes generated.'],
        'password-confirmed' => ['type' => 'success', 'description' => 'Password confirmed.'],
    ];
    if (session()->has('status')) {
        $s = (string) session('status');
        $flashes[] = $statusMap[$s] ?? ['type' => 'info', 'description' => $s];
    }
@endphp

@if (! empty($flashes))
    <div
        data-slot="sonner-flash"
        x-data
        x-init="$nextTick(() => { @foreach ($flashes as $f) $dispatch('toast', @js($f)); @endforeach })"
        class="hidden"
        aria-hidden="true"
    ></div>
@endif
