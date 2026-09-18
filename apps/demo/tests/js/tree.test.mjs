// Engine tests for the move arithmetic behind <x-ui.server-tree-table> (issue #32).
//
// treeMove() is what both the pointer drag and the keyboard reorder run: it decides where a
// row and its whole subtree land, and refuses a move into its own subtree — which, sent to the
// server, would be a cycle. It is pure (a list in, a list out), so it is tested here directly
// rather than through a browser.
//
// Run with a bare `npm test`; the engine's imports are stripped, as in number.test.mjs.

import { test } from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync, mkdtempSync, writeFileSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join, dirname } from 'node:path';
import { fileURLToPath, pathToFileURL } from 'node:url';

const here = dirname(fileURLToPath(import.meta.url));
const source = readFileSync(join(here, '../../resources/js/blatui-core.js'), 'utf8');
const shim = join(mkdtempSync(join(tmpdir(), 'blatui-tree-')), 'blatui-core.mjs');
writeFileSync(shim, source.replace(/^import[^\n]*\n/gm, ''));

globalThis.window = new EventTarget();
globalThis.localStorage = { getItem: () => null, setItem() {}, removeItem() {} };
const { treeMove, treeSiblings, treeCastKey } = await import(pathToFileURL(shim).href);

// 1 Clothing
//   2 Men
//     3 Shirts
//   4 Women
// 5 Footwear
//   6 Boots
const tree = [
    { key: '1', parent: null, depth: 0 },
    { key: '2', parent: '1', depth: 1 },
    { key: '3', parent: '2', depth: 2 },
    { key: '4', parent: '1', depth: 1 },
    { key: '5', parent: null, depth: 0 },
    { key: '6', parent: '5', depth: 1 },
];
const shape = (rows) => rows.map((r) => `${r.key}<${r.parent ?? '-'}>${r.depth}`).join(' ');

test('a row moves among its siblings with its subtree', () => {
    assert.equal(shape(treeMove(tree, '2', '4', 'after')), '1<->0 4<1>1 2<1>1 3<2>2 5<->0 6<5>1');
    assert.equal(shape(treeMove(tree, '4', '2', 'before')), '1<->0 4<1>1 2<1>1 3<2>2 5<->0 6<5>1');
});

test('"after" a parent lands after its whole subtree, not between it and its children', () => {
    assert.equal(shape(treeMove(tree, '5', '1', 'after')), '1<->0 2<1>1 3<2>2 4<1>1 5<->0 6<5>1');
    assert.equal(shape(treeMove(tree, '6', '1', 'after')), '1<->0 2<1>1 3<2>2 4<1>1 6<->0 5<->0');
});

test('inside makes it the last child, and the subtree keeps its shape one level down', () => {
    assert.equal(shape(treeMove(tree, '2', '5', 'inside')), '1<->0 4<1>1 5<->0 6<5>1 2<5>1 3<2>2');
    assert.equal(shape(treeMove(tree, '5', '4', 'inside')), '1<->0 2<1>1 3<2>2 4<1>1 5<4>2 6<5>3');
});

test('a move into its own subtree is refused — that is a cycle', () => {
    assert.equal(treeMove(tree, '1', '3', 'inside'), null);
    assert.equal(treeMove(tree, '1', '2', 'after'), null);
    assert.equal(treeMove(tree, '2', '2', 'before'), null);
    assert.equal(treeMove(tree, '9', '1', 'before'), null);
});

test('the input is not mutated', () => {
    const copy = JSON.stringify(tree);
    treeMove(tree, '2', '5', 'inside');
    assert.equal(JSON.stringify(tree), copy);
});

test('siblings are read in order, per parent', () => {
    assert.deepEqual(treeSiblings(tree, null), ['1', '5']);
    assert.deepEqual(treeSiblings(tree, '1'), ['2', '4']);
});

test('keys go back to the server in the type it sent them', () => {
    assert.equal(treeCastKey('42'), 42);
    assert.equal(treeCastKey('-1'), -1);
    assert.equal(treeCastKey('9f3c-uuid'), '9f3c-uuid');
    assert.equal(treeCastKey('0012345678901234567'), '0012345678901234567'); // past safe integers stays a string
    assert.equal(treeCastKey(''), null);
    assert.equal(treeCastKey(null), null);
});
