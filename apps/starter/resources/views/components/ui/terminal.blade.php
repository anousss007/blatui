@props([
    'title' => null,    // optional label shown in the title bar (e.g. "~/app — zsh")
    'buttons' => true,  // show the red/amber/green traffic-light dots
])

{{-- A terminal / console window. Deliberately dark in both light and dark themes —
     a terminal is a terminal. Put your prompt + output lines in the slot; the
     `font-mono` and colour helpers below are available for them. --}}
<div
    data-slot="terminal"
    {{ $attributes->twMerge('overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950 text-zinc-100 shadow-md') }}
>
    <div data-slot="terminal-bar" class="flex items-center gap-2 border-b border-white/10 bg-zinc-900 px-3.5 py-2.5">
        @if ($buttons)
            <span class="size-3 rounded-full" style="background:#ff5f57"></span>
            <span class="size-3 rounded-full" style="background:#febc2e"></span>
            <span class="size-3 rounded-full" style="background:#28c840"></span>
        @endif
        @if ($title)
            <span data-slot="terminal-title" class="{{ $buttons ? 'ml-2' : '' }} truncate font-mono text-xs text-zinc-400">{{ $title }}</span>
        @endif
    </div>
    <div data-slot="terminal-body" class="overflow-x-auto p-4 font-mono text-[13px] leading-relaxed [&_.prompt]:text-emerald-400 [&_.ok]:text-emerald-400 [&_.dim]:text-zinc-400 [&_.path]:text-cyan-400 [&_.warn]:text-amber-400">
        {{ $slot }}
    </div>
</div>
