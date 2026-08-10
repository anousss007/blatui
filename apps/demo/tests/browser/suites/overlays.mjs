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

export async function run({ browser, reporter, baseUrl, inventory, only }) {
    reporter.suite('overlays');
    const slugs = inventory.components.filter((s) => !only || s.includes(only));

    await inLanes(browser, slugs, { lanes: 3, viewport: { width: 1280, height: 900 }, each: async (page, slug) => {
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
        reporter.progress(`overlays ${slug}`);
    } });
}
