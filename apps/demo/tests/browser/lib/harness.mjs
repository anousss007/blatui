// Shared browser-test plumbing: one Chromium, many pages, and a reporter.
//
// Why this layer exists at all: the bugs that reached users were invisible to every
// other layer. A leaked class that resolves to `display: none` (issue #16), an Alpine
// expression that throws on a nested scope, a popover that opens behind its own
// backdrop — the markup is fine, the render tests pass, and only a real browser
// disagrees. So the rule here is: assert on COMPUTED state after a real interaction,
// never on markup. Markup is what the PHPUnit render tests are for.
import { mkdirSync } from 'node:fs';

export const SHOTS = new URL('../shots/', import.meta.url).pathname;

/** Console/page errors are a first-class failure: Alpine reports broken expressions there. */
const IGNORED_ERRORS = [/favicon/i];

/**
 * Only our own assets count. A few docs examples embed third-party media (a sample mp3, an
 * avatar from github.com) and whether that host answers says nothing about the component —
 * making the suite fail on someone else's uptime would train everyone to ignore it.
 */
let ownOrigin = '';

export function setOrigin(baseUrl) {
    ownOrigin = new URL(baseUrl).origin;
}

const isOurs = (url) => !ownOrigin || url.startsWith(ownOrigin) || url.startsWith('/');

export async function launch() {
    const { chromium } = await import('playwright').catch(() => {
        console.error('playwright is not installed. Run:\n  npm i -D playwright && npx playwright install chromium');
        process.exit(2);
    });
    mkdirSync(SHOTS, { recursive: true });

    return chromium.launch();
}

/**
 * A page that records every console error and uncaught exception it sees.
 * `page.blatErrors` is the list; suites assert it stays empty.
 */
export async function newPage(browser, { width = 1280, height = 900 } = {}) {
    // Clipboard: a few components copy to it, and a headless denial would read as a
    // component throwing rather than as a permission the browser never granted.
    const page = await browser.newPage({
        viewport: { width, height },
        permissions: ['clipboard-read', 'clipboard-write'],
    });
    page.blatErrors = [];

    const record = (text) => {
        if (!IGNORED_ERRORS.some((re) => re.test(text))) page.blatErrors.push(text);
    };
    page.on('console', (m) => m.type() === 'error' && record(m.text()));
    page.on('pageerror', (e) => record(`uncaught: ${e.message}`));
    page.on('requestfailed', (r) => isOurs(r.url()) && record(`request failed: ${r.url()} (${r.failure()?.errorText})`));

    return page;
}

/**
 * Load a page and wait for Alpine to have actually booted.
 *
 * A fixed sleep here is the difference between a suite people trust and one they mute: on a
 * docs page with fifty components, interacting 250ms after load sometimes lands before the
 * listeners exist, and the failure looks exactly like a broken component.
 */
export async function visit(page, url) {
    await page.goto(url, { waitUntil: 'networkidle' });
    await page
        .waitForFunction(() => window.Alpine && document.querySelectorAll('[x-cloak]').length === 0, null, { timeout: 5000 })
        .catch(() => {}); // a page with no Alpine at all is a legitimate case
    await page.waitForTimeout(100);
}

export function createReporter() {
    const results = [];
    let current = '';

    return {
        suite(name) {
            current = name;
        },
        pass(name) {
            results.push({ suite: current, name, ok: true });
        },
        fail(name, detail) {
            results.push({ suite: current, name, ok: false, detail });
            console.log(`  ✗ ${name}\n      ${String(detail).split('\n').join('\n      ')}`);
        },
        /** Run one check; a thrown error is a failure, never a crashed run. */
        async check(name, fn) {
            try {
                const detail = await fn();
                if (detail) {
                    this.fail(name, detail);

                    return false;
                }
                this.pass(name);

                return true;
            } catch (e) {
                this.fail(name, e.stack || e.message);

                return false;
            }
        },
        /** One line per page so an hour-long CI run is never silent. */
        progress(label) {
            const done = results.length;
            const bad = results.filter((r) => !r.ok).length;
            process.stdout.write(`  ${bad ? '✗' : '·'} ${label} (${done} checks${bad ? `, ${bad} failed` : ''})\n`);
        },

        summary() {
            const failed = results.filter((r) => !r.ok);
            const bySuite = new Map();
            for (const r of results) {
                const s = bySuite.get(r.suite) || { pass: 0, fail: 0 };
                r.ok ? s.pass++ : s.fail++;
                bySuite.set(r.suite, s);
            }

            console.log('\n─────────────────────────────────────────────');
            for (const [suite, s] of bySuite) {
                console.log(`${s.fail ? '✗' : '✓'} ${suite}: ${s.pass} passed${s.fail ? `, ${s.fail} FAILED` : ''}`);
            }
            console.log(`\n${results.length} checks, ${failed.length} failed`);

            if (failed.length) {
                console.log('\nFailures:');
                for (const f of failed) console.log(`  • [${f.suite}] ${f.name}`);
            }

            return failed.length;
        },
    };
}

/**
 * Walk a list of pages with N browser pages in parallel.
 *
 * The suites cover a few hundred URLs; serial runs are slow enough that nobody would put
 * them in CI, and a suite nobody runs protects nobody. Each lane owns its page, so error
 * logs never cross.
 */
export async function inLanes(browser, items, { lanes = 4, viewport, each }) {
    const queue = [...items];

    const lane = async () => {
        const page = await newPage(browser, viewport);
        for (let item = queue.shift(); item !== undefined; item = queue.shift()) {
            await each(page, item);
        }
        await page.close();
    };

    await Promise.all(Array.from({ length: lanes }, lane));
}

/** Assertion helpers that return a failure string (or undefined) rather than throwing. */
export const expect = {
    empty(list, what) {
        if (list.length) return `${what}:\n- ${list.slice(0, 5).join('\n- ')}`;
    },
    equal(actual, wanted, what) {
        if (actual !== wanted) return `${what}: expected ${JSON.stringify(wanted)}, got ${JSON.stringify(actual)}`;
    },
    truthy(value, what) {
        if (!value) return what;
    },
};
