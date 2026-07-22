@php
    $toc = [
        ['href' => '#introduction', 'label' => 'Introduction', 'level' => 1],
        ['href' => '#installation', 'label' => 'Installation', 'level' => 1],
        ['href' => '#configuration', 'label' => 'Configuration', 'level' => 2],
        ['href' => '#usage', 'label' => 'Usage', 'level' => 1],
        ['href' => '#examples', 'label' => 'Examples', 'level' => 2],
    ];
@endphp

<div class="grid gap-8 md:grid-cols-[200px_1fr]">
    {{-- Table of contents --}}
    <div class="md:sticky md:top-4 md:self-start">
        <x-ui.scrollspy :items="$toc" />
    </div>

    {{-- Content sections --}}
    <div class="flex flex-col gap-6">
        <section id="introduction" class="flex min-h-[40vh] flex-col gap-2 scroll-mt-4">
            <h3 class="text-lg font-semibold">Introduction</h3>
            <p class="text-muted-foreground text-sm">
                Scroll the content and watch the table of contents highlight the section currently in view.
            </p>
        </section>

        <section id="installation" class="flex min-h-[40vh] flex-col gap-2 scroll-mt-4">
            <h3 class="text-lg font-semibold">Installation</h3>
            <p class="text-muted-foreground text-sm">
                Add the component to your project and reference each section by its matching id.
            </p>
        </section>

        <section id="configuration" class="flex min-h-[40vh] flex-col gap-2 scroll-mt-4">
            <h3 class="text-lg font-semibold">Configuration</h3>
            <p class="text-muted-foreground text-sm">
                A nested item rendered with an extra inline-start indent.
            </p>
        </section>

        <section id="usage" class="flex min-h-[40vh] flex-col gap-2 scroll-mt-4">
            <h3 class="text-lg font-semibold">Usage</h3>
            <p class="text-muted-foreground text-sm">
                Click a link to jump to a section, or scroll to update the active state automatically.
            </p>
        </section>

        <section id="examples" class="flex min-h-[40vh] flex-col gap-2 scroll-mt-4">
            <h3 class="text-lg font-semibold">Examples</h3>
            <p class="text-muted-foreground text-sm">
                Another nested item demonstrating the deeper indent level.
            </p>
        </section>
    </div>
</div>
