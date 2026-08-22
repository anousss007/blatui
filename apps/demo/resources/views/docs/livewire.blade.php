<x-layouts.app title="Using BlatUI with Livewire" description="BlatUI components are 100% Livewire-ready: wire:model works on every form control — inputs, selects, checkboxes, switches, sliders, date pickers, file uploads and more — with full two-way binding. A free, you-own-the-code alternative to Flux Pro.">
    <x-site.header active="docs" />

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center">
            <div class="from-primary/20 h-80 w-[760px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto max-w-3xl px-6 py-16 text-center lg:px-8">
            <span class="bg-primary/10 text-primary mb-4 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium">
                <x-lucide-zap class="size-3.5" /> Livewire
            </span>
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">Use BlatUI with Livewire</h1>
            <p class="text-muted-foreground mt-4 text-lg text-balance">
                Every {{ config('brand.name') }} form control is Livewire-ready. Bind <code>wire:model</code> to
                any of them — inputs, selects, checkboxes, switches, sliders, rich text, date &amp; file pickers —
                and get real two-way binding. No wrappers, no second library, and you still own every line.
            </p>
        </div>
    </section>

    <div class="mx-auto max-w-3xl px-6 py-14 lg:px-8">

        {{-- Nothing to install --}}
        <h2 id="setup" class="mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">Nothing extra to install</h2>
        <p class="text-muted-foreground mb-4">
            BlatUI components are plain Blade + Alpine, so they already render inside Livewire components.
            Install Livewire as usual, then use BlatUI tags in any Livewire view — the
            <code>wire:model</code> bridge activates automatically when Livewire is present and stays
            completely inert when it isn't (your non-Livewire pages are unaffected).
        </p>
        <x-code-block label="Terminal" icon="terminal">composer require livewire/livewire</x-code-block>

        {{-- wire:model --}}
        <h2 id="wire-model" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">Bind with <code>wire:model</code></h2>
        <p class="text-muted-foreground mb-4">
            Drop <code>wire:model</code> onto any form control exactly like a native input. Native fields
            (<code>input</code>, <code>textarea</code>, native <code>select</code>) bind directly; the rich
            Alpine widgets (custom <code>select</code>, combobox, switch, slider, rating, color/date/time
            pickers, tags, OTP, knob…) read and write <strong>your Livewire property itself</strong> — they
            keep no second copy of the value, so server and client cannot disagree.
        </p>
        <p class="text-muted-foreground mb-4">
            They deliberately do <em>not</em> use <code>@verbatim@entangle@endverbatim</code>, which Livewire 4
            deprecates: it duplicates the value, bakes the component id into an <code>x-data</code> that Alpine
            only ever evaluates once, and leaks its sync when the element is removed. The bound property path
            travels as a <code>data-blat-model</code> attribute instead, so a re-render that re-points or
            re-mounts the component is followed rather than missed.
        </p>

        <x-code-block label="app/Livewire/ProfileForm.php" icon="file-code">use Livewire\Component;

class ProfileForm extends Component
{
    public string $name = '';
    public string $plan = 'pro';
    public bool $notify = true;
    public array $tags = [];
    public int $volume = 30;

    public function render()
    {
        return view('livewire.profile-form');
    }
}</x-code-block>

        <x-code-block label="resources/views/livewire/profile-form.blade.php" icon="code">&lt;form wire:submit="save" class="space-y-4"&gt;
    &lt;x-ui.input wire:model="name" placeholder="Full name" /&gt;

    &lt;x-ui.select wire:model="plan" :options="['free' =&gt; 'Free', 'pro' =&gt; 'Pro']" /&gt;

    &lt;x-ui.switch wire:model="notify" /&gt;

    &lt;x-ui.tags-input wire:model="tags" /&gt;

    &lt;x-ui.slider wire:model="volume" /&gt;

    &lt;x-ui.button type="submit"&gt;Save&lt;/x-ui.button&gt;
