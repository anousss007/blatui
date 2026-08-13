// Visual regression: does each component still LOOK the way it looked?
//
// The other suites answer "does it work" — a panel opens, a value changes, nothing throws. They
// are blind to a component that works perfectly while rendering wrong: a padding that collapsed,
// a colour that inverted, a grid that reflowed into one column at the wrong width. This one
// fingerprints the rendered pixels per component per width and fails when they move.
//
// Two things keep it from becoming the flaky suite everyone mutes:
//
//  1. Animations are frozen, the caret is hidden, and every cross-origin request is blocked —
//     the demo's webfonts come from a CDN, and text in a different face moves every hash on the
//     page, so a baseline recorded on a laptop would fail wholesale on a CI runner.
//  2. Every page is captured twice. A component that cannot reproduce its own rendering one
//     second later (marquee, typewriter, confetti, anything seeded randomly) is reported as
//     non-deterministic and left out — never silently, always counted in the summary.
//
// Baselines live in tests/browser/baseline/visual.json, ~70 bytes per entry. Regenerate with
// `npm run test:browser -- --suite=visual --update-baseline` and review the diff like any other
// change: an intentional restyle shows up as changed hashes for exactly the components you
// touched, and an accidental one shows up for the components you did not.
import { existsSync, mkdirSync, readFileSync, writeFileSync } from 'node:fs';
import { expect, inLanes, visit } from '../lib/harness.mjs';
import { distance, fingerprint, freeze, pinRendering, TOLERANCE } from '../lib/fingerprint.mjs';

/** The docs render each example in its own <section>; that is the unit worth fingerprinting. */
const EXAMPLE = 'main section';

/** Enough to cover a component's surface without turning the baseline into a novel. */
const MAX_EXAMPLES = 4;

/**
 * Components whose rendering is a function of time, not of the code.
 *
 * The double-capture below catches most of them on its own; these are the ones that hold still
 * long enough to be recorded and have moved on by the next run — a number counting up when the
 * capture scrolls it into view, text that streams in. Excluding them by name is honest; letting
 * them fail intermittently would teach everyone to ignore this suite. They are still covered by
 * every other suite, and the exclusions are printed on each run.
 */
const TIME_DEPENDENT = new Set([
    'number-ticker',
    'streaming-text',
    'typewriter',
    'marquee',
    'confetti',
    'countdown',
    // A single example rather than a whole component: `slug#index` excludes just that block.
    // image#2 is the blur-up placeholder, and its full-size image is a third-party URL the
    // capture blocks on purpose. Whether the swap out of the placeholder lands before the
    // shot depends on how fast that abort arrives, which under four parallel lanes is a coin
    // flip — it settles into either state and holds there, so a re-capture agrees with itself
    // and the entry reads as a regression instead of as the race it is.
    'image#2',
]);

const BASELINE = new URL('../baseline/visual.json', import.meta.url).pathname;
const SHOTS = new URL('../shots/', import.meta.url).pathname;

function loadBaseline() {
    if (!existsSync(BASELINE)) return {};

    return JSON.parse(readFileSync(BASELINE, 'utf8'));
}

function saveBaseline(data) {
    mkdirSync(new URL('../baseline/', import.meta.url).pathname, { recursive: true });
    writeFileSync(BASELINE, `${JSON.stringify(data, Object.keys(data).sort(), 2)}\n`);
}

