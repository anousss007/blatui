{{--
    docs/livewire-usage — renders a "Using with Livewire" section on a component page when the
    component is bindable (descriptor in config('docs.livewire.<slug>')). The page's examples
    already show the frontend (Blade/Alpine) usage; this shows the same component driven by a
    Livewire property via wire:model. Renders nothing for non-bindable components.

    {{ }} echoes auto-escape the markup into HTML entities; <x-code-block> outputs its slot raw,
    so the snippet displays as literal code instead of being compiled.
--}}
@props(['slug'])

@php
    $lw = config('docs.livewire.'.$slug);
@endphp

@if ($lw)
    <section class="mt-12">
        <div class="flex flex-wrap items-center gap-2">
            <h2 class="text-xl font-semibold tracking-tight">Using with Livewire</h2>
            <span class="bg-primary/10 text-primary inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-[11px] font-medium">
                <x-lucide-zap class="size-3" aria-hidden="true" /> wire:model
            </span>
        </div>
        <p class="text-muted-foreground mt-1.5 mb-4 text-sm">
            The examples above are the frontend (Blade + Alpine) usage. Inside a Livewire component, bind
            <code class="bg-muted rounded px-1 py-0.5 font-mono text-[0.85em]">wire:model</code> for two-way
            state — same component, no wrappers.
            <a href="/docs/livewire" class="text-primary underline underline-offset-4">Full Livewire guide →</a>
        </p>

        <div class="space-y-3">
            <x-code-block label="app/Livewire/Demo.php" icon="file-code">use Livewire\Component;

class Demo extends Component
{
    {{ $lw['decl'] }}

    public function render()
    {
        return view('livewire.demo');
    }
}</x-code-block>

            <x-code-block label="resources/views/livewire/demo.blade.php" icon="code">{{ $lw['tag'] }}</x-code-block>
        </div>

        @if (! empty($lw['note']))
            <p class="text-muted-foreground mt-2 text-xs">{{ $lw['note'] }}</p>
        @endif
    </section>
@endif
