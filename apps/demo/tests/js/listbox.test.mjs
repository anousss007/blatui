// Engine tests for blatListbox, the filter behind <x-ui.combobox> (issue #63).
//
// Each option row used to decide whether it was shown with
// `visible.some((o) => o.value === option.value)`, and `visible` filtered the whole list on every
// read: n² matches() per render and per keystroke, each folding (normalize + regex) both strings.
// 906 options took about three seconds to appear. A row now asks isVisible(option) about itself,
// and folded strings are memoised, so a render folds each label once and the query once.
//
// The engine is a plain object factory, so these tests drive it without Alpine. Run with a bare
// `npm test`; the engine's imports are stripped, as in number.test.mjs.

import { test } from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join, dirname } from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';

const here = dirname(fileURLToPath(import.meta.url));
const source = readFileSync(join(here, '../../resources/js/blatui-core.js'), 'utf8');
const shim = join(mkdtempSync(join(tmpdir(), 'blatui-listbox-')), 'blatui-core.mjs');
writeFileSync(shim, source.replace(/^import[^\n]*\n/gm, ''));

globalThis.window = new EventTarget();
globalThis.localStorage = { getItem: () => null, setItem() {}, removeItem() {} };
const { blatListbox } = await import(pathToFileURL(shim).href);

const many = (n) => Array.from({ length: n }, (_, i) => ({ value: i + 1, label: `Option ${i + 1}` }));

// What the template does on a render: every row runs its x-show, and the empty state reads
// visibleCount once.
const render = (lb) => ({ shown: lb.options.filter((o) => lb.isVisible(o)).map((o) => o.value), count: lb.visibleCount });

// Counts the folds (String.prototype.normalize calls) made while fn runs.
const countFolds = (fn) => {
    const original = String.prototype.normalize;
    let calls = 0;
    String.prototype.normalize = function (...args) { calls++; return original.apply(this, args); };
    try { fn(); } finally { String.prototype.normalize = original; }
    return calls;
};

test('a render folds each label once, not once per pair of options', () => {
    const lb = blatListbox({ options: many(1000) });
    lb.query = 'option 1';
    const folds = countFolds(() => render(lb));
    // 1000 labels + the query. The old template made 2 × 1000² = 2,000,000.
    assert.ok(folds <= 1001, `a render of 1000 options folded ${folds} strings`);
});

test('a keystroke folds only the new query', () => {
    const lb = blatListbox({ options: many(1000) });
    lb.query = 'option 1';
    render(lb);
    lb.query = 'option 12';
    assert.equal(countFolds(() => render(lb)), 1);
});

test('a 1000-option render stays well under a frame budget', () => {
    const lb = blatListbox({ options: many(1000) });
    lb.query = 'opt';
    render(lb);
    const start = performance.now();
    for (const q of ['o', 'op', 'opti', 'option 9', 'option 99', '']) { lb.query = q; render(lb); }
    // Six renders. The quadratic version took seconds for one.
    const ms = performance.now() - start;
    assert.ok(ms < 200, `six renders of 1000 options took ${ms.toFixed(0)} ms`);
});

test('the button trigger filters by query, ignoring case and accents', () => {
    const lb = blatListbox({ options: [
        { value: 'jose', label: 'José' },
        { value: 'joan', label: 'Joan' },
        { value: 'ana', label: 'Ana' },
    ] });
    assert.deepEqual(render(lb), { shown: ['jose', 'joan', 'ana'], count: 3 });
    lb.query = 'JOSE';
    assert.deepEqual(render(lb), { shown: ['jose'], count: 1 });
    lb.query = 'jo';
    assert.deepEqual(render(lb), { shown: ['jose', 'joan'], count: 2 });
    lb.query = 'zz';
    assert.deepEqual(render(lb), { shown: [], count: 0 });
});

test('the rows shown are exactly `visible`, which keyboard navigation walks', () => {
    const lb = blatListbox({ options: many(50) });
    for (const q of ['', '1', 'option 2', '49', 'nope']) {
        lb.query = q;
        assert.deepEqual(render(lb).shown, lb.visible.map((o) => o.value), `query "${q}"`);
    }
});

test('the input trigger shows every option until the user types', () => {
    const lb = blatListbox({ trigger: 'input', options: many(5), query: 'Option 3' });
    assert.equal(render(lb).count, 5);
    lb.filtering = true;
    assert.deepEqual(render(lb), { shown: [3], count: 1 });
});

test('a remote list is never filtered again in the browser', () => {
    const lb = blatListbox({ remote: true, options: [{ value: 1, label: 'Acme Corp' }] });
    lb.query = 'BE0123456789';
    assert.deepEqual(render(lb), { shown: [1], count: 1 });
});
