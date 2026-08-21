// Engine tests for the stepping arithmetic in resources/js/blatui-core.js.
//
// These exist because the bug they lock down is invisible to a render test and awkward to see
// in a browser: `0.1 + 0.1 + 0.1` is 0.30000000000000004, so a stepper that adds its raw step
// walks off the values the author declared — eight +0.1 clicks from 1.1 landed on
// 1.3666666666666667 rather than 1.9, and that number was then written into the consumer's
// Livewire property (issue #22).
//
// Run with a bare `npm test` (no node_modules needed): the engine's Alpine/floating-ui imports
// are irrelevant here, so we strip them and import the helpers directly.

import { test } from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join, dirname } from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';

const here = dirname(fileURLToPath(import.meta.url));
const source = readFileSync(join(here, '../../resources/js/blatui-core.js'), 'utf8');
const shim = join(mkdtempSync(join(tmpdir(), 'blatui-number-')), 'blatui-core.mjs');
writeFileSync(shim, source.replace(/^import[^\n]*\n/gm, ''));

globalThis.window = new EventTarget();
globalThis.localStorage = { getItem: () => null, setItem() {}, removeItem() {} };
const { blatNumber } = await import(pathToFileURL(shim).href);

test('decimals() counts the places a number actually carries', () => {
    assert.equal(blatNumber.decimals(1), 0);
    assert.equal(blatNumber.decimals(0.1), 1);
    assert.equal(blatNumber.decimals(1.32), 2);
    assert.equal(blatNumber.decimals(0.005), 3);
    assert.equal(blatNumber.decimals(1e-7), 7);       // exponent notation, not "1e-7".length
    assert.equal(blatNumber.decimals(1.5e-7), 8);
    assert.equal(blatNumber.decimals(null), 0);
    assert.equal(blatNumber.decimals(Infinity), 0);
});

test('a run of +step lands on the values the step describes', () => {
    let v = 1.1;
    for (let i = 0; i < 8; i++) v = blatNumber.step(v, 0.1, 0.1);
    assert.equal(v, 1.9);                              // was 1.3666666666666667

    let d = 1.9;
    for (let i = 0; i < 8; i++) d = blatNumber.step(d, -0.1, 0.1);
    assert.equal(d, 1.1);
});

test('stepping keeps the precision the value carries, not just the step', () => {
    // A whole step over a hand-typed 1.32 must not round the value to the step's precision.
    assert.equal(blatNumber.step(1.32, 1, 1), 2.32);
    assert.equal(blatNumber.step(1.32, -1, 1), 0.32);
    assert.equal(blatNumber.step(1.32, 0.01, 0.01), 1.33);
    assert.equal(blatNumber.step(1.32, 0.1, 0.1), 1.42);
});

test('stepping treats a missing value as zero rather than NaN', () => {
    assert.equal(blatNumber.step(null, 0.1, 0.1), 0.1);
    assert.equal(blatNumber.step(undefined, 1, 1), 1);
});

test('round() trims float noise without inventing precision', () => {
    assert.equal(blatNumber.round(1.9000000000000008, 1), 1.9);
    assert.equal(blatNumber.round(2.3200000000000003, 2), 2.32);
    assert.equal(blatNumber.round(1.005, 2), 1.01);
    assert.equal(blatNumber.round(null, 2), null);
});

test('snap() lands on a multiple of the step, counted from the origin', () => {
    assert.equal(blatNumber.snap(0.28, 0.1), 0.3);     // Math.round(0.28/0.1)*0.1 = 0.30000000000000004
    assert.equal(blatNumber.snap(7, 5), 5);
    assert.equal(blatNumber.snap(0.24, 0.1, 0.05), 0.25);
    assert.equal(blatNumber.snap(3, 0), 3);            // a zero step is a no-op, not a division
});
