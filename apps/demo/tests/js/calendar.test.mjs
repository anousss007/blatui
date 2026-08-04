// Engine tests for the `calendar` Alpine component (resources/js/blatui-core.js).
//
// These lock the event/targeting contract that consumers build popovers on top of — the
// rules that, when they broke, forced every wrapper to carry a `syncing` flag:
//
//   • an incoming calendar:* hook never emits `calendar-change`;
//   • a user pick emits `calendar-change` exactly once;
//   • a window-level hook with `detail.id` reaches only that calendar;
//   • a hook for the wrong mode is a no-op — it does not even move the view.
//
// Run with a bare `node --test apps/demo/tests/js` (no node_modules needed): the engine's
// Alpine/floating-ui imports are irrelevant to the calendar, so we strip them and drive the
// factory directly with a stub Alpine scope ($root / $dispatch).

import { test } from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join, dirname } from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';

const here = dirname(fileURLToPath(import.meta.url));
const source = readFileSync(join(here, '../../resources/js/blatui-core.js'), 'utf8');
// The stripped bindings (anchor/focus/collapse/floating-ui) are only ever touched inside
// registerBlatUI and x-blat-anchor, neither of which these tests call.
const stripped = source.replace(/^import[^\n]*\n/gm, '');
const shim = join(mkdtempSync(join(tmpdir(), 'blatui-engine-')), 'blatui-core.mjs');
writeFileSync(shim, stripped);

// Minimal browser globals the module body touches on load (the theme store reads
// localStorage at definition time). The calendar itself needs none of this.
globalThis.window = new EventTarget();
globalThis.localStorage = { getItem: () => null, setItem() {}, removeItem() {} };
const { calendar } = await import(pathToFileURL(shim).href);

/** Instantiate the engine with a stub Alpine scope; returns the component + its event log. */
function mount(cfg = {}) {
    const events = [];
    const root = new EventTarget();
    root.querySelector = () => null; // roving focus looks up day buttons; there is no DOM here
    const c = calendar(cfg);
    c.$root = root;
    c.$dispatch = (name, detail) => events.push({ name, detail });
    c.init();
    return { c, root, events };
}

const names = (events) => events.map((e) => e.name);
const day = (y, m, d) => new Date(y, m - 1, d);
const viewOf = (c) => c.view.getFullYear() + '-' + String(c.view.getMonth() + 1).padStart(2, '0');

test('calendar:set-range seeds without emitting calendar-change', () => {
    const { c, root, events } = mount({ mode: 'range', defaultMonth: '2026-08-01' });

    root.dispatchEvent(new CustomEvent('calendar:set-range', { detail: { from: '2026-08-10', to: '2026-08-14' } }));

    // The whole point: a popover that seeds itself on open must not see the event its own
    // "close when the range is complete" handler listens for.
    assert.deepEqual(names(events), ['calendar:updated']);
    assert.equal(events[0].detail.source, 'set-range');
    assert.deepEqual(events[0].detail.value, { from: '2026-08-10', to: '2026-08-14' });
    assert.deepEqual(c.value, { from: '2026-08-10', to: '2026-08-14' });
});

test('calendar:set and calendar:today seed without emitting calendar-change', () => {
    const { c, root, events } = mount({ mode: 'single' });

    root.dispatchEvent(new CustomEvent('calendar:set', { detail: '1991-03-04' }));
    root.dispatchEvent(new CustomEvent('calendar:today'));

    assert.deepEqual(names(events), ['calendar:updated', 'calendar:updated']);
    assert.deepEqual(events.map((e) => e.detail.source), ['set', 'today']);
    assert.equal(c.value, c.fmt(new Date()));
});

test('a user pick emits calendar-change exactly once, alongside calendar:updated', () => {
    const { c, events } = mount({ mode: 'range', defaultMonth: '2026-08-01' });

    c.select(day(2026, 8, 10));
    c.select(day(2026, 8, 14));

    const legacy = events.filter((e) => e.name === 'calendar-change');
    assert.equal(legacy.length, 2, 'one calendar-change per click, not per state write');
    assert.deepEqual(legacy[1].detail, { from: '2026-08-10', to: '2026-08-14' });
    assert.equal(events.filter((e) => e.name === 'calendar:updated').every((e) => e.detail.source === 'select'), true);
});

test('a window hook carrying detail.id reaches only the matching instance', () => {
    const a = mount({ mode: 'range', calendarId: 'sidebar', defaultMonth: '2026-08-01' });
    const b = mount({ mode: 'range', calendarId: 'mobile-sheet', defaultMonth: '2026-08-01' });

    window.dispatchEvent(new CustomEvent('calendar:set-range', {
        detail: { id: 'sidebar', from: '2026-08-10', to: '2026-08-14' },
    }));

    assert.deepEqual(a.c.value, { from: '2026-08-10', to: '2026-08-14' });
    assert.deepEqual(b.c.value, { from: null, to: null });
    assert.equal(b.events.length, 0);

    a.c.destroy();
    b.c.destroy();
});

test('an element-scoped hook never leaks to the other instances on the page', () => {
    const a = mount({ mode: 'range', defaultMonth: '2026-08-01' });
    const b = mount({ mode: 'range', defaultMonth: '2026-08-01' });

    a.root.dispatchEvent(new CustomEvent('calendar:set-range', { detail: { from: '2026-08-10', to: '2026-08-14' } }));

    assert.deepEqual(b.c.value, { from: null, to: null });
    assert.equal(b.events.length, 0);

    a.c.destroy();
    b.c.destroy();
});

