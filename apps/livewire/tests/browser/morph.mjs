// Wiring that has to survive a real Livewire re-render.
//
//   npm run test:browser                     # against a local `php artisan serve --port=8124`
//   npm run test:browser -- http://host:port
//
// Every check here asserts COMPUTED state after a real server round-trip. That is the whole
// point of the app this runs against: apps/demo has no Livewire runtime, so nothing there ever
// morphs, and this entire class of bug — wiring derived from the DOM once at init, then either
// never re-derived or actively stripped by the morph — was invisible to every existing layer.
// Issues #5, #18 and #19 all landed here.
import { createReporter, expect, launch, newPage, setOrigin, visit } from '../../../demo/tests/browser/lib/harness.mjs';

const args = process.argv.slice(2);
const baseUrl = (args.find((a) => a.startsWith('http')) || 'http://127.0.0.1:8124').replace(/\/$/, '');

setOrigin(baseUrl);

/** Read a field's wiring the way an assistive technology would resolve it. */
const readField = (page, testid) =>
    page.$eval(`[data-testid=${testid}]`, (el) => {
        const control = el.querySelector('input, textarea, select, [role="combobox"]');
        const describedby = (control?.getAttribute('aria-describedby') || '').split(/\s+/).filter(Boolean);
        const label = el.querySelector('label');

        return {
            invalid: el.getAttribute('data-invalid'),
            ariaInvalid: control?.getAttribute('aria-invalid') ?? null,
            // Resolved, not just present: an idref pointing at nothing is worse than no idref,
            // and a stale one is exactly what a morph leaves behind.
            describedby: describedby.map((id) => document.getElementById(id)?.getAttribute('data-slot') ?? `DANGLING:${id}`),
            labelTargetsControl: !!label && !!control && label.getAttribute('for') === control.id && !!control.id,
            hasError: !!el.querySelector('[data-slot="field-error"]'),
        };
    });

/**
 * Nothing is still mutating the subtree.
 *
 * keepWired() re-runs on the mutations its own writes produce, so a sync that is not idempotent
 * would spin forever — quietly, at 100% CPU, with correct-looking attributes. This is the check
 * that would catch that, and it is the reason the writes go through setAttr().
 */
const settles = async (page, selector, ms = 1200) => {
    await page.$eval(selector, (el) => {
        window.__churn = 0;
        new MutationObserver((records) => (window.__churn += records.length)).observe(el, {
            childList: true,
            subtree: true,
            attributes: true,
        });
    });
    await page.waitForTimeout(ms);

    return page.evaluate(() => window.__churn);
};

