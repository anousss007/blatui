{{-- Rich "name" cell — an initials avatar plus the name, driven by $value / $row. --}}
@php
    $initials = \Illuminate\Support\Str::of($value)->explode(' ')->map(fn ($p) => \Illuminate\Support\Str::substr($p, 0, 1))->take(2)->implode('');
@endphp
<div class="flex items-center gap-2">
    <span class="bg-muted text-muted-foreground flex size-7 items-center justify-center rounded-full text-xs font-medium" aria-hidden="true">{{ $initials }}</span>
    <div class="flex flex-col">
        <span class="font-medium">{{ $value }}</span>
        <span class="text-muted-foreground text-xs">{{ data_get($row, 'email') }}</span>
    </div>
</div>
