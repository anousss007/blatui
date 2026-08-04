// Browser acceptance run for the calendar event contract (1.20).
//
// The unit tests in ../js cover the engine's logic; these cover what only a real browser can
// answer — that a seeded popover STAYS open, that a range picked by clicking closes it exactly
// once, that a window-level seed reaches one instance out of several, that the theme survives a
// token-only re-skin, and that RTL navigation follows the rendered direction. The RTL arrow bug
// fixed in 1.20 was invisible to every other layer of the test suite.
//
// It drives /components/calendar and /components/date-picker, which render every example
// inline (no iframes) and therefore give us a page with a dozen live calendars on it.
//
// Not wired into CI on purpose: it needs a served demo plus a ~115 MB browser download. Run it
// by hand before releasing anything that touches the calendar, locally or against production.
//
//   npm i -D playwright && npx playwright install chromium   # once
//   npm run build && php artisan serve --port=8123           # or point it at the live site
//   npm run test:browser
//   npm run test:browser -- https://blatui.remix-it.com
//
// Screenshots of the re-skin and the RTL popover land in ./shots (gitignored) for eyeballing.
import { mkdirSync } from 'node:fs';

// Imported dynamically so the missing-dependency case is one readable line instead of a
// module-resolution stack trace — playwright is deliberately NOT a devDependency here (its
// postinstall would drag a browser download into every `npm install` in the demo).
const { chromium } = await import('playwright').catch(() => {
    console.error('playwright is not installed. Run:\n  npm i -D playwright && npx playwright install chromium');
    process.exit(2);
});

const BASE = process.argv[2] || 'http://127.0.0.1:8123';
const SHOTS = new URL('./shots/', import.meta.url).pathname;
mkdirSync(SHOTS, { recursive: true });

const results = [];
const check = (name, ok, info = '') => {
    results.push({ name, ok, info });
    console.log(`${ok ? 'PASS' : 'FAIL'}  ${name}${info ? `\n        ${info}` : ''}`);
};

/** Record every calendar event that reaches window, with the emitting instance. */
const INSTRUMENT = () => {
    window.__ev = [];
    const push = (name) => (e) => window.__ev.push({
        name,
        detail: JSON.parse(JSON.stringify(e.detail ?? null)),
        from: e.target?.dataset?.calendarId ?? null,
    });
    window.addEventListener('calendar-change', push('calendar-change'));
    window.addEventListener('calendar:updated', push('calendar:updated'));
};

const ymd = (d) => d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
const plus = (n) => { const d = new Date(); d.setDate(d.getDate() + n); return ymd(d); };

const browser = await chromium.launch();
const page = await browser.newPage({ viewport: { width: 1280, height: 1000 } });
await page.addInitScript(INSTRUMENT);
page.on('pageerror', (e) => check('no page errors', false, String(e)));

// ---------------------------------------------------------------------------
// /components/calendar — the controlled example is the search-bar pattern
// ---------------------------------------------------------------------------
await page.goto(`${BASE}/components/calendar`, { waitUntil: 'networkidle' });

const stay = page.locator('[data-calendar-id="stay"]');
const popover = stay.locator('xpath=..');
const checkIn = page.getByRole('button', { name: /Check in/ });

// D1 — a popover whose calendar is seeded with a COMPLETE range must stay open.
await page.evaluate(() => { window.__ev.length = 0; });
await checkIn.click();
// Wait for the open transition to settle before judging — the failure mode we are testing is
// "it opens, then closes on its own", so the assertion that matters is the one AFTER the delay.
await popover.waitFor({ state: 'visible', timeout: 3000 }).catch(() => {});
const openedAt = await popover.isVisible();
await page.waitForTimeout(500); // the prod bug closed it on the same tick as the opening click
const stillOpen = await popover.isVisible();
const seededValue = await stay.evaluate((el) => Alpine.$data(el).value);
check(
    'D1 · a popover seeded with a complete range stays open',
    openedAt && stillOpen && !!seededValue.from && !!seededValue.to,
    `opened=${openedAt} stillOpen=${stillOpen} seeded=${JSON.stringify(seededValue)}`,
);

// D4 — no calendar-change is emitted while merely opening/seeding.
const evOnOpen = await page.evaluate(() => window.__ev.map((e) => e.name));
check(
    'D4 · opening + seeding emits no calendar-change (no syncing flag needed)',
    !evOnOpen.includes('calendar-change'),
    `events on open: ${JSON.stringify(evOnOpen)}`,
);

// A quick-pick seeds through calendar:set-range — the popover must survive it.
await page.evaluate(() => { window.__ev.length = 0; });
await page.getByRole('button', { name: 'This weekend' }).click();
await page.waitForTimeout(250);
const afterPreset = await page.evaluate(() => window.__ev.map((e) => `${e.name}:${e.detail?.source ?? ''}`));
check(
    'D1 · a quick-pick (calendar:set-range) keeps the popover open',
    (await popover.isVisible()) && !afterPreset.some((e) => e.startsWith('calendar-change')),
    `open=${await popover.isVisible()} events=${JSON.stringify(afterPreset)}`,
);

