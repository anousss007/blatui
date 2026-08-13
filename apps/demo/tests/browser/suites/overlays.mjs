// Every trigger → content pair on every documented page: does using it actually put
// something on screen, and does Escape take it away again?
//
// This is the suite that would have caught #16. The markup was correct there; the panel
// simply computed to display:none. Nothing short of driving it and measuring finds that.
//
// Two things keep it honest on a docs page: only VISIBLE triggers are driven (the site's
// own mobile-nav sheet is hidden at desktop width and is not ours to test), and the
// assertion is on the COUNT of visible panels before vs after, because these pages render
// the same component several times over.
import { expect, inLanes, visit } from '../lib/harness.mjs';
import { countVisible, dismiss, DISCLOSURE_PAIRS, OVERLAY_PAIRS, probeTrigger, slotsOn, waitForCount } from '../lib/probes.mjs';

/** Deliberately not dismissible by Escape or an outside click. */
const NOT_ESCAPABLE = new Set(['alert-dialog-content']);

/** Hover-only triggers — clicking them proves nothing. */
const HOVER_TRIGGERS = new Set(['tooltip-trigger', 'hover-card-trigger']);

/**
 * Popovers driven from INSIDE an open dialog — the shape behind issue #18.
 *
 * A trigger that lives in a dialog measures 0×0 for as long as the dialog is closed, and Alpine
 * initialises the popover long before anyone opens it. So anything the component reads once at
 * init — where the trigger is, how wide it is — is measured against nothing, and a component that
 * never re-measures ships a panel pinned to the viewport corner or frozen at min-width:0. The
 * suite above only counts panels; it is blind to a panel that is visible in the wrong place.
 *
 * Anything here is [trigger selector, panel selector, does the panel take its width from the
 * trigger]. Both selectors are looked up inside the open dialog / among the page's teleported
 * panels, so adding a component's "inside a dialog" example to the docs is enough to cover it
 * here. Only the combobox width-matches: a select or a menu sizes itself to its own content by
 * design, and asserting otherwise would be inventing a requirement.
 */
const NESTED_POPOVERS = [
    ['[data-slot="combobox"] button', '[data-slot="combobox-content"]', true],
    ['[data-slot="select-trigger"]', '[data-slot="select-content"]', false],
    ['[data-slot="dropdown-menu-trigger"]', '[data-slot="dropdown-menu-content"]', false],
];

/** Slack for sub-pixel rounding when comparing two boxes. */
const EPSILON = 2;

/** The gap an anchored panel is allowed to leave between itself and its trigger. */
const ANCHOR_GAP = 24;

export async function run({ browser, reporter, baseUrl, inventory, only, viewports }) {
    const slugs = inventory.components.filter((s) => !only || s.includes(only));

    // Every width: an overlay that opens at 1280px can be clipped, mispositioned or hidden
    // outright at 375px or 900px, and only driving it there says so.
    for (const { name, width, height } of viewports) {
        reporter.suite(`overlays @ ${name}px`);

        await inLanes(browser, slugs, { lanes: 4, viewport: { width, height }, each: async (page, slug) => {
        await visit(page, `${baseUrl}/components/${slug}`);
        const slots = await slotsOn(page);

        for (const [triggerSlot, contentSlot] of OVERLAY_PAIRS) {
            if (!slots[triggerSlot]) continue;

            const trigger = await probeTrigger(page, triggerSlot);
            if (!trigger) continue; // present but not on screen at this width — not ours to drive

            let opened = false;

            await reporter.check(`${slug}: ${triggerSlot} opens ${contentSlot}`, async () => {
                page.blatErrors.length = 0;
                await dismiss(page);
                const before = await countVisible(page, contentSlot);

                await trigger.scrollIntoViewIfNeeded({ timeout: 3000 });
                if (HOVER_TRIGGERS.has(triggerSlot)) {
                    await trigger.hover({ timeout: 3000 });
                } else {
                    await trigger.click({ timeout: 3000 });
                }

                // Poll rather than sleep: hover-card waits 400ms by design, a sheet slides
                // for 300ms, a dropdown is up in one frame.
                const after = await waitForCount(page, contentSlot, (n) => n > before);
                opened = after > before;

                return (
                    expect.truthy(after > before, `no ${contentSlot} became visible (${before} → ${after})`) ??
                    expect.empty(page.blatErrors, 'console errors while opening')
                );
            });

            if (!opened || NOT_ESCAPABLE.has(contentSlot)) {
                await dismiss(page);
                continue;
            }

            await reporter.check(`${slug}: ${contentSlot} closes again`, async () => {
                page.blatErrors.length = 0;
                if (HOVER_TRIGGERS.has(triggerSlot)) {
                    await page.mouse.move(5, 5); // hover away
                } else {
                    await page.keyboard.press('Escape');
                }
                const left = await waitForCount(page, contentSlot, (n) => n === 0);

                return (
                    expect.equal(left, 0, `${contentSlot} is still on screen`) ??
                    expect.empty(page.blatErrors, 'console errors while closing')
                );
            });

            await dismiss(page);
        }

        for (const [triggerSlot, contentSlot] of DISCLOSURE_PAIRS) {
            if (!slots[triggerSlot]) continue;
            const trigger = await probeTrigger(page, triggerSlot);
            if (!trigger) continue;

            await reporter.check(`${slug}: ${triggerSlot} expands and collapses`, async () => {
                page.blatErrors.length = 0;
                const start = await countVisible(page, contentSlot);

                await trigger.scrollIntoViewIfNeeded({ timeout: 3000 });
                await trigger.click({ timeout: 3000 });
                const toggled = await waitForCount(page, contentSlot, (n) => n !== start);

                if (toggled === start) return `${contentSlot} did not change: ${start} visible before and after`;

                await trigger.click({ timeout: 3000 });
                const back = await waitForCount(page, contentSlot, (n) => n === start);

                return (
                    expect.equal(back, start, `${contentSlot} did not return to its initial state`) ??
                    expect.empty(page.blatErrors, 'console errors while toggling')
                );
            });
        }
        await nestedPopovers({ page, reporter, slug, slots });

            reporter.progress(`overlays ${name}px ${slug}`);
        } });
    }
}