test('a hook for the wrong mode is a no-op — it does not move the view either', () => {
    const { c, events } = mount({ mode: 'range', defaultMonth: '2026-08-01' });

    // A birthday picker seeding "1991" must not drag an unrelated range calendar 35 years back.
    window.dispatchEvent(new CustomEvent('calendar:set', { detail: '1991-03-04' }));

    assert.equal(viewOf(c), '2026-08');
    assert.equal(events.length, 0);

    c.destroy();
});

test('calendar:goto moves the view in any mode without selecting', () => {
    const { c, root, events } = mount({ mode: 'range', defaultMonth: '2026-08-01' });

    root.dispatchEvent(new CustomEvent('calendar:goto', { detail: '2026-12' }));

    assert.equal(viewOf(c), '2026-12');
    assert.deepEqual(c.value, { from: null, to: null });
    assert.equal(events.length, 0);
});

test('calendar:clear resets the selection and reports source "clear"', () => {
    const { c, root, events } = mount({ mode: 'range', value: { from: '2026-08-10', to: '2026-08-14' } });

    root.dispatchEvent(new CustomEvent('calendar:clear'));

    assert.deepEqual(c.value, { from: null, to: null });
    assert.deepEqual(names(events), ['calendar:updated']);
    assert.equal(events[0].detail.source, 'clear');
});

test('the controlled value is two-way and idempotent (no x-modelable ping-pong)', () => {
    const { c, events } = mount({ mode: 'range', defaultMonth: '2026-08-01' });

    c.value = { from: '2026-08-10', to: '2026-08-14' };
    assert.deepEqual(c.value, { from: '2026-08-10', to: '2026-08-14' });
    assert.deepEqual(names(events), ['calendar:updated']);
    assert.equal(events[0].detail.source, 'value');

    // Writing back what we already hold must not produce a new change — otherwise the
    // entangled binding would oscillate forever.
    c.value = { from: '2026-08-10', to: '2026-08-14' };
    assert.equal(events.length, 1);
});

test('seeding a visible value leaves the view alone; an off-screen one is scrolled in', () => {
    const { c, root } = mount({ mode: 'range', value: { from: '2026-08-10', to: '2026-08-14' }, numberOfMonths: 2 });
    assert.equal(viewOf(c), '2026-08');

    c.next(); // the user navigates: September + October are on screen
    assert.equal(viewOf(c), '2026-09');

    // A value inside the visible span must not re-home the view under the user…
    root.dispatchEvent(new CustomEvent('calendar:set-range', { detail: { from: '2026-10-02', to: '2026-10-06' } }));
    assert.equal(viewOf(c), '2026-09');

    // …one outside it is scrolled into view, so a seeded selection is never invisible.
    root.dispatchEvent(new CustomEvent('calendar:set-range', { detail: { from: '2027-03-02', to: '2027-03-06' } }));
    assert.equal(viewOf(c), '2027-03');
});

test('destroy() detaches the window hooks', () => {
    const { c, events } = mount({ mode: 'single' });

    c.destroy();
    window.dispatchEvent(new CustomEvent('calendar:set', { detail: '2026-08-10' }));

    assert.equal(events.length, 0);
    assert.equal(c.value, null);
});

test('arrow keys mirror under dir=rtl, Home/End stay logical', () => {
    const key = (c, k) => c.onDayKeydown({ key: k, preventDefault() {} }, c.focusedDate);
    const focused = (c) => c.fmt(c.focusedDate);

    const ltr = mount({ mode: 'single', value: '2026-08-12', weekStart: 1 }).c;
    key(ltr, 'ArrowLeft');
    assert.equal(focused(ltr), '2026-08-11', 'LTR: ArrowLeft is the previous day');

    // Same calendar rendered right-to-left: the next day is now the one on the left.
    const rtl = mount({ mode: 'single', value: '2026-08-12', weekStart: 1 }).c;
    rtl.isRtl = () => true;
    key(rtl, 'ArrowLeft');
    assert.equal(focused(rtl), '2026-08-13', 'RTL: ArrowLeft is the next day');
    key(rtl, 'ArrowRight');
    assert.equal(focused(rtl), '2026-08-12', 'RTL: ArrowRight walks back');

    // Vertical movement and the week edges are direction-independent.
    key(rtl, 'ArrowDown');
    assert.equal(focused(rtl), '2026-08-19');
    key(rtl, 'Home');
    assert.equal(focused(rtl), '2026-08-17', 'week-start=monday → Home is that Monday');
    key(rtl, 'End');
    assert.equal(focused(rtl), '2026-08-23', 'End is that Sunday');
});

test('multiple mode reports its value as an array and honours clear', () => {
    const { c, root, events } = mount({ mode: 'multiple', defaultMonth: '2026-08-01' });

    c.select(day(2026, 8, 3));
    c.select(day(2026, 8, 5));
    assert.deepEqual(c.value, ['2026-08-03', '2026-08-05']);
    assert.equal(events.filter((e) => e.name === 'calendar-change').length, 2);

    root.dispatchEvent(new CustomEvent('calendar:clear'));
    assert.deepEqual(c.value, []);
});
