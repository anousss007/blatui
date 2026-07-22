{{--
    Server flash → sonner bridge. Place ONCE, right after <x-ui.sonner /> in your layout.
    Reads Laravel session flashes on render and dispatches a sonner toast for each:
      session('success'|'error'|'warning'|'info'|'message')  → typed toast
      session('status')  → resolved via __() (i18n-first); see below
    No imperative JS at the call site — set the flash in your controller as usual.

    i18n: Fortify/Laravel 'status' slugs are treated as translation KEYS. Define them in your
    lang files (e.g. lang/fr.json: {"verification-link-sent": "Un nouveau lien…"}) and __() wins
    over the English defaults below. A slug with no translation and no default is NEVER shown raw.
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

    // Default (English) copy for known Fortify/Laravel statuses, used ONLY when the app has no
    // translation for the slug. These keys are also translatable — __() takes priority below.
    $statusDefaults = [
        'verification-link-sent' => 'A new verification link has been emailed to you.',
        'profile-information-updated' => 'Profile updated.',
        'password-updated' => 'Password updated.',
        'two-factor-authentication-enabled' => 'Two-factor authentication enabled.',
        'two-factor-authentication-confirmed' => 'Two-factor authentication confirmed.',
        'two-factor-authentication-disabled' => 'Two-factor authentication disabled.',
        'recovery-codes-generated' => 'Recovery codes generated.',
        'password-confirmed' => 'Password confirmed.',
    ];
    if (session()->has('status')) {
        $s = (string) session('status');
        $translated = __($s);

        if ($translated !== $s) {
            // A translation exists for the slug → localised message.
            $flashes[] = ['type' => 'success', 'description' => $translated];
        } elseif (isset($statusDefaults[$s])) {
            // Known status, app provided no translation → fall back to default English copy.
            $flashes[] = ['type' => 'success', 'description' => $statusDefaults[$s]];
        } elseif (str_contains($s, ' ')) {
            // Already a human sentence (a flashed message, not a slug).
            $flashes[] = ['type' => 'success', 'description' => $s];
        }
        // Otherwise: an unresolved slug — skip silently, never leak the raw slug into the UI.
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
