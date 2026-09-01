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
    // ------------------------------------------------------------- issue #25: bound, and teleported
    //
    // A dialog renders its content inside <template x-teleport="body">, so a control in there has
    // no wire:id ancestor in the DOM. Resolving the owning component with a plain closest() found
    // nothing and the bridge fell back to local-only state: the control moved on screen, the
    // property never did, and the prefill never arrived either. Silent, both directions.
    const dialogChoice = () => page.evaluate(() => window.Livewire.all()[0].$wire.$get('choice'));

    await reporter.check('a bound control inside a dialog prefills from the property', async () => {
        const shown = await page.$eval('[data-testid=choice] [data-slot="select-trigger"]', (el) => el.textContent.trim());

        return expect.truthy(shown.includes('Beta'), `the trigger reads "${shown}" for a property holding 'b'`);
    });

    await page.click('[data-testid=choice] [data-slot="select-trigger"]');
    await page.waitForSelector('[role=option]', { state: 'visible', timeout: 5000 });
    for (const opt of await page.$$('[role=option]')) {
        if ((await opt.textContent()).trim() === 'Gamma') { await opt.click(); break; }
    }
    await page.waitForTimeout(700);

    await reporter.check('a bound control inside a dialog writes to the property', async () =>
        expect.equal(await dialogChoice(), 'c', 'the property after picking Gamma inside the dialog'));

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

    // ---------------------------------------------- issue #21: the server-table toolbar round-trips
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/data-table`);

    const table = () =>
        page.evaluate(() => ({
            perPage: document.querySelector('[data-testid=per-page]')?.textContent.trim(),
            visible: document.querySelector('[data-testid=visible]')?.textContent.trim(),
            headers: [...document.querySelectorAll('thead th')].map((t) => t.textContent.trim()).filter(Boolean),
            cells: document.querySelectorAll('tbody tr:first-child td').length,
            toolbarSlot: !!document.querySelector('[data-testid=toolbar-slot]'),
        }));

    const start = await table();
    await reporter.check('server-table renders its toolbar', async () =>
        expect.truthy(start.toolbarSlot, 'the toolbar slot did not render') ||
        expect.equal(start.headers.length, 4, 'columns on first render'));

    // Hide a column. The point of doing this server-side is that the cells stop being built at
    // all, so the count has to drop — a CSS-hidden column would leave it at 4.
    await page.click('[data-slot="server-table"] [data-slot="dropdown-menu-trigger"] button');
    await page.waitForSelector('[data-slot="dropdown-menu-content"]', { state: 'visible', timeout: 5000 });

    const menu = await page.$$eval('[data-slot="dropdown-menu-checkbox-item"]', (els) =>
        els.map((e) => e.textContent.trim()));
    await reporter.check('server-table keeps un-hideable columns out of the menu', async () =>
        expect.truthy(!menu.includes('Name'), `a column marked hideable => false is offered anyway: ${menu.join(', ')}`));

    for (const item of await page.$$('[data-slot="dropdown-menu-checkbox-item"]')) {
        if ((await item.textContent()).trim() === 'Role') {
            await item.click();
            break;
        }
    }
    await page.waitForFunction(() => document.querySelector('[data-testid=visible]')?.textContent.includes('role') === false, null, { timeout: 5000 }).catch(() => {});
    await page.waitForTimeout(250);

    const hidden = await table();
    await reporter.check('server-table hides a column server-side', async () =>
        expect.truthy(!hidden.headers.includes('Role'), `Role is still a header: ${hidden.headers.join(', ')}`) ||
        expect.equal(hidden.cells, 3, 'cells rendered per row after hiding one column'));

    // Reopen: the tick is Alpine state seeded from the server, and a morph that keeps the node
    // would leave the old value behind. This is the check that catches that.
    await page.click('[data-slot="server-table"] [data-slot="dropdown-menu-trigger"] button');
    await page.waitForSelector('[data-slot="dropdown-menu-content"]', { state: 'visible', timeout: 5000 });
    const ticks = await page.$$eval('[data-slot="dropdown-menu-checkbox-item"]', (els) =>
        Object.fromEntries(els.map((e) => [e.textContent.trim(), e.getAttribute('aria-checked')])));

    await reporter.check('server-table column ticks match the server after a morph', async () =>
        expect.equal(ticks.Role, 'false', 'the tick for the column just hidden') ||
        expect.equal(ticks.Email, 'true', 'the tick for a column still shown'));

    await page.keyboard.press('Escape');
    await page.waitForTimeout(200);
    await reporter.check('no console errors on /data-table', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/data-table');

    // ------------------------- the published bootstrap, in a Livewire app (the get-started path)
    //
    // This page loads resources/js/greenfield.js, which is blatui.js as `blatui:init` writes it,
    // rather than registering into Livewire's Alpine the way the other pages do. It is the
    // configuration a reader lands in by following get-started and then the Livewire page, and it
    // was completely broken: livewire.js is a classic script that runs during parse while a Vite
    // entry is a module that runs after, so `window.Alpine` was already Livewire's by the time the
    // bootstrap's `if (!window.Alpine)` guard was evaluated — and registration was skipped
    // entirely. Alpine ran, Livewire ran, and every BlatUI directive was undefined.
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/greenfield`);

    await reporter.check('the published bootstrap registers BlatUI alongside Livewire', async () => {
        const env = await page.evaluate(() => ({
            livewire: !!window.Livewire,
            registered: !!(window.Alpine?.store && window.Alpine.store('theme')),
        }));

        return expect.truthy(env.livewire, 'Livewire is not running on this page, so it proves nothing') ||
            expect.truthy(env.registered, 'BlatUI never registered: Alpine is running, Livewire is running, and the theme store is missing');
    });

    await page.click('[data-testid=submit]');
    await page.waitForSelector('[data-testid=field-name] [data-slot="field-error"]', { timeout: 5000 }).catch(() => {});
    await page.waitForTimeout(300);

    await reporter.check('directives work under the published bootstrap', async () => {
        const f = await page.$eval('[data-testid=field-name]', (el) => ({
            invalid: el.getAttribute('data-invalid'),
            ariaInvalid: el.querySelector('input')?.getAttribute('aria-invalid') ?? null,
        }));

        return expect.equal(f.invalid, 'true', 'data-invalid under the published bootstrap') ||
            expect.equal(f.ariaInvalid, 'true', 'aria-invalid under the published bootstrap');
    });

    // A teleported, anchored popover needs the Alpine plugins on the same instance that walked the
    // tree. Unregistered, it still becomes visible — it just lands in the corner with no data.
    await page.click('[data-testid=menu]');
    await page.waitForSelector('[data-slot="dropdown-menu-content"]', { state: 'visible', timeout: 5000 }).catch(() => {});
    await page.waitForTimeout(300);

    await reporter.check('anchored popovers work under the published bootstrap', async () => {
        const box = await page.evaluate(() => {
            const trigger = document.querySelector('[data-testid=menu]');
            const panel = [...document.querySelectorAll('[data-slot="dropdown-menu-content"]')].find((e) => getComputedStyle(e).display !== 'none');
            if (!trigger || !panel) return null;
            const t = trigger.getBoundingClientRect();
            const p = panel.getBoundingClientRect();

            return { dx: Math.abs(p.x - t.x), px: Math.round(p.x) };
        });

        return expect.truthy(box, 'the menu never opened') ||
            (box.dx > 24 ? `menu opened at x=${box.px}, ${Math.round(box.dx)}px from its trigger — the anchor never ran` : undefined);
    });

    await reporter.check('no console errors on /greenfield', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/greenfield');

    // ------------------------------------------------- issues #22 / #23: the wire:model bridge
    //
    // Every check below is about the bound value being ONE value. Under `@entangle` there were
    // two — an Alpine copy and the Livewire property — kept level by effects, with the component
    // id frozen into the x-data string at render time. $blatModel keeps none: it reads and writes
    // the property, resolving the path and the component out of the DOM each time.
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/wire-model`);

    const echo = (name) => page.$eval(`[data-testid=echo-${name}]`, (el) => el.textContent.trim());
    const prop = (name) => page.evaluate((n) => window.Livewire.all()[0].$wire.$get(n), name);
    const bump = async (testid, label = 'Increase', times = 1) => {
        for (let i = 0; i < times; i++) {
            await page.click(`[data-testid=${testid}] button[aria-label=${label}]`);
            await page.waitForTimeout(120);
        }
    };
    const flush = async (n) => {
        await page.click('[data-testid=tick]');
        await page.waitForFunction((t) => document.querySelector('[data-testid=ticks]')?.textContent === String(t), n);
        await page.waitForTimeout(200);
    };

    // Stepping arithmetic: raw += step drifts, and the drift is written into the property.
    await page.fill('[data-testid=amount] input', '1.1');
    await page.$eval('[data-testid=amount] input', (el) => el.blur());
    await page.waitForTimeout(200);
    await bump('amount', 'Increase', 8);

    await reporter.check('a run of +step lands on the step, not near it', async () =>
        expect.equal(await page.$eval('[data-testid=amount] input', (el) => el.value), '1.9', '1.1 stepped by 0.1 eight times'));

    await flush(1);
    await reporter.check('a deferred value rides along with the next request', async () =>
        expect.equal(await prop('amount'), 1.9, 'the server property after one round trip') ||
        expect.equal(await echo('amount'), '1.9', 'the server-rendered echo'));

    // .live must commit on its own — no other action to ride along with.
    await bump('live');
    await page.waitForTimeout(700);
    await reporter.check('wire:model.live commits without another request', async () =>
        expect.equal(await echo('live'), '1.0', 'the server-rendered echo after one click'));

    // The other direction: the server assigns, and every component follows without a re-seed.
    await page.click('[data-testid=seed]');
    await page.waitForTimeout(700);
    await reporter.check('components follow a value the server assigns', async () => {
        const shown = await page.evaluate(() => ({
            amount: document.querySelector('[data-testid=amount] input')?.value,
            agreed: document.querySelector('[data-testid=agreed] [role=checkbox]')?.getAttribute('aria-checked'),
            tags: [...document.querySelectorAll('[data-testid=tags] [data-slot="tags-input-item"]')].map((e) => e.textContent.trim()).join(','),
            plan: document.querySelector('[data-testid=plan] [data-slot="select-trigger"]')?.textContent.trim(),
        }));

        return expect.equal(shown.amount, '12.5', 'number-input after the server assigned 12.5') ||
            expect.equal(shown.agreed, 'true', 'checkbox after the server assigned true') ||
            expect.truthy(shown.tags.includes('alpha') && shown.tags.includes('beta'), `tags-input shows "${shown.tags}"`) ||
            expect.truthy(shown.plan?.includes('Pro'), `select shows "${shown.plan}"`);
    });

    // …and it is still bound afterwards: a morph must not leave the binding pointing at nothing.
    await flush(2);
    await bump('amount');
    await flush(3);
    await reporter.check('the binding survives the re-renders in between', async () =>
        expect.equal(await prop('amount'), 12.6, 'the property after stepping a server-assigned value'));

    // ------------------------------------------------------------------ issue #24: range modes
    //
    // `mode="range"` bound nothing at all: it rendered its from/to form fields and stopped, so
    // the one mode a Livewire date filter actually wants had no way to reach a property. A range
    // is one value in two halves, so it binds as one value — and reports the half-picked state
    // rather than hiding it, or the property and what the user sees would disagree.
    await page.click('[data-testid=stay] button');
    await page.waitForSelector('[role=gridcell] button', { state: 'visible', timeout: 5000 });
    await page.click('[role=gridcell] button:has-text("4"):visible');
    await page.waitForTimeout(200);

    await reporter.check('a half-picked range reports what was picked', async () =>
        expect.equal(JSON.stringify(await prop('stay')), '{"from":"2026-03-04","to":null}', 'the property after one end'));

    await page.click('[role=gridcell] button:has-text("9"):visible');
    await page.waitForTimeout(300);
    await flush(4);
    await reporter.check('a completed range rides along with the next request', async () =>
        expect.equal(await echo('stay'), '{"from":"2026-03-04","to":"2026-03-09"}', 'the server-rendered echo'));

    // The popover is teleported and wire:ignore'd, so a value the server assigns reaches it only
    // if the picker pushes it back in. Without that the calendar keeps highlighting what it opened
    // with, and the trigger and the calendar disagree.
    await page.click('[data-testid=seed]');
    await page.waitForTimeout(700);
    await page.click('[data-testid=stay] button');
    await page.waitForTimeout(400);
    await reporter.check('the calendar repaints to a server-assigned range', async () => {
        const marked = await page.$$eval('[data-range-start], [data-range-end]', (els) =>
            els.filter((e) => e.offsetParent !== null).map((e) => e.textContent.trim()));

        // 12–16, which the clicks above never touched: a calendar still showing 4–9 would
        // otherwise pass this on what the user picked rather than on what the server assigned.
        return expect.truthy(marked.includes('12') && marked.includes('16'), `calendar shows [${marked.join(', ')}]`);
    });
    await page.keyboard.press('Escape');
    await page.waitForTimeout(200);

    await reporter.check('a range slider binds both handles', async () => {
        await page.focus('[data-testid=price] [role=slider][aria-label$="minimum"]');
        await page.keyboard.press('ArrowRight');
        await page.waitForTimeout(150);
        await flush(5);

        return expect.equal(JSON.stringify(await prop('price')), '[41,60]', 'the property after one step of the low handle');
    });

    // ------------------------------------------------ the editor's content is the editor's own
    //
    // A contenteditable's value is its children, and its children are server-rendered — so every
    // re-render used to patch them back to whatever the page loaded with, deleting what had been
    // written since without a word. The morph is kept out of that subtree now, which means the
    // value the server assigns can no longer arrive through the morph either: it comes through an
    // effect reading the bound property instead. Both directions have to hold, or the fix has
    // just traded a component that loses your writing for one that ignores the server.
    const story = () => page.$eval('[data-testid=story] [contenteditable]', (el) => el.innerHTML);

    // Typed over whatever the checks above left in it, so this does not depend on their order.
    await page.click('[data-testid=story] [contenteditable]');
    await page.keyboard.press('Control+A');
    await page.keyboard.type('typed by the user');
    const written = await story();

    await flush(6);

    await reporter.check('a re-render does not take back what was typed into the editor', async () =>
        expect.truthy(written.includes('typed by the user'), `the editor held "${written}" before the round trip`) ||
        expect.equal(await story(), written, 'the editor after a round trip') ||
        expect.equal(await prop('story'), written, 'the property it rode along with'));

    await page.click('[data-testid=seed]');
    await page.waitForTimeout(700);

    await reporter.check('a value the server assigns still repaints the editor', async () =>
        expect.equal(await story(), '<p>from the server</p>', 'the editor after the server assigned'));

    // ------------------------------------------------------------ issue #27: the upload's own id
    //
    // Livewire drives the upload FROM the <input type=file>, and dispatches
    // livewire-upload-finish on the node it captured when the upload started. That node has to
    // still be in the document when it lands, or the event never bubbles to the listeners on the
    // component root and the row never leaves 'uploading'. It was not: the input carried a
    // generated id, re-rolled on every render, and Livewire's morph keys on `el.id` when there
    // is no wire:key — so the commit Livewire makes as part of its OWN upload protocol saw a
    // different key and swapped the input out from under the upload in flight.
    //
    // The property below resolving is what makes this worth asserting: the upload itself always
    // worked. Only the browser was left saying otherwise, permanently.
    await reporter.check('an upload with no id of its own reaches ready', async () => {
        await page.setInputFiles('[data-testid=upload] input[type=file]', {
            name: 'note.txt',
            mimeType: 'text/plain',
            buffer: Buffer.from('blatui'),
        });

        try {
            await page.waitForSelector('[data-testid=upload] [data-slot="file-upload-item"][data-status=ready]', { timeout: 8000 });
        } catch {
            const status = await page
                .$eval('[data-testid=upload] [data-slot="file-upload-item"]', (el) => el.dataset.status)
                .catch(() => 'no row');

            return `the row is "${status}" — stored server-side as ${JSON.stringify(await prop('upload'))}`;
        }

        return expect.truthy(await prop('upload'), 'the temporary upload on the server');
    });

    // The other half of the same fix: an id the consumer passes is theirs, and stays on the input.
    await reporter.check('an id the consumer passes is still rendered', async () =>
        expect.equal(await page.$eval('[data-testid=upload-keyed] input[type=file]', (el) => el.id), 'chosen-upload', 'the id prop on the input'));

    await reporter.check('no console errors on /wire-model', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/wire-model');

    // --------------------------------------------------- issue #27: ids a component made up itself
    //
    // The morph key an element is compared on is wire:id, then wire:key, then its plain id. Nine
    // components generated that id with Str::random, so every re-render produced a new key for the
    // same element and morphdom replaced the node rather than patching it. The two assertions below
    // are the two halves of what that cost: the node's identity, and the state only that node held.
    page.blatErrors.length = 0;
    await visit(page, `${baseUrl}/generated-ids`);

    const tick = async (n) => {
        // Fired from JS, not by clicking: a click would move focus by itself, and focus is one of
        // the things being measured.
        await page.evaluate(() => window.Livewire.all()[0].$wire.tick());
        await page.waitForFunction((t) => document.querySelector('[data-testid=ticks]')?.textContent === String(t), n);
        await page.waitForTimeout(300);
    };

    // Mark every element carrying an id with an expando, which only survives on the same node.
    await page.evaluate(() => {
        window.__marked = [];
        document.querySelectorAll('[data-testid] [id]').forEach((el, i) => {
            el.__probe = i;
            window.__marked.push({ i, id: el.id, owner: el.closest('[data-testid]').dataset.testid });
        });
    });
    await tick(1);

    await reporter.check('a re-render replaces no element that carries an id', async () => {
        const replaced = await page.evaluate(() => {
            const alive = new Set();
            document.querySelectorAll('*').forEach((el) => el.__probe !== undefined && alive.add(el.__probe));

            return window.__marked.filter((m) => !alive.has(m.i)).map((m) => `${m.owner} (#${m.id})`);
        });

        return expect.empty(replaced, 'elements swapped out by the morph');
    });

    // What the swap actually cost. A field the user is typing in is the whole point of the fix.
    await reporter.check('a field survives a re-render with its text and its focus', async () => {
        const typed = {};

        for (const [testid, selector, text] of [
            ['rich-text-editor', '[contenteditable]', 'half a sentence'],
            ['mention-input', 'textarea', 'hi there'],
            ['markdown-editor', 'textarea', '# draft'],
        ]) {
            await page.click(`[data-testid=${testid}] ${selector}`);
            await page.keyboard.type(text);
            await tick(Object.keys(typed).length + 2);

            typed[testid] = await page.evaluate(({ testid: id, selector: sel }) => {
                const el = document.querySelector(`[data-testid=${id}] ${sel}`);

                return {
                    text: (el.value ?? el.textContent).trim(),
                    focused: document.activeElement === el,
                };
            }, { testid, selector });
        }

        return expect.equal(typed['rich-text-editor'].text, 'half a sentence', 'rich-text-editor content') ||
            expect.equal(typed['mention-input'].text, 'hi there', 'mention-input value') ||
            expect.equal(typed['markdown-editor'].text, '# draft', 'markdown-editor value') ||
            expect.truthy(
                Object.values(typed).every((t) => t.focused),
                `focus was lost by: ${Object.entries(typed).filter(([, t]) => !t.focused).map(([k]) => k).join(', ')}`,
            );
    });

    // The wiring those ids used to carry still resolves — a name read off a dangling idref is
    // worse than the swap it replaced.
    await reporter.check('every idref still points at something', async () => {
        const dangling = await page.$$eval('[data-testid] [aria-labelledby], [data-testid] [aria-controls], [data-testid] [aria-describedby], [data-testid] label[for]', (els) =>
            els.flatMap((el) => ['aria-labelledby', 'aria-controls', 'aria-describedby', 'for']
                .flatMap((attr) => (el.getAttribute(attr) || '').split(/\s+/).filter(Boolean))
                .filter((id) => !document.getElementById(id))
                .map((id) => `${el.closest('[data-testid]').dataset.testid}: ${id}`)));

        return expect.empty(dangling, 'idrefs pointing at nothing');
    });

    await reporter.check('no console errors on /generated-ids', () => expect.empty(page.blatErrors, 'console errors'));
    reporter.progress('/generated-ids');

    await page.close();
}


// Standalone entry: this app has one suite, so the runner is the suite.
const browser = await launch();
const reporter = createReporter();
console.log(`BlatUI morph acceptance — ${baseUrl}\n`);
await run({ browser, reporter });
await browser.close();
process.exit(reporter.summary() ? 1 : 0);
