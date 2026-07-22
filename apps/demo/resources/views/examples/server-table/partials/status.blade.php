{{-- Cell view for the "status" column — included by server-table with $value and $row in scope. --}}
@php
    $tone = match ($value) {
        'Active' => 'success',
        'Invited' => 'info',
        'Suspended' => 'danger',
        default => 'neutral',
    };
@endphp
<x-ui.badge :tone="$tone">{{ $value }}</x-ui.badge>