// D2 — a real two-click range emits calendar-change once per click, then closes.
await page.evaluate(() => { window.__ev.length = 0; });
const a = plus(20), b = plus(24);
await stay.locator(`[data-day="${a}"]:not([data-outside])`).first().click();
const openAfterFirst = await popover.isVisible();
await stay.locator(`[data-day="${b}"]:not([data-outside])`).first().click();
await page.waitForTimeout(400);
const picks = await page.evaluate(() => window.__ev.filter((e) => e.name === 'calendar-change').map((e) => e.detail));
check(
    'D2 · a complete range emits calendar-change once per click, then the popover closes',
    picks.length === 2 && picks[1].from === a && picks[1].to === b && openAfterFirst && !(await popover.isVisible()),
    `openAfterFirstClick=${openAfterFirst} picks=${JSON.stringify(picks)} closed=${!(await popover.isVisible())}`,
);

// D3 — seeding one range instance must not touch the other range calendar on the page.
const otherRange = page.locator('[data-slot="calendar"]').filter({ has: page.locator('[data-day="2025-06-09"][data-range-start]') });
const beforeOther = await otherRange.first().evaluate((el) => Alpine.$data(el).value);
await page.evaluate(() => {
    window.__ev.length = 0;
    window.dispatchEvent(new CustomEvent('calendar:set-range', { detail: { id: 'stay', from: '2026-11-02', to: '2026-11-06' } }));
});
await page.waitForTimeout(250);
const afterOther = await otherRange.first().evaluate((el) => Alpine.$data(el).value);
const afterStay = await stay.evaluate((el) => Alpine.$data(el).value);
check(
    'D3 · a targeted window seed reaches one instance only',
    afterStay.from === '2026-11-02' && afterStay.to === '2026-11-06' && JSON.stringify(beforeOther) === JSON.stringify(afterOther),
    `stay=${JSON.stringify(afterStay)} other: ${JSON.stringify(beforeOther)} -> ${JSON.stringify(afterOther)}`,
);

// Mode guard — a single-mode seed must not drag a range calendar's view.
const viewBefore = await stay.evaluate((el) => Alpine.$data(el).view.getFullYear());
await page.evaluate(() => window.dispatchEvent(new CustomEvent('calendar:set', { detail: '1991-03-04' })));
await page.waitForTimeout(200);
const viewAfter = await stay.evaluate((el) => Alpine.$data(el).view.getFullYear());
check(
    'C2 · a single-mode calendar:set leaves range calendars (and their view) alone',
    viewBefore === viewAfter && viewAfter !== 1991,
    `view year ${viewBefore} -> ${viewAfter}`,
);

// D5 — luxury re-skin: override the 7 tokens on the wrapper, nothing may break.
await checkIn.click();
await page.waitForTimeout(200);
await popover.evaluate((el) => {
    el.style.setProperty('--background', 'oklch(0.18 0.02 60)');
    el.style.setProperty('--popover', 'oklch(0.18 0.02 60)');
    el.style.setProperty('--foreground', 'oklch(0.95 0.02 80)');
    el.style.setProperty('--primary', 'oklch(0.78 0.14 75)');
    el.style.setProperty('--accent', 'oklch(0.28 0.04 70)');
    el.style.setProperty('--muted-foreground', 'oklch(0.72 0.03 80)');
    el.style.setProperty('--border', 'oklch(0.34 0.03 70)');
});
await page.waitForTimeout(200);
const skin = await popover.evaluate((el) => {
    const cal = el.querySelector('[data-slot=calendar]');
    const day = el.querySelector('[data-range-start]') || el.querySelector('[data-day]');
    const box = cal.getBoundingClientRect();
    return {
        calBg: getComputedStyle(cal).backgroundColor,
        dayBg: getComputedStyle(day).backgroundColor,
        width: Math.round(box.width),
        height: Math.round(box.height),
        cells: el.querySelectorAll('[data-day]').length,
    };
});
await page.screenshot({ path: `${SHOTS}luxury-dark.png`, clip: await popover.boundingBox() });
check(
    'D5 · the dark re-skin lands through the 7 tokens with no layout break',
    skin.calBg !== 'rgb(255, 255, 255)' && skin.width > 400 && skin.height > 200 && skin.cells >= 84,
    `calBg=${skin.calBg} dayBg=${skin.dayBg} ${skin.width}x${skin.height} cells=${skin.cells}`,
);
await page.keyboard.press('Escape');

