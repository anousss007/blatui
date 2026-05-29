<x-layouts.app title="Calendar 29">
    <div class="flex min-h-svh items-center justify-center p-6">
        <div
            class="flex flex-col gap-3"
            x-data="{
                value: 'In 2 days',
                date: null,
                month: null,
                /* Lightweight chrono-node approximation: handles today/tomorrow/
                   yesterday, 'in N days/weeks', 'next <weekday>', else Date.parse. */
                parse(text) {
                    if (!text) return null;
                    const s = text.trim().toLowerCase();
                    const now = new Date();
                    now.setHours(0, 0, 0, 0);
                    const addDays = (n) => { const d = new Date(now); d.setDate(d.getDate() + n); return d; };
                    if (s === 'today') return now;
                    if (s === 'tomorrow') return addDays(1);
                    if (s === 'yesterday') return addDays(-1);
                    let m = s.match(/^in\s+(\d+)\s+(day|days|week|weeks)$/);
                    if (m) return addDays(parseInt(m[1]) * (m[2].startsWith('week') ? 7 : 1));
                    const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    m = s.match(/^next\s+(\w+)$/);
                    if (m) {
                        const idx = days.indexOf(m[1]);
                        if (idx >= 0) {
                            let diff = (idx - now.getDay() + 7) % 7;
                            if (diff === 0) diff = 7;
                            return addDays(diff);
                        }
                    }
                    const t = new Date(text);
                    return isNaN(t.getTime()) ? null : t;
                },
                ymd(d) {
                    if (!d) return null;
                    return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
                },
                formatDate(d) {
                    if (!d) return '';
                    return d.toLocaleDateString('en-US', { day: '2-digit', month: 'long', year: 'numeric' });
                },
                /* Push the parsed date into the (separately-mounted) calendar
                   component so it selects the day and scrolls to its month. */
                syncCalendar() {
                    if (!this.$refs.cal || !window.Alpine) return;
                    const cal = window.Alpine.$data(this.$refs.cal);
                    if (!cal) return;
                    if (this.month) cal.view = new Date(this.month.getFullYear(), this.month.getMonth(), 1);
                    cal.single = this.date ? new Date(this.date) : null;
                },
                onInput(v) {
                    this.value = v;
                    const d = this.parse(v);
                    if (d) { this.date = d; this.month = d; this.syncCalendar(); }
                },
                init() {
                    const d = this.parse(this.value);
                    if (d) { this.date = d; this.month = d; }
                    this.$nextTick(() => this.syncCalendar());
                },
            }"
        >
            <x-ui.label for="date" class="px-1">Schedule Date</x-ui.label>
            <div class="relative flex gap-2">
                <x-ui.input
                    id="date"
                    placeholder="Tomorrow or next week"
                    class="bg-background pr-10"
                    x-model="value"
                    @input="onInput($event.target.value)"
                    @keydown.arrow-down.prevent="open = true"
                />
                <x-ui.popover
                    class="absolute top-1/2 right-2 size-6 -translate-y-1/2"
                    @calendar-change="date = $event.detail ? new Date($event.detail + 'T00:00:00') : null; value = formatDate(date); open = false"
                >
                    <x-ui.popover-trigger>
                        <x-ui.button id="date-picker" variant="ghost" class="size-6">
                            <x-lucide-calendar class="size-3.5" />
                            <span class="sr-only">Select date</span>
                        </x-ui.button>
                    </x-ui.popover-trigger>
                    <x-ui.popover-content align="end" class="w-auto overflow-hidden p-0" x-effect="open && (syncCalendar())">
                        <x-ui.calendar
                            x-ref="cal"
                            mode="single"
                            value="2025-05-31"
                            caption-layout="dropdown"
                            class="border-0"
                        />
                    </x-ui.popover-content>
                </x-ui.popover>
            </div>
            <div class="text-muted-foreground px-1 text-sm">
                Your post will be published on <span class="font-medium" x-text="formatDate(date)"></span>.
            </div>
        </div>
    </div>
</x-layouts.app>