/**
 * Open every dialog on the page, and for each popover nested inside one, assert its panel lands
 * ON its trigger — beside it, and no narrower than it. Silently does nothing on the pages that
 * have no such example, which is most of them.
 */
async function nestedPopovers({ page, reporter, slug, slots }) {
    if (!slots['dialog-trigger']) return;

    const dialogTrigger = await probeTrigger(page, 'dialog-trigger');
    if (!dialogTrigger) return;

    for (const [triggerSel, panelSel, matchesWidth] of NESTED_POPOVERS) {
        await dismiss(page);
        await dialogTrigger.scrollIntoViewIfNeeded({ timeout: 3000 });
        await dialogTrigger.click({ timeout: 3000 });
        if ((await waitForCount(page, 'dialog-content', (n) => n > 0)) === 0) return;

        const nested = page.locator(`[data-slot="dialog-content"]:visible ${triggerSel}`).first();
        if (!(await nested.count()) || !(await nested.isVisible())) continue;

        await reporter.check(`${slug}: ${triggerSel} anchors to its trigger inside a dialog`, async () => {
            page.blatErrors.length = 0;
            await nested.click({ timeout: 3000 });

            const boxes = await page
                .waitForFunction(
                    ([t, p]) => {
                        const trigger = [...document.querySelectorAll(`[data-slot="dialog-content"] ${t}`)].find((e) => e.offsetParent !== null);
                        const panel = [...document.querySelectorAll(p)].find((e) => getComputedStyle(e).display !== 'none');
                        if (!trigger || !panel) return false;
                        const box = (e) => {
                            const r = e.getBoundingClientRect();
                            return { left: r.left, top: r.top, right: r.right, bottom: r.bottom, width: r.width, height: r.height };
                        };

                        // Panels open with a scale transition, and a box measured mid-animation is a
                        // smaller box — a panel scaling in from 95% reads as 5% too narrow, which is
                        // exactly how a passing width fails on a slow runner. Two agreeing frames do
                        // not settle it: there is a frame where the panel is already displayed at
                        // scale-95 and no transition has started yet, so two polls can agree on the
                        // wrong number. Require the scale to be back to 1 and nothing still running.
                        // Tailwind v4 animates the `scale` property, so `transform` stays `none`
                        // here — both are checked so this does not quietly stop working if that
                        // changes.
                        const cs = getComputedStyle(panel);
                        const settled =
                            (cs.scale === 'none' || Math.abs(parseFloat(cs.scale) - 1) < 0.01) &&
                            (cs.transform === 'none' || /^matrix\(1,\s*0,\s*0,\s*1,/.test(cs.transform)) &&
                            !panel.getAnimations().some((a) => a.playState === 'running');
                        if (!settled) return false;

                        const now = box(panel);
                        const prev = panel.__blatPrevBox;
                        panel.__blatPrevBox = now;
                        if (!prev || Math.abs(prev.width - now.width) > 0.5 || Math.abs(prev.top - now.top) > 0.5) return false;

                        return { trigger: box(trigger), panel: now };
                    },
                    [triggerSel, panelSel],
                    { timeout: 3000 },
                )
                .then((h) => h.jsonValue())
                .catch(() => null);

            if (!boxes) return `no ${panelSel} became visible inside the dialog`;

            const { trigger, panel } = boxes;
            // Beside the trigger on the cross axis, and touching it on the main axis: a panel
            // computed while the dialog was still hidden lands in the viewport corner instead.
            const overlapsX = panel.right > trigger.left + EPSILON && panel.left < trigger.right - EPSILON;
            const below = panel.top >= trigger.bottom - EPSILON && panel.top <= trigger.bottom + ANCHOR_GAP;
            const above = panel.bottom <= trigger.top + EPSILON && panel.bottom >= trigger.top - ANCHOR_GAP;

            return (
                expect.truthy(
                    overlapsX && (below || above),
                    `panel is not anchored to its trigger: trigger at ${Math.round(trigger.left)},${Math.round(trigger.top)} ` +
                        `(${Math.round(trigger.width)}×${Math.round(trigger.height)}), panel at ${Math.round(panel.left)},${Math.round(panel.top)}`,
                ) ??
                (matchesWidth
                    ? expect.truthy(
                          panel.width >= trigger.width - EPSILON,
                          `panel is narrower than its trigger (${Math.round(panel.width)}px vs ${Math.round(trigger.width)}px) — ` +
                              'a width measured once, while the dialog was still closed',
                      )
                    : undefined) ??
                expect.empty(page.blatErrors, 'console errors while opening')
            );
        });
    }

    await dismiss(page);
}