&lt;/form&gt;</x-code-block>

        {{-- live & modifiers --}}
        <h2 id="modifiers" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">Live updates &amp; modifiers</h2>
        <p class="text-muted-foreground mb-4">
            All the usual <code>wire:model</code> modifiers work. By default binding is deferred (synced on
            the next request); add <code>.live</code> for real-time updates, or <code>.blur</code> /
            <code>.debounce</code> as needed.
        </p>
        <x-code-block label="Blade" icon="code">{{-- deferred (default) --}}
&lt;x-ui.input wire:model="search" /&gt;

{{-- update the server as the user types --}}
&lt;x-ui.input wire:model.live="search" /&gt;

{{-- debounce live updates --}}
&lt;x-ui.input wire:model.live.debounce.400ms="search" /&gt;</x-code-block>

        {{-- validation --}}
        <h2 id="validation" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">Validation</h2>
        <p class="text-muted-foreground mb-4">
            BlatUI fields already render <code>aria-invalid</code> styling. Pair Livewire's
            <code>@verbatim@error@endverbatim</code> with the <code>aria-invalid</code> attribute and the
            built-in field components to surface messages.
        </p>
        <x-code-block label="Blade" icon="code">&lt;x-ui.field&gt;
    &lt;x-ui.field-label for="email"&gt;Email&lt;/x-ui.field-label&gt;
    &lt;x-ui.input id="email" type="email" wire:model="email"
        aria-invalid="@verbatim{{ $errors->has('email') ? 'true' : 'false' }}@endverbatim" /&gt;
    @verbatim@error('email')@endverbatim
        &lt;x-ui.field-error&gt;@verbatim{{ $message }}@endverbatim&lt;/x-ui.field-error&gt;
    @verbatim@enderror@endverbatim
&lt;/x-ui.field&gt;</x-code-block>

        {{-- loading --}}
        <h2 id="loading" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">Loading states</h2>
        <p class="text-muted-foreground mb-4">
            Because the components are real DOM, Livewire's <code>wire:loading</code> and
            <code>wire:target</code> work directly on them.
        </p>
        <x-code-block label="Blade" icon="code">&lt;x-ui.button type="submit"&gt;
    &lt;span wire:loading.remove wire:target="save"&gt;Save&lt;/span&gt;
    &lt;span wire:loading wire:target="save" class="inline-flex items-center gap-2"&gt;
        &lt;x-ui.spinner class="size-4" /&gt; Saving…
    &lt;/span&gt;
&lt;/x-ui.button&gt;</x-code-block>

        {{-- file uploads --}}
        <h2 id="uploads" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">File uploads</h2>
        <p class="text-muted-foreground mb-4">
            The <code>file-upload</code> component forwards <code>wire:model</code> onto its real
            <code>&lt;input type="file"&gt;</code>, so Livewire's
            <a href="https://livewire.laravel.com/docs/uploads" target="_blank" rel="noopener" class="text-primary underline underline-offset-4">temporary file uploads</a>
            work out of the box (use the <code>WithFileUploads</code> trait). Dropped files go through the
            same input, so drag-and-drop uploads too.
        </p>
        <p class="text-muted-foreground mb-4">
            The per-file progress bar is Livewire's own upload progress — it appears only when there is an
            upload behind it, tracks the bytes actually sent, and turns into an error message if the upload
            fails. Without a <code>wire:model</code> the component is a plain file field: it lists what you
            picked and draws no bar, because nothing is being uploaded. Removing a row withdraws the
            temporary upload server-side, not just the row.
        </p>
        <x-code-block label="Blade" icon="code">&lt;x-ui.file-upload wire:model="avatar" accept="image/*" /&gt;</x-code-block>

        {{-- supported --}}
        <h2 id="supported" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">What's bindable</h2>
        <p class="text-muted-foreground mb-4">
            <code>wire:model</code> is supported on every value-bearing component:
        </p>
        <div class="text-muted-foreground mb-4 grid grid-cols-2 gap-x-6 gap-y-1 text-sm sm:grid-cols-3">
            @foreach (['input', 'textarea', 'select', 'combobox', 'autocomplete', 'checkbox', 'radio-group', 'switch', 'toggle', 'toggle-group', 'segmented-control', 'slider', 'rating', 'knob', 'number-input', 'color-picker', 'date-picker', 'datetime-picker', 'time-field', 'input-otp', 'tags-input', 'phone-input', 'input-mask', 'editable', 'mention-input', 'markdown-editor', 'rich-text-editor', 'signature-pad', 'file-upload'] as $c)
                <span class="flex items-center gap-1.5"><x-lucide-check class="text-primary size-3.5 shrink-0" /> {{ $c }}</span>
            @endforeach
        </div>
        <p class="text-muted-foreground mb-4 text-sm">
            Range modes bind too, to the same shape the component's <code>value</code> prop already takes —
            so <code>:value="$x" wire:model="x"</code> round-trips:
        </p>
        <x-code-block label="Blade" icon="code">{{-- ['from' =&gt; 'Y-m-d', 'to' =&gt; 'Y-m-d'] --}}
