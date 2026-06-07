@php
    // Auto-discover block views so this index stays in sync as blocks are added.
    $files = collect(glob(resource_path('views/blocks/*.blade.php')))
        ->map(fn ($p) => basename($p, '.blade.php'))
        ->reject(fn ($n) => $n === 'index')
        ->values();

    $order = ['marketing' => 'Marketing', 'pricing' => 'Pricing', 'dashboard' => 'Dashboard', 'sidebar' => 'Sidebar', 'login' => 'Login', 'signup' => 'Sign Up', 'calendar' => 'Calendars'];

    $groups = collect($order)->mapWithKeys(function ($label, $prefix) use ($files) {
        $items = $files->filter(fn ($n) => str_starts_with($n, $prefix.'-'))->sort()->values();
        return [$label => $items];
    })->filter(fn ($items) => $items->isNotEmpty());

    $total = $files->count();

    // Featured component compositions (rendered inline, kept interactive).
    $examples = [
        ['examples.card.product', 'Product showcase', 'card'],
        ['examples.card.share', 'Share document', 'card'],
        ['examples.card.payment', 'Payment method', 'card'],
        ['examples.card.notifications', 'Notifications', 'card'],
        ['examples.card.blog', 'Blog post', 'card'],
        ['examples.card.pricing', 'Pricing plan', 'card'],
        ['examples.card.profile', 'User profile', 'card'],
        ['examples.card.testimonial', 'Testimonial', 'card'],
        ['examples.card.login', 'Sign in', 'card'],
        ['examples.card.with-action', 'Team members', 'card'],
        ['examples.dialog.feedback', 'Submit feedback', 'dialog'],
        ['examples.popover.share', 'Share popover', 'popover'],
    ];
@endphp

<x-layouts.app title="Blocks" description="62 ready-made Laravel UI blocks — dashboards, authentication, sidebars and calendars. Live previews; copy the Blade source.">
    <x-site.header active="blocks" />

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="from-primary/20 h-80 w-[700px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-6xl px-6 py-14 lg:px-8">
            <span class="bg-primary/10 text-primary mb-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium">
                <x-lucide-layout-template class="size-3.5" /> {{ count($examples) }} examples · {{ $total }} blocks
            </span>
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">Blocks &amp; examples</h1>
            <p class="text-muted-foreground mt-3 max-w-2xl text-lg">
                Real-world component compositions and full-page layouts — product cards, pricing, auth,
                dashboards, sidebars and calendars. Live previews; copy the Blade source.
            </p>
        </div>
    </section>

    <div class="mx-auto w-full max-w-6xl px-6 py-12 lg:px-8">
        {{-- Featured component compositions (inline, interactive) --}}
        <section class="mb-16 scroll-mt-20" id="examples">
            <div class="mb-5 flex items-baseline gap-3">
                <h2 class="text-2xl font-semibold tracking-tight">Examples</h2>
                <span class="text-muted-foreground text-sm">{{ count($examples) }} compositions</span>
            </div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($examples as [$view, $label, $component])
                    <div class="flex flex-col gap-3">
                        <div class="bg-background flex min-h-[340px] items-center justify-center overflow-hidden rounded-xl border p-6">
                            @include($view)
                        </div>
                        <div class="flex items-center justify-between px-1">
                            <span class="text-sm font-medium">{{ $label }}</span>
                            <a href="/components/{{ $component }}" class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1 text-xs">
                                {{ \Illuminate\Support\Str::headline($component) }}
                                <x-lucide-arrow-right class="size-3" aria-hidden="true" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        @foreach ($groups as $label => $blocks)
            <section class="mb-16 scroll-mt-20" id="{{ \Illuminate\Support\Str::slug($label) }}">
                <div class="mb-5 flex items-baseline gap-3">
                    <h2 class="text-2xl font-semibold tracking-tight">{{ $label }}</h2>
                    <span class="text-muted-foreground text-sm">{{ $blocks->count() }} {{ \Illuminate\Support\Str::plural('block', $blocks->count()) }}</span>
                </div>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($blocks as $block)
                        <x-gallery-card kind="blocks" :slug="$block" :label="$block" />
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</x-layouts.app>
