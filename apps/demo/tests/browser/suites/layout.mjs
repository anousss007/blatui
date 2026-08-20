// Layout invariants: things that are wrong at any width, without needing a baseline to compare
// against.
//
// The visual suite catches "this looks different than last week". This one catches "this looks
// broken", which is the failure a user actually reports — a page you can scroll sideways, a
// panel hanging off the edge of a phone, a control squashed to nothing, text spilling out of
// the box that is supposed to contain it. All of it is measurable, none of it needs a baseline,
// and all of it is width-dependent, which is why it runs across the matrix.
import { expect, inLanes, visit } from '../lib/harness.mjs';
import { pinRendering } from '../lib/fingerprint.mjs';

/** Slack for sub-pixel rounding in layout maths. */
const EPSILON = 2;

/**
 * Components whose intrinsic width still exceeds a 320px viewport, listed rather than hidden.
 *
 * All four size themselves from their content the way shadcn/ui does upstream — a segmented
 * tab list, a horizontal menu bar, a dock, a data table. Fixing them means deviating from
 * upstream layout on every screen to serve the narrowest one, which is a design decision for
 * the maintainer rather than something a test should force. They are printed on every run so
 * the list cannot quietly grow, and they are only excused at 320px: at 375 and up they are
 * enforced like everything else.
 */
const KNOWN_NARROW_OVERFLOW = new Set(['tabs@320', 'navigation-menu@320', 'dock@320', 'data-table@320']);

/**
 * Slots allowed to sit outside the viewport, along with everything inside them: things that are
 * deliberately parked off-screen — a closed drawer, the slides a carousel has not reached, the
 * items a marquee has already carried past the edge.
 */
const OFFSCREEN_BY_DESIGN = ['sheet-content', 'drawer-content', 'sidebar', 'carousel-item', 'carousel-content', 'marquee', 'sonner-toast'];

