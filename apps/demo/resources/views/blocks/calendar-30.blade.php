<x-layouts.app title="Calendar 30">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div class="flex flex-col gap-3"
            x-data="{
                from: '2025-06-04',
                to: '2025-06-10',
                fmt(s) {
                    if (!s) return null;
                    const p = String(s).split('-').map(Number);
                    return new Date(p[0], p[1] - 1, p[2]);
                },
                get label() {
                    const f = this.fmt(this.from), t = this.fmt(this.to);
                    if (!f || !t) return 'Select date';
                    const mo = (d) => d.toLocaleString('en-US', { month: 'short' });
                    const sameYear = f.getFullYear() === t.getFullYear();
                    const sameMonth = sameYear && f.getMonth() === t.getMonth();
                    if (sameMonth) {
                        return `${mo(f)} ${f.getDate()} - ${t.getDate()}`;
                    }
                    if (sameYear) {
                        return `${mo(f)} ${f.getDate()} - ${mo(t)} ${t.getDate()}`;
                    }
                    return `${mo(f)} ${f.getDate()}, ${f.getFullYear()} - ${mo(t)} ${t.getDate()}, ${t.getFullYear()}`;
                },
            }"
            @calendar-change="from = $event.detail.from; to = $event.detail.to">
            <x-ui.label for="dates" class="px-1">Select your stay</x-ui.label>
            <x-ui.popover>
                <x-ui.popover-trigger>
                    <x-ui.button variant="outline" id="dates" class="w-56 justify-between font-normal">
                        <span x-text="label"></span>
                        <x-lucide-chevron-down />
                    </x-ui.button>
                </x-ui.popover-trigger>
                <x-ui.popover-content align="start" class="w-auto overflow-hidden p-0">
                    <x-ui.calendar mode="range" :value="['from' => '2025-06-04', 'to' => '2025-06-10']"
                        default-month="2025-06-04" caption-layout="dropdown" />
                </x-ui.popover-content>
            </x-ui.popover>
        </div>
    </div>
</x-layouts.app>
