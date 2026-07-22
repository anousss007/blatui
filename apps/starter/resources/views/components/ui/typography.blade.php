@props([
    'variant' => 'p',   // h1 h2 h3 h4 | p lead large small muted | blockquote | inline-code | list | gradient
    'as' => null,       // override the rendered HTML tag
])

@php
    $map = [
        'h1'          => ['tag' => 'h1',         'class' => 'scroll-m-20 text-4xl font-extrabold tracking-tight text-balance'],
        'h2'          => ['tag' => 'h2',         'class' => 'scroll-m-20 border-b pb-2 text-3xl font-semibold tracking-tight first:mt-0'],
        'h3'          => ['tag' => 'h3',         'class' => 'scroll-m-20 text-2xl font-semibold tracking-tight'],
        'h4'          => ['tag' => 'h4',         'class' => 'scroll-m-20 text-xl font-semibold tracking-tight'],
        'p'           => ['tag' => 'p',          'class' => 'leading-7 [&:not(:first-child)]:mt-6'],
        'lead'        => ['tag' => 'p',          'class' => 'text-muted-foreground text-xl'],
        'large'       => ['tag' => 'div',        'class' => 'text-lg font-semibold'],
        'small'       => ['tag' => 'small',      'class' => 'text-sm leading-none font-medium'],
        'muted'       => ['tag' => 'p',          'class' => 'text-muted-foreground text-sm'],
        'blockquote'  => ['tag' => 'blockquote', 'class' => 'mt-6 border-l-2 pl-6 italic'],
        'inline-code' => ['tag' => 'code',       'class' => 'bg-muted relative rounded px-[0.3rem] py-[0.2rem] font-mono text-sm font-semibold'],
        'list'        => ['tag' => 'ul',         'class' => 'my-6 ml-6 list-disc [&>li]:mt-2'],
        'gradient'    => ['tag' => 'h1',         'class' => 'bg-linear-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-4xl font-extrabold tracking-tight text-transparent'],
    ];

    $entry = $map[$variant] ?? $map['p'];
    $tag = $as ?? $entry['tag'];
@endphp

<{{ $tag }} data-slot="typography" data-variant="{{ $variant }}" {{ $attributes->twMerge($entry['class']) }}>{{ $slot }}</{{ $tag }}>
