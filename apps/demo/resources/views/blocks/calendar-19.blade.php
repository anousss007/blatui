<x-layouts.app title="Calendar 19">
    <div class="flex min-h-svh items-center justify-center p-6">
        <x-ui.card class="max-w-[300px] py-4">
            <x-ui.card-content class="px-4">
                <x-ui.calendar mode="single" value="2025-06-12" default-month="2025-06-12" class="bg-transparent p-0 [--cell-size:2.375rem]" />
            </x-ui.card-content>
            <x-ui.card-footer class="flex flex-wrap gap-2 border-t px-4 pb-0 pt-4">
                @php
                    $presets = [
                        ['label' => 'Today', 'value' => 0],
                        ['label' => 'Tomorrow', 'value' => 1],
                        ['label' => 'In 3 days', 'value' => 3],
                        ['label' => 'In a week', 'value' => 7],
                        ['label' => 'In 2 weeks', 'value' => 14],
                    ];
                @endphp
                @foreach ($presets as $preset)
                    <x-ui.button variant="outline" size="sm" class="flex-1"
                        onclick="(function(){var d=new Date();d.setDate(d.getDate()+{{ $preset['value'] }});var v=d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0');window.dispatchEvent(new CustomEvent('calendar:set',{detail:v}));})()">
                        {{ $preset['label'] }}
                    </x-ui.button>
                @endforeach
            </x-ui.card-footer>
        </x-ui.card>
    </div>
</x-layouts.app>
