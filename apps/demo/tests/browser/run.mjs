// BlatUI browser acceptance run.
//
//   npm run test:browser                       # against a local `php artisan serve --port=8123`
//   npm run test:browser -- https://blatui.remix-it.com
//   npm run test:browser -- --suite=overlays --only=dialog
//
// Exits non-zero on the first failing check set, so CI can gate on it.
import { createReporter, launch, setOrigin } from './lib/harness.mjs';
import { discover } from './lib/inventory.mjs';
import * as pages from './suites/pages.mjs';
import * as overlays from './suites/overlays.mjs';
import * as controls from './suites/controls.mjs';
import * as sidebar from './suites/sidebar.mjs';
import * as buttons from './suites/buttons.mjs';

const SUITES = { pages, overlays, controls, buttons, sidebar };

const args = process.argv.slice(2);
const baseUrl = (args.find((a) => a.startsWith('http')) || 'http://127.0.0.1:8123').replace(/\/$/, '');
const flag = (name) => args.find((a) => a.startsWith(`--${name}=`))?.split('=')[1];
const wanted = flag('suite');
const only = flag('only');

setOrigin(baseUrl);
const inventory = await discover(baseUrl);

console.log(`BlatUI browser acceptance — ${baseUrl}`);
console.log(`${inventory.components.length} components, ${inventory.blocks.length} blocks, ${inventory.templates.length} templates\n`);

const browser = await launch();
const reporter = createReporter();

for (const [name, suite] of Object.entries(SUITES)) {
    if (wanted && name !== wanted) continue;
    await suite.run({ browser, reporter, baseUrl, inventory, only });
}

await browser.close();
process.exit(reporter.summary() ? 1 : 0);
