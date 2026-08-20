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

// Register onto whichever Alpine actually ends up running the page — which is not always ours.
//
// Livewire ships its own Alpine and starts it, and it loads as a classic <script> that runs
// during parse, while this file is a module and runs after. So in a Livewire app `window.Alpine`
// is already set by the time we get here. Guarding registration on that (`if (!window.Alpine)`)
// therefore skipped it altogether: Alpine ran, Livewire ran, and every BlatUI directive, magic
// and store was simply missing — `blatMenu is not defined`, no `x-blat-field`, no theme store.
//
// `alpine:init` is dispatched by whoever owns Alpine immediately before it starts, and it is the
// one moment when plugins and directives can still be added. So that is what registers us, in
// both cases, rather than the guard.
document.addEventListener('alpine:init', () => registerBlatUI(window.Alpine));

// Nobody else brought an Alpine, so bring ours. start() dispatches alpine:init, which means the
// listener above still does the registering — one path through this file, not two.
if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