export async function run({ browser, reporter, baseUrl, inventory, only, viewports }) {
    const slugs = inventory.components.filter((s) => !only || s.includes(only));
    const knownHits = [];

    for (const { name, width, height } of viewports) {
        reporter.suite(`layout @ ${name}px`);

        await inLanes(browser, slugs, {
            lanes: 4,
            viewport: { width, height },
            each: async (page, slug) => {
                // Same pinning as the visual suite: block the webfont CDN so a laptop and a CI
                // runner measure the same boxes. It is also the conservative case — the system
                // fallback is wider than the webfaces, so anything that fits here fits in
                // production too.
                if (!page.blatPinned) {
                    await pinRendering(page, baseUrl);
                    page.blatPinned = true;
                }

                await visit(page, `${baseUrl}/components/${slug}`);

                const excused = KNOWN_NARROW_OVERFLOW.has(`${slug}@${name}`);
                if (excused) knownHits.push(`${slug}@${name}`);

                await reporter.check(`${slug} @ ${name}px: the page does not scroll sideways`, async () => {
                    const overflow = await page.evaluate((eps) => {
                        const doc = document.documentElement;
                        if (doc.scrollWidth <= doc.clientWidth + eps) return null;

                        // Name the widest offender rather than just reporting the symptom —
                        // skipping anything inside a scroll container, which is wide ON PURPOSE
                        // (a data table in its own overflow-x-auto is not what pushed the page).
                        const inScroller = (el) => {
                            for (let n = el.parentElement; n; n = n.parentElement) {
                                if (['auto', 'scroll', 'hidden'].includes(getComputedStyle(n).overflowX)) return true;
                            }

                            return false;
                        };

                        const worst = [...document.querySelectorAll('body *')]
                            .map((el) => ({ el, r: el.getBoundingClientRect() }))
                            .filter(({ el, r }) => r.width > 0 && r.right > doc.clientWidth + eps && !inScroller(el))
                            .sort((a, b) => b.r.right - a.r.right)[0];

                        return {
                            scrollWidth: doc.scrollWidth,
                            clientWidth: doc.clientWidth,
                            culprit: worst && (worst.el.getAttribute('data-slot') || worst.el.tagName.toLowerCase()),
                            overhang: worst && Math.round(worst.r.right - doc.clientWidth),
                        };
                    }, EPSILON);

                    if (!overflow) return;
                    if (excused) return; // listed above, and reported in the summary

                    return `horizontal overflow: ${overflow.scrollWidth}px of content in ${overflow.clientWidth}px${
                        overflow.culprit ? ` — widest offender <${overflow.culprit}>, ${overflow.overhang}px past the edge` : ''
                    }`;
                });

                await reporter.check(`${slug} @ ${name}px: no component is squashed to nothing`, async () => {
                    const collapsed = await page.evaluate(() =>
                        [...document.querySelectorAll('main [data-slot]')]
                            .filter((el) => {
                                const cs = getComputedStyle(el);
                                if (cs.display === 'none' || cs.visibility === 'hidden' || cs.position === 'absolute') return false;
                                if (el.closest('[hidden], [x-cloak], template')) return false;
                                // Wrappers that hold nothing but a <template> legitimately have
                                // no box; only something with visible text owes the user one.
                                if (!el.textContent?.trim()) return false;
                                // An <img> whose source we blocked has no intrinsic size, and the
                                // box around it collapses. That is this suite's own doing, not the
                                // component's — a real image would have loaded.
                                const img = el.matches('img') ? el : el.querySelector('img');
                                if (img && !img.naturalWidth) return false;
                                const r = el.getBoundingClientRect();

                                // On screen at all, but with one dimension gone: a control that
                                // cannot be seen or hit, which is what a broken flex/grid does.
                                return (r.width > 0) !== (r.height > 0);
                            })
                            .map((el) => el.getAttribute('data-slot'))
                            .slice(0, 5)
                    );

                    return expect.empty(collapsed, 'components with a zero width or height');
                });

                await reporter.check(`${slug} @ ${name}px: nothing is stranded off the left edge`, async () => {
                    const escaped = await page.evaluate(
                        ([eps, allowed]) =>
                            [...document.querySelectorAll('main [data-slot]')]
                                .filter((el) => {
                                    const slot = el.getAttribute('data-slot');
                                    if (allowed.some((a) => slot === a || slot?.startsWith(`${a}-`))) return false;
                                    if (el.closest(allowed.map((a) => `[data-slot="${a}"]`).join(','))) return false;
                                    const cs = getComputedStyle(el);
                                    if (cs.display === 'none' || cs.visibility === 'hidden') return false;
                                    const r = el.getBoundingClientRect();

                                    // Entirely outside, not merely clipped at the edge: a
                                    // partially-cropped decoration is a design choice, a
                                    // component nobody can reach is not.
                                    return r.width > 0 && r.height > 0 && r.right < -eps;
                                })
                                .map((el) => `${el.getAttribute('data-slot')} at ${Math.round(el.getBoundingClientRect().left)}px`)
                                .slice(0, 5),
                        [EPSILON, OFFSCREEN_BY_DESIGN]
                    );

                    return expect.empty(escaped, 'components positioned off the left edge of the viewport');
                });

                await reporter.check(`${slug} @ ${name}px: text is not spilling out of its box`, async () => {
                    const spilling = await page.evaluate((eps) =>
                        [...document.querySelectorAll('main [data-slot]')]
                            .filter((el) => {
                                const cs = getComputedStyle(el);
                                if (cs.display === 'none' || cs.overflow !== 'visible') return false;
                                if (!el.textContent?.trim() || el.children.length) return false;
                                const r = el.getBoundingClientRect();
                                if (!r.width || !r.height) return false;

                                // A leaf whose own content is wider than the box drawn for it,
                                // with nothing set to clip or wrap it.
                                return el.scrollWidth > el.clientWidth + eps && cs.textOverflow !== 'ellipsis' && cs.whiteSpace !== 'nowrap';
                            })
                            .map((el) => `${el.getAttribute('data-slot')} (${el.scrollWidth}px of text in ${el.clientWidth}px)`)
                            .slice(0, 5)
                    , EPSILON);

                    return expect.empty(spilling, 'text overflowing its container');
                });

                // A row that has become its own card has to look like one card. Two bugs made it
                // look like two, and neither is visible above md — where the same markup is a
                // perfectly ordinary table (#21).
                await reporter.check(`${slug} @ ${name}px: stacked rows are single, bordered cards`, async () => {
                    if (width >= 768) return; // stack mode only exists below md

                    const bad = await page.evaluate(() => {
                        const out = [];
                        for (const table of document.querySelectorAll('[data-slot="server-table"], [data-slot="table"]')) {
                            const root = table.closest('[data-slot="server-table"]') ?? table;
                            const rows = [...root.querySelectorAll('tbody tr')];
                            // Stack mode is what makes a <tr> a block-level card; anything else here
                            // is an ordinary table and none of this applies to it.
                            const cards = rows.filter((r) => getComputedStyle(r).display === 'block');
                            if (!cards.length) continue;

                            // Every card needs its border, including the last — dropping the last
                            // row's border is a real-table nicety that has no business here.
                            for (const [i, card] of cards.entries()) {
                                if (parseFloat(getComputedStyle(card).borderBottomWidth) < 1) {
                                    out.push(`row ${i} of ${cards.length} has no border while stacked as a card`);
                                }
                            }

                            // ...and it must not be sitting inside a second bordered surface.
                            const wrapper = cards[0].closest('div');
                            if (wrapper && parseFloat(getComputedStyle(wrapper).borderTopWidth) >= 1) {
                                out.push('the cards are wrapped in a second bordered card');
                            }
                        }

                        return out.slice(0, 5);
                    });

                    return expect.empty(bad, 'stacked rows do not read as single cards');
                });
            },
        });

        reporter.progress(`layout ${name}px`);
    }

    if (knownHits.length) {
        console.log(`\n${knownHits.length} known narrow-width overflow(s) not enforced: ${knownHits.join(', ')}`);
        console.log('  They size themselves from their content, as upstream does. Fixing them is a design call.');
    }
}
