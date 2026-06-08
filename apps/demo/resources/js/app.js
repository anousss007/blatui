// The demo renders charts, so it registers the opt-in chart engine alongside
// the core. A components-only app would simply `import './blatui.js'` (no
// charts → no ApexCharts).
import Alpine from 'alpinejs';
import { registerBlatUI } from './blatui-core.js';
import { registerCharts } from './blatui-charts.js';

if (!window.Alpine) {
    registerBlatUI(Alpine);
    registerCharts(Alpine);
    window.Alpine = Alpine;
    Alpine.start();
}
