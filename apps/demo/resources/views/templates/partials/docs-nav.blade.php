@php
    $sections = [
        'Getting Started' => [['Introduction', true], ['Installation', false], ['Quick start', false], ['Project structure', false]],
        'Guides' => [['Theming', false], ['Dark mode', false], ['Accessibility', false], ['Forms', false], ['Deployment', false]],
        'Components' => [['Overview', false], ['Button', false], ['Dialog', false], ['Data table', false]],
        'API' => [['CLI reference', false], ['Registry', false], ['Configuration', false]],
    ];
@endphp

<nav class="space-y-6 text-sm">
    @foreach ($sections as $heading => $links)
        <div>
            <p class="mb-2 px-2 font-semibold">{{ $heading }}</p>
            <ul class="space-y-0.5">
                @foreach ($links as [$label, $active])
                    <li>
                        <a href="#" @class([
                            'block rounded-md px-2 py-1.5 transition-colors',
                            'bg-accent text-accent-foreground font-medium' => $active,
                            'text-muted-foreground hover:text-foreground hover:bg-accent/60' => ! $active,
                        ])>{{ $label }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</nav>