// ---------------------------------------------------------------------------
// date-picker — the preset path that used to need _keepOpen
// ---------------------------------------------------------------------------
await page.goto(`${BASE}/components/date-picker`, { waitUntil: 'networkidle' });
await page.locator('[data-slot="date-picker"]').filter({ hasText: 'Pick a date range' }).first().getByRole('button').first().click();
await page.waitForTimeout(300);
const dialog = page.getByRole('dialog').filter({ has: page.getByRole('group', { name: 'Presets' }) }).first();
const dpOpen1 = await dialog.isVisible();
await dialog.getByRole('button', { name: 'Last 7 days', exact: true }).click();
await page.waitForTimeout(400);
const dpOpen2 = await dialog.isVisible();
// Read the picker that actually OWNS this popover through the teleport back-reference. A text
// locator would be re-resolved after the label changes and silently land on another picker.
const dpOwner = await dialog.evaluate((el) => {
    const owner = el._x_teleportBack.closest('[data-slot="date-picker"]');
    const d = Alpine.$data(owner);
    return { from: d.from, to: d.to, trigger: owner.querySelector('button span').textContent.trim() };
});
check(
    'C1 · date-picker: a preset applies without closing the popover (_keepOpen removed)',
    dpOpen1 && dpOpen2 && !!dpOwner.from && !!dpOwner.to && !/Pick a date range/.test(dpOwner.trigger),
    `openBefore=${dpOpen1} openAfter=${dpOpen2} owner=${JSON.stringify(dpOwner)}`,
);

// ---------------------------------------------------------------------------
// D6 — RTL: anchoring + keyboard
// ---------------------------------------------------------------------------
await page.goto(`${BASE}/components/calendar`, { waitUntil: 'networkidle' });
await page.evaluate(() => { document.documentElement.dir = 'rtl'; document.documentElement.lang = 'ar'; });
await page.waitForTimeout(300);
await checkIn.click();
await page.waitForTimeout(300);

const rtlBox = await popover.boundingBox();
const vw = page.viewportSize().width;
check(
    'D6 · RTL: the popover stays inside the viewport',
    rtlBox.x >= -1 && rtlBox.x + rtlBox.width <= vw + 1,
    `popover x=${Math.round(rtlBox.x)} w=${Math.round(rtlBox.width)} viewport=${vw}`,
);

// Enter the grid the way a keyboard user does: Tab lands on the roving cell (tabindex=0),
// which is the one the component considers focused. Focusing an arbitrary cell from the test
// would desync DOM focus from the component's anchor and prove nothing.
const roving = stay.locator('[data-day][tabindex="0"]').first();
await roving.focus();
const anchor = await roving.getAttribute('data-day');
const dayAfter = await page.evaluate((d) => {
    const x = new Date(d + 'T00:00:00'); x.setDate(x.getDate() + 1);
    return x.getFullYear() + '-' + String(x.getMonth() + 1).padStart(2, '0') + '-' + String(x.getDate()).padStart(2, '0');
}, anchor);

// Arrow keys are visual in the APG grid pattern: RTL mirrors the grid, so the day to the
// LEFT of the anchor is the NEXT day, and ArrowLeft must go there.
const geom = await stay.evaluate((el, d) => {
    const q = (x) => el.querySelector(`[data-day="${x}"]:not([data-outside])`)?.getBoundingClientRect().x ?? null;
    return { self: q(d.self), next: q(d.next) };
}, { self: anchor, next: dayAfter });
const mirrored = geom.next !== null && geom.self !== null && geom.next < geom.self;

await page.keyboard.press('ArrowLeft');
await page.waitForTimeout(200);
const afterLeft = await page.evaluate(() => document.activeElement?.dataset?.day ?? null);
check(
    'D6 · RTL: ArrowLeft moves focus to the visually-left day',
    mirrored && afterLeft === dayAfter,
    `grid mirrored=${mirrored} · anchor=${anchor} · ArrowLeft focused ${afterLeft}, expected ${dayAfter}`,
);

await roving.focus();
await page.keyboard.press('End');
await page.waitForTimeout(200);
const afterEnd = await page.evaluate(() => document.activeElement?.dataset?.day ?? null);
const endExpected = await page.evaluate((d) => {
    // week-start=monday in this example: End is the last day of the week (Sunday) — a logical
    // position, so it must NOT flip with the direction.
    const x = new Date(d + 'T00:00:00');
    const offset = (x.getDay() - 1 + 7) % 7;
    x.setDate(x.getDate() + (6 - offset));
    return x.getFullYear() + '-' + String(x.getMonth() + 1).padStart(2, '0') + '-' + String(x.getDate()).padStart(2, '0');
}, anchor);
check(
    'D6 · RTL: End goes to the last day of the week (logical, unaffected by direction)',
    afterEnd === endExpected,
    `anchor=${anchor} · End focused ${afterEnd}, expected ${endExpected}`,
);

await page.screenshot({ path: `${SHOTS}rtl-popover.png`, clip: await popover.boundingBox() });

await browser.close();

const failed = results.filter((r) => !r.ok);
console.log(`\n${results.length - failed.length}/${results.length} checks passed`);
process.exit(failed.length ? 1 : 0);
