{{--
    docs/api — renders the "API Reference" for a component docs page from a
    per-family metadata file at resources/docs-api/<slug>.php.

    The metadata file returns an array. All keys are optional except `props`:

      return [
          'props' => [
              ['name' => 'variant', 'type' => 'string', 'default' => "'default'",
               'options' => ['default', 'destructive', 'outline'],
               'description' => 'Visual style of the button.'],
              ['name' => 'steps', 'type' => 'array', 'default' => '[]', 'required' => true,
               'description' => 'The ordered tour steps.', 'shape' => 'step'],
          ],
          // Nested array/object shapes referenced by a prop's `shape` key.
          'shapes' => [
              'step' => [
                  'label' => 'Each step',
                  'fields' => [
                      ['name' => 'target', 'type' => 'string', 'description' => 'CSS selector…'],
                      ['name' => 'placement', 'type' => 'string', 'default' => "'bottom'",
                       'options' => ['bottom', 'top', 'left', 'right'], 'description' => 'Card side.'],
                  ],
              ],
          ],
          'slots' => [
              ['name' => 'default', 'description' => 'Trigger UI that shares the component scope.'],
          ],
          // Alpine scope methods the markup in your slot can call (e.g. @click="start()").
          'methods' => [
              ['name' => 'start()', 'description' => 'Opens the tour at the first step.'],
          ],
      ];

    Conventions: `default` is the literal default as written in code (string). Omit it
    (or use null) for required props with no default — the table shows an em dash.
    Descriptions are plain text (escaped). Allowed values go in `options`, not prose.
--}}
@props(['slug'])

@php
    $file = resource_path('docs-api/'.$slug.'.php');
    $api = is_file($file) ? require $file : null;

    $props = $api['props'] ?? [];
    $shapes = $api['shapes'] ?? [];
    $slots = $api['slots'] ?? [];
    $methods = $api['methods'] ?? [];

    // Only show shapes that are actually referenced by a documented prop.
    $usedShapes = collect($props)->pluck('shape')->filter()->unique()->all();

    $hasRequired = collect($props)->contains(fn ($p) => $p['required'] ?? false);
@endphp

@if ($props || $slots || $methods)
    <section id="api" class="mt-16 scroll-mt-20">
        <h2 class="text-2xl font-bold tracking-tight">API Reference</h2>
        <p class="text-muted-foreground mt-1 text-sm">
            Props, slots and exposed methods for
            <code class="bg-muted rounded px-1 py-0.5 font-mono text-[0.85em]">&lt;x-ui.{{ $slug }}&gt;</code>.
        </p>

        @if ($props)
            <h3 class="mt-8 mb-3 text-lg font-semibold tracking-tight">Props</h3>
            <x-docs.api-table :rows="$props" :shapes="$shapes" />
            @if ($hasRequired)
                <p class="text-muted-foreground mt-2 text-xs"><span class="text-destructive">*</span> Required.</p>
            @endif
        @endif

        @foreach ($shapes as $key => $shape)
            @continue (! in_array($key, $usedShapes, true))
            <h3 id="shape-{{ $key }}" class="mt-8 mb-3 scroll-mt-20 text-lg font-semibold tracking-tight">
                {{ $shape['label'] ?? \Illuminate\Support\Str::headline($key) }}
            </h3>
            <x-docs.api-table :rows="$shape['fields'] ?? []" :shapes="$shapes" />
        @endforeach

        @if ($slots)
            <h3 class="mt-8 mb-3 text-lg font-semibold tracking-tight">Slots</h3>
            <div class="overflow-x-auto rounded-lg border">
                <table class="w-full min-w-[28rem] text-left text-sm">
                    <thead class="bg-muted/50 text-muted-foreground">
                        <tr class="[&>th]:px-4 [&>th]:py-2.5 [&>th]:font-medium">
                            <th class="w-40">Slot</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody class="[&>tr]:border-t [&>tr>td]:px-4 [&>tr>td]:py-3 [&>tr>td]:align-top">
                        @foreach ($slots as $slot)
                            <tr>
                                <td><code class="text-foreground font-mono text-xs font-medium">{{ $slot['name'] ?? 'default' }}</code></td>
                                <td class="text-muted-foreground">{{ $slot['description'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($methods)
            <h3 class="mt-8 mb-3 text-lg font-semibold tracking-tight">Methods</h3>
            <p class="text-muted-foreground mb-3 text-sm">
                Available on the component's Alpine scope — call them from markup in the slot
                (e.g. <code class="bg-muted rounded px-1 py-0.5 font-mono text-[0.85em]">@click="…"</code>).
            </p>
            <div class="overflow-x-auto rounded-lg border">
                <table class="w-full min-w-[28rem] text-left text-sm">
                    <thead class="bg-muted/50 text-muted-foreground">
                        <tr class="[&>th]:px-4 [&>th]:py-2.5 [&>th]:font-medium">
                            <th class="w-48">Method</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody class="[&>tr]:border-t [&>tr>td]:px-4 [&>tr>td]:py-3 [&>tr>td]:align-top">
                        @foreach ($methods as $method)
                            <tr>
                                <td><code class="text-foreground font-mono text-xs font-medium">{{ $method['name'] ?? '' }}</code></td>
                                <td class="text-muted-foreground">{{ $method['description'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endif