export async function run({ browser, reporter, baseUrl, inventory, only, viewports, updateBaseline }) {
    const baseline = loadBaseline();
    const captured = {};
    const unstable = [];

    const slugs = inventory.components.filter((s) => !only || s.includes(only));

    for (const { name, width, height } of viewports) {
        reporter.suite(`visual @ ${name}px`);

        await inLanes(browser, slugs, {
            lanes: 4,
            viewport: { width, height },
            each: async (page, slug) => {
                if (TIME_DEPENDENT.has(slug)) return;

                const key = `${slug}@${name}`;

                if (!page.blatPinned) {
                    await pinRendering(page, baseUrl);
                    page.blatPinned = true;
                }

                await visit(page, `${baseUrl}/components/${slug}`);
                await freeze(page);

                // One fingerprint per example block: a whole-page hash at 17×16 cannot see a
                // padding change in one example out of forty, and cannot tell you which moved.
                const blocks = Math.min(await page.locator(EXAMPLE).count(), MAX_EXAMPLES);

                for (let i = 0; i < blocks; i++) {
                    const id = `${key}#${i}`;
                    if (TIME_DEPENDENT.has(`${slug}#${i}`)) continue;

                    const shot = await fingerprint(page, EXAMPLE, i).catch(() => null);
                    if (!shot) continue; // not rendered at this width (hidden by a media query)

                    // Recording: capture twice, because a rendering that cannot reproduce itself
                    // must never become a baseline. Comparing: capture once — the second capture
                    // is only worth its time when something already looks wrong, and then it
                    // doubles as the retry that keeps a transient from failing the build.
                    if (updateBaseline) {
                        // Three captures spread over ~1.6s, not two 300ms apart. Intro
                        // animations are the whole problem here: a text stream, a number
                        // counting up, a scroll-triggered reveal that only starts when the
                        // capture scrolls it into view. Two quick looks record a frame that
                        // will never occur again and every later run calls it a regression.
                        let stable = true;
                        for (const wait of [800, 800]) {
                            await page.waitForTimeout(wait);
                            const again = await fingerprint(page, EXAMPLE, i).catch(() => null);
                            if (!again || distance(shot, again) > TOLERANCE) stable = false;
                        }

                        if (stable) captured[id] = shot;
                        else unstable.push(id);

                        continue;
                    }

                    const known = baseline[id];
                    if (known && distance(known, shot) <= TOLERANCE) {
                        reporter.pass(`${slug} @ ${name}px: example ${i + 1} renders as recorded`);

                        continue;
                    }

                    await reporter.check(`${slug} @ ${name}px: example ${i + 1} renders as recorded`, async () => {
                        if (!known) return `no baseline for ${id} — run with --update-baseline and review the diff`;

                        // Second look before calling it a regression.
                        await page.waitForTimeout(300);
                        const confirm = await fingerprint(page, EXAMPLE, i).catch(() => null);
                        if (!confirm) return; // element went away mid-check; not a rendering claim
                        if (distance(known, confirm) <= TOLERANCE) return;

                        if (distance(shot, confirm) > TOLERANCE) {
                            unstable.push(id);

                            return; // it cannot even reproduce itself — reported as uncovered
                        }

                        // Give the human something to look at, not just a hex string.
                        mkdirSync(SHOTS, { recursive: true });
                        const file = `${id.replace('@', '-').replace('#', '-ex')}.png`;
                        await page.locator(EXAMPLE).nth(i).screenshot({ path: SHOTS + file, animations: 'disabled', caret: 'hide' });

                        return `rendering changed: ${distance(known, confirm)}/256 bits differ (tolerance ${TOLERANCE}). Screenshot: tests/browser/shots/${file}`;
                    });
                }
            },
        });

        reporter.progress(`visual ${name}px`);
    }

    if (updateBaseline) {
        // Keep entries for widths this run did not cover, so a sharded update is additive.
        saveBaseline({ ...baseline, ...captured });
        console.log(`\nBaseline updated: ${Object.keys(captured).length} entries written to tests/browser/baseline/visual.json`);
    }

    console.log(`\nNot covered visually — rendering depends on time, not on the code: ${[...TIME_DEPENDENT].join(', ')}`);

    if (unstable.length) {
        console.log(`\n${unstable.length} rendering(s) are non-deterministic and are NOT covered visually:`);
        console.log(`  ${[...new Set(unstable.map((k) => k.split('@')[0]))].join(', ')}`);
    }
}

/** Exposed so the runner can report coverage honestly in its summary. */
export function coverage() {
    return Object.keys(loadBaseline()).length;
}