export async function run({ browser, reporter }) {
    reporter.suite('morph');
    const page = await newPage(browser, { width: 1280, height: 900 });

    // ---------------------------------------------------------------- issue #19
    await visit(page, `${baseUrl}/field`);

    let name = await readField(page, 'field-name');
    await reporter.check('field starts valid', async () =>
        expect.equal(name.invalid, null, 'data-invalid before any submit') || expect.equal(name.ariaInvalid, null, 'aria-invalid before any submit'));

    let email = await readField(page, 'field-email');
    await reporter.check('description is wired before any morph', async () =>
        expect.equal(email.describedby.join(','), 'field-description', 'aria-describedby on first render'));

    await page.click('[data-testid=submit]');
    await page.waitForSelector('[data-testid=field-name] [data-slot="field-error"]');
    await page.waitForTimeout(250);

    name = await readField(page, 'field-name');
    await reporter.check('error morphed in marks the field invalid', async () =>
        expect.equal(name.invalid, 'true', 'data-invalid after a failed submit') ||
        expect.equal(name.ariaInvalid, 'true', 'aria-invalid after a failed submit') ||
        expect.equal(name.describedby.join(','), 'field-error', 'aria-describedby after a failed submit'));

    email = await readField(page, 'field-email');
    await reporter.check('error joins the description rather than replacing it', async () =>
        expect.equal(email.describedby.join(','), 'field-description,field-error', 'aria-describedby with both'));

    await reporter.check('re-wiring settles', async () => {
        const churn = await settles(page, '[data-testid=field-name]');

        return churn > 0 ? `${churn} mutations while idle — the wiring is not converging` : undefined;
    });

    // Wiring has to come back OFF too, or a field stays red once it has ever been wrong.
    await page.click('[data-testid=clear]');
    await page.waitForFunction(() => !document.querySelector('[data-testid=field-name] [data-slot="field-error"]'));
    await page.waitForTimeout(250);

    name = await readField(page, 'field-name');
    await reporter.check('error morphed out withdraws the wiring', async () =>
        expect.equal(name.invalid, null, 'data-invalid once valid again') ||
        expect.equal(name.ariaInvalid, null, 'aria-invalid once valid again') ||
        expect.equal(name.describedby.length, 0, 'aria-describedby once valid again'));

    await reporter.check('no console errors on /field', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/field');

    // ------------------------------------------------- issue #19, as reported (in a dialog)
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/dialog-field`);
    await page.click('[data-testid=open]');
    await page.waitForSelector('[data-testid=submit]', { state: 'visible', timeout: 5000 });
    await page.click('[data-testid=submit]');
    await page.waitForSelector('[data-testid=field-name] [data-slot="field-error"]');
    await page.waitForTimeout(250);

    const dlg = await readField(page, 'field-name');
    await reporter.check('field inside a dialog is wired after a morph', async () =>
        expect.equal(dlg.invalid, 'true', 'data-invalid') || expect.equal(dlg.ariaInvalid, 'true', 'aria-invalid'));
    await reporter.check('no console errors on /dialog-field', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/dialog-field');

    // ------------------------------------- wiring a morph strips, on a re-render that is not about the field
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/label-wiring`);

    const before = await readField(page, 'field-auto');
    await reporter.check('label is wired to the control on first render', async () =>
        expect.truthy(before.labelTargetsControl, 'label[for] does not resolve to the control'));

    for (const n of [1, 2]) {
        await page.click('[data-testid=tick]');
        await page.waitForFunction((t) => document.querySelector('[data-testid=ticks]')?.textContent === String(t), n);
        await page.waitForTimeout(250);
    }

    const after = await readField(page, 'field-auto');
    await reporter.check('label survives re-renders that never touch the field', async () =>
        expect.truthy(after.labelTargetsControl, 'label[for] stopped resolving to the control after 2 re-renders'));
    await reporter.check('description idref survives re-renders', async () =>
        expect.equal(after.describedby.join(','), 'field-description', 'aria-describedby after 2 re-renders'));
    await reporter.check('no console errors on /label-wiring', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/label-wiring');

    // ------------------------------------------------------- issue #18 follow-up: trigger replaced
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/dialog-popover`);
    await page.click('[data-testid=open]'); // morphs the subtree, THEN shows the dialog
    await page.waitForSelector('[data-slot="dialog-content"] button[role="combobox"]', { state: 'visible', timeout: 5000 });
    await page.waitForTimeout(200);
    await page.click('[data-slot="dialog-content"] button[role="combobox"]');
    // Wait for the panel rather than for a duration: it is teleported and positioned across a
    // couple of frames, and a fixed sleep here is how a suite starts failing for no reason.
    await page.waitForSelector('[data-slot="combobox-content"]', { state: 'visible', timeout: 5000 }).catch(() => {});
    await page.waitForTimeout(200);

    const anchored = await page.evaluate(() => {
        const trigger = document.querySelector('[data-slot="dialog-content"] button[role="combobox"]');
        const panel = [...document.querySelectorAll('[data-slot="combobox-content"]')].find((p) => getComputedStyle(p).display !== 'none');
        if (!trigger || !panel) return { trigger: !!trigger, panel: !!panel };
        const t = trigger.getBoundingClientRect();
        const p = panel.getBoundingClientRect();

        return { trigger: true, panel: true, dx: Math.abs(p.x - t.x), below: p.y >= t.y + t.height - 1, narrower: p.width < t.width - 1, w: Math.round(p.width) };
    });
    await reporter.check('popover anchors to a trigger the morph replaced', async () =>
        expect.truthy(anchored.panel, 'no visible popover') ||
        (anchored.dx > 2 ? `popover is ${Math.round(anchored.dx)}px off its trigger` : undefined) ||
        expect.truthy(anchored.below, 'popover is not below its trigger'));
    await reporter.check('popover is no narrower than its trigger', async () =>
        anchored.narrower ? `popover ${anchored.w}px against a wider trigger` : undefined);
    await reporter.check('no console errors on /dialog-popover', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/dialog-popover');

    // ------------------------------------------------- issue #5: popover inside a native <dialog>
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/native-dialog`);
    await page.click('[data-testid=open]');
    await page.waitForSelector('#native[open]', { timeout: 5000 });
    await page.click('#native [data-slot="select-trigger"]');
    await page.waitForSelector('[data-slot="select-content"]', { state: 'visible', timeout: 5000 }).catch(() => {});
    await page.waitForTimeout(200);

    const layered = await page.evaluate(() => {
        const panel = [...document.querySelectorAll('[data-slot="select-content"]')].find((p) => getComputedStyle(p).display !== 'none');
        if (!panel) return { panel: false };
        const r = panel.getBoundingClientRect();
        const hit = document.elementFromPoint(r.x + r.width / 2, r.y + 8);

        return { panel: true, inDialog: !!panel.closest('dialog'), reachable: !!(hit && panel.contains(hit)) };
    });
    await reporter.check('popover shares the modal top layer', async () =>
        expect.truthy(layered.panel, 'no visible popover') ||
        expect.truthy(layered.inDialog, 'popover was left in <body>, behind the modal') ||
        expect.truthy(layered.reachable, 'popover is painted behind the modal (not hit-testable)'));
    await reporter.check('no console errors on /native-dialog', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/native-dialog');

    await page.close();
}

// Standalone entry: this app has one suite, so the runner is the suite.
const browser = await launch();
const reporter = createReporter();
console.log(`BlatUI morph acceptance — ${baseUrl}\n`);
await run({ browser, reporter });
await browser.close();
process.exit(reporter.summary() ? 1 : 0);
