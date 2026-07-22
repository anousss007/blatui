// Greenfield bootstrap: wire BlatUI into a fresh Alpine instance and start it.
// This is the published foundation — components only, NO charts (so apps that
// don't use charts never pull in ApexCharts).
//
// If your app already runs its own Alpine, don't import this — instead:
//   import { registerBlatUI } from './blatui-core.js';
//   registerBlatUI(Alpine);            // before your Alpine.start()
//
// Dark mode is OFF by default (light until an explicit toggle) — a light-only app will
// NOT flip to dark on a dark OS. To follow the OS preference, or to hard-disable dark:
//   registerBlatUI(Alpine, { darkMode: 'system' });   // follow prefers-color-scheme
//   registerBlatUI(Alpine, { darkMode: false });      // light-only
//
// To add charts (after `php artisan blatui:add chart` + `npm i -D apexcharts`):
//   import { registerCharts } from './blatui-charts.js';
//   registerCharts(Alpine);            // alongside registerBlatUI, before start
import Alpine from 'alpinejs';
import { registerBlatUI } from './blatui-core.js';

if (!window.Alpine) {
    registerBlatUI(Alpine);
    window.Alpine = Alpine;
    Alpine.start();
}