&lt;x-ui.date-picker mode="range" wire:model="stay" :value="$stay" /&gt;

{{-- ['from' =&gt; 'Y-m-d\TH:i', 'to' =&gt; 'Y-m-d\TH:i'] --}}
&lt;x-ui.datetime-picker mode="range" wire:model="slot" :value="$slot" /&gt;

{{-- [low, high] --}}
&lt;x-ui.slider range wire:model="price" :value="$price" /&gt;</x-code-block>
        <p class="text-muted-foreground mb-4 text-sm">
            A range reports what the user has actually picked, so an in-progress one arrives with
            <code>to</code> still null — check it before filtering on the pair. The
            <code>name[...]</code> form fields keep working alongside, unchanged. Dragging a
            <code>.live</code> slider sends one request when the drag ends, not one per pointer move.
        </p>

        {{-- positioning --}}
        <h2 id="vs-flux" class="mt-16 mb-2 scroll-mt-20 text-2xl font-bold tracking-tight">BlatUI vs. Flux Pro</h2>
        <p class="text-muted-foreground mb-4">
            BlatUI ships everything Flux Pro charges for — calendar, charts, command palette, date &amp; time
            pickers, editor, listbox/combobox, file upload, kanban and more — plus 60+ extra components,
            blocks and charts. The difference: BlatUI is <strong>MIT-licensed and free</strong>, and the
            components are <strong>copied into your project</strong>, so you own and can edit every line.
        </p>
        <div class="not-prose grid gap-3 sm:grid-cols-3">
            @foreach ([['153 components', 'you own the code'], ['Free · MIT', 'no per-project license'], ['Livewire + Blade', 'works with or without Livewire']] as [$t, $d])
                <div class="bg-card rounded-xl border p-4">
                    <div class="font-semibold">{{ $t }}</div>
                    <p class="text-muted-foreground mt-0.5 text-sm">{{ $d }}</p>
                </div>
            @endforeach
        </div>

        {{-- next --}}
        <div class="mt-16 flex flex-wrap gap-3">
            <a href="/docs" class="bg-primary text-primary-foreground inline-flex items-center gap-1.5 rounded-md px-4 py-2 text-sm font-semibold">
                <x-lucide-rocket class="size-4" /> Get started
            </a>
            <a href="/components" class="inline-flex items-center gap-1.5 rounded-md border px-4 py-2 text-sm font-medium">
                Browse components <x-lucide-arrow-right class="size-4" />
            </a>
        </div>
    </div>

    <footer class="text-muted-foreground border-t py-8 text-center text-sm">
        Built with Laravel, Blade, Alpine &amp; Tailwind v4. Inspired by shadcn/ui.
    </footer>
</x-layouts.app>
