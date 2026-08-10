// The demo renders charts, so it registers the opt-in chart engine alongside
// the core. A components-only app would simply `import './blatui.js'` (no
// charts → no ApexCharts).
import Alpine from 'alpinejs';
import { registerBlatUI } from './blatui-core.js';
import { registerCharts } from './blatui-charts.js';

// Docs-only: several examples show the real Livewire binding (`$wire.edit(row.id)`) and say
// in the same breath that the static preview has no Livewire runtime. Without this they do not
// go inert, they throw `$wire is not defined` into the console on every click — which reads as
// a broken component to anyone with devtools open. A no-op magic makes the preview behave the
// way the example already claims it does. Never shipped: the package publishes blatui.js.
document.addEventListener('alpine:init', () => {
    if (!window.Livewire) {
        Alpine.magic('wire', () => new Proxy(() => {}, { get: () => () => {}, apply: () => {} }));
    }
});

if (!window.Alpine) {
    // The demo is a dark-aware showcase, so it opts into following the OS preference.
    // (The package default is light-until-toggled — see blatui.js / registerBlatUI.)
    registerBlatUI(Alpine, { darkMode: 'system' });
    registerCharts(Alpine);
    window.Alpine = Alpine;
    Alpine.start();
}
