// Opt into the chart engine.
//
// blatui.js deliberately leaves charts out — ApexCharts is ~140kb gzipped and most apps have no
// charts — so importing it is how a page that does gets them. This module does two things the
// dashboard needs: importing blatui-charts.js defines `window.Chart` (the helpers the dashboard's
// inline area chart calls directly), and registering on alpine:init defines the `shadcnChart`
// component that <x-ui.chart> uses.
//
// It has to be imported BEFORE blatui.js. Sibling imports evaluate top to bottom, and blatui.js
// starts Alpine as it evaluates — Alpine then walks the DOM immediately, so anything the page's
// own x-data needs on window has to be there already. Import it after and the dashboard throws
// "Cannot read properties of undefined (reading 'load')" before this file has run.
import { registerCharts } from './blatui-charts.js';

document.addEventListener('alpine:init', () => registerCharts(window.Alpine));
