{{-- Trigger sizes via the `size` prop. --}}
<div class="flex flex-wrap items-center gap-3">
    @foreach (['sm' => 'Small', 'default' => 'Default', 'lg' => 'Large'] as $size => $label)
        <x-ui.select>
            <x-ui.select-trigger size="{{ $size }}" class="w-[150px]" aria-label="{{ $label }} size">
                <x-ui.select-value placeholder="{{ $label }}" />
            </x-ui.select-trigger>
            <x-ui.select-content>
                <x-ui.select-item value="apple">Apple</x-ui.select-item>
                <x-ui.select-item value="banana">Banana</x-ui.select-item>
                <x-ui.select-item value="cherry">Cherry</x-ui.select-item>
            </x-ui.select-content>
        </x-ui.select>
    @endforeach
</div>
